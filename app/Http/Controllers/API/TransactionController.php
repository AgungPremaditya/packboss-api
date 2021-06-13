<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Transaction;
use App\Models\Destination;
use App\Models\Package;
use App\Models\Origin;


use Validator, Str;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Transaction::with(['package' => function($query){
            $query->with('user', 'destination', 'origin');
        }])->get();


        $response = [
            'statusCode' => 200,
            'messages' => 'Succes',
            'content' => $data
        ];

        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Get Origin by User Auth
        $origin = Origin::where('id_user', Auth::user()->id)->first();

        //Get Destinations by Request
        $destination = Destination::find($request->id_destination);

        //Update Packages
        $dataPackages = [
            'id_destination' => $request->id_destination,
            'id_origin' => $origin->id
        ];
        $packages = Package::find($request->id_package);
        $packages->update($dataPackages);

        //Count distance
        $distance = $this->countDistance([
            'baseCode' => (int)$origin->postal_code,
            'comparedCode' => (int)$destination->postal_code
        ]);

        //Count Price
        $price = (int)$distance * 50;
        $total_price = $price * $packages->weight;

        //Generate Code
        $code = $this->generateReceipt();

        $data = [
            'receipt_number' => Str::upper($code),
            'id_package' => $packages->id,
            'price_per_kg' => $price,
            'total_price' => $total_price,
            'status' => 'waiting-for-pickup'
        ];
        
        $result = Transaction::create($data);
        
        $response = [
            'statusCode' => 200,
            'messages' => 'Success',
            'content' => $result
        ];

        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Transaction::where('id', $id)
        ->with(['package' => function($query){
            $query->with('user', 'destination', 'origin', 'category');
        }])
        ->first();

            $response = [
                'statusCode' => 403,
                'messages' => 'Sorry, this page is not accessible for you',
                'content' => null
            ];
            return response()->json($response, 403);
        if (empty($data)) {
            $response = [
                'statusCode' => 404,
                'messages' => 'not found',
                'content' => null
            ];

            return response()->json($response, 404);    
        }

        $response = [
            'statusCode' => 200,
            'messages' => 'Succes',
            'content' => $data
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::allows('isUser')) {
            $response = [
                'statusCode' => 403,
                'messages' => 'Sorry, this page is not accessible for you',
                'content' => null
            ];
            return response()->json($response, 403);
        }

        Transaction::find($id)->delete();
        
        $response = [
            'statusCode' => 200,
            'messages' => 'Success',
            'content' => null
        ];

        return response()->json($response, 200);
    }

    /**
     * Count distance by zipcode using zipcodebase
     *
     * @param  array  $data
     * @return \Illuminate\Http\Response
     */
    public function countDistance($data)
    {
        $apiKey = 'c62c9b00-c4f7-11eb-99c0-2323b4dcf057';
        $link = 'https://app.zipcodebase.com/api/v1/distance';

        $response = Http::get($link, [
            'apikey' => $apiKey,
            'code' => $data['baseCode'],
            'compare' => $data['comparedCode'],
            'country' => 'id'
        ])->json();
        
        return $response['results'][$data['comparedCode']];
    }

    public function generateReceipt()
    {
        $isNotUnique = true;

        while ($isNotUnique) {
            $code = Str::random(15);
            $receipt    = Transaction::where('receipt_number', '=', $code)->first();
            if (empty($receipt)) {
                $isNotUnique = false;
            }
        }

        return $code;
    }
}
