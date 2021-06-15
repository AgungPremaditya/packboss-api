<?php

namespace App\Http\Controllers\API\Package;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Package;

use Validator;
class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Package::
        with(['user' => function ($query){
            $query->select('id','name', 'phone', 'email');
        }])
        ->with(['category' => function($query){
            $query->select('id','category_name', 'is_fragile', 'is_hazardous');
        }])
        ->get();

        $response = [
            'statusCode' => 200,
            'messages' => 'success',
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
        $validate = Validator::make($request->all(), [
            'category' => 'required',
            'package_name' => 'required|string',
            'recepient_name' => 'required|string', 
            'recepient_phone' => 'required|numeric|min:11',
            'weight' => 'required|numeric',
            'dimension' => 'required'
        ]); 

        if ($validate->fails()) {
            $response = [
                'statusCode' => 422,
                'messages' => $validate->errors(),
                'content' => null
            ];

            return response()->json($response, 422);
        }

        $data = [
            'id_user' => Auth::user()->id,
            'id_category' => $request->category,
            'package_name' => $request->package_name,
            'recepient_name' => $request->recepient_name,
            'recepient_phone' => $request->recepient_phone,
            'weight' => $request->weight,
            'dimension' => $request->dimension,
        ];
        
        $result = Package::create($data);

        return $result; 

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
        $data = Package::
        with(['user' => function($query){
            $query->select('id', 'name', 'phone', 'email');
        }])
        ->with(['category' => function($query){
            $query->select('id','category_name', 'is_fragile', 'is_hazardous');
        }])
        ->where('id', $id)
        ->first();

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
            'messages' => 'success',
            'content' => $data
        ];

        return response()->json($response, 200);
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
        $validate = Validator::make($request->all(), [
            'category' => 'required',
            'package_name' => 'required|string',
            'recepient_name' => 'required|string', 
            'recepient_phone' => 'required|numeric|min:11',
            'weight' => 'required|numeric',
            'dimension' => 'required'
        ]); 

        if ($validate->fails()) {
            $response = [
                'statusCode' => 422,
                'messages' => $validate->errors(),
                'content' => null
            ];

            return response()->json($response, 422);
        }

        $result = Package::find($id);

        if (empty($result)) {
            $response = [
                'statusCode' => 404,
                'messages' => 'not found',
                'content' => null
            ];

            return response()->json($response, 404);   
        }

        if ($result->id_user != Auth::user()->id) {
            $response = [
                'statusCode' => 403,
                'messages' => 'Sorry, this page is not accessible for you',
                'content' => null
            ];

            return response()->json($response, 403);   
        }

        $data = [
            'id_category' => $request->category,
            'package_name' => $request->package_name,
            'recepient_name' => $request->recepient_name,
            'recepient_phone' => $request->recepient_phone,
            'weight' => $request->weight,
            'dimension' => $request->dimension,
        ];

        $result->update($data);
        
        $response = [
            'statusCode' => 200,
            'messages' => 'success',
            'content' => $result
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
        $data = Package::find($id);

        if (empty($data)) {
            $response = [
                'statusCode' => 404,
                'messages' => 'not found',
                'content' => null
            ];

            return response()->json($response, 404);   
        }

        if ($data->id_user != Auth::user()->id) {
            $response = [
                'statusCode' => 403,
                'messages' => 'Sorry, this page is not accessible for you',
                'content' => null
            ];

            return response()->json($response, 403);   
        }
        
        $data->delete();

        $response = [
            'statusCode' => 200,
            'messages' => 'succes',
            'content' => null
        ];

        return response()->json($response, 200);

    }
}
