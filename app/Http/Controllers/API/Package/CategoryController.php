<?php

namespace App\Http\Controllers\API\Package;

use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::all();

        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::allows('isUser')) {
            $response = [
                'statusCode' => 403,
                'messages' => 'Sorry, this page is not accessible for you',
                'content' => null
            ];
            return response()->json($response, 403);
        }
        
        $validate = Validator::make($request->all(), [
            'category_name' => 'required|string',
            'is_fragile' => 'required|integer',
            'is_hazardous' => 'required|integer',
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
            'category_name' => $request->category_name,
            'is_fragile' => $request->is_fragile,
            'is_hazardous' => $request->is_hazardous
        ];

        $result = Category::create($data);
        
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
        if (Gate::allows('isUser')) {
            $response = [
                'statusCode' => 403,
                'messages' => 'Sorry, this page is not accessible for you',
                'content' => null
            ];
            return response()->json($response, 403);
        }

        $data = Category::find($id);

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
        if (Gate::allows('isUser')) {
            $response = [
                'statusCode' => 403,
                'messages' => 'Sorry, this page is not accessible for you',
                'content' => null
            ];
            return response()->json($response, 403);
        }

        $result = Category::find($id);

        if (empty($result)) {
            $response = [
                'statusCode' => 404,
                'messages' => 'not found',
                'content' => null
            ];   
            return response()->json($response, 404);
        }

        $validate = Validator::make($request->all(), [
            'category_name' => 'required|string',
            'is_fragile' => 'required|integer',
            'is_hazardous' => 'required|integer',
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
            'category_name' => $request->category_name,
            'is_fragile' => $request->is_fragile,
            'is_hazardous' => $request->is_hazardous
        ];
        
        $result->update($data);

        $response = [
            'statusCode' => 200,
            'messages' => 'success',
            'content' => $result
        ];
        return response()->json($response);
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

        $data = Category::find($id);

        if (empty($data)) {
            $response = [
                'statusCode' => 404,
                'messages' => 'not found',
                'content' => null
            ];

            return response()->json($response, 404);    
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
