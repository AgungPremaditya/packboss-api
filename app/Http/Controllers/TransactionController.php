<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use App\Models\Transaction;
use App\Models\Destination;
use App\Models\Package;
use App\Models\Origin;


use Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Transaction::with('package')->get();
        return $data;
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

        $data = [
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

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
}
