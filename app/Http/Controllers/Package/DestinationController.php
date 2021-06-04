<?php

namespace App\Http\Controllers\Package;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Destination;

use Validator;

class DestinationController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'country_name' => 'required|string',
            'province_name' => 'required|string',
            'region_name' => 'required|string',
            'postal_code' => 'required|string',
            'detail_address' => 'required'
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
            'country_name' => $request->country_name,
            'province_name' => $request->province_name,
            'region_name' => $request->region_name,
            'postal_code' => $request->postal_code,
            'detail_address' => $request->detail_address
        ];

        $result = Destination::create($data);
        
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
        $data = Destination::find($id);

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
}
