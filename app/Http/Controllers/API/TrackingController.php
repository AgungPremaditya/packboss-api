<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Transaction;
use App\Models\Tracking;

class TrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($receipt_number)
    {
        $result = Tracking::with(['user' => function($query){
            $query->select(['id', 'name', 'email']);
        }])
        ->with(['transport' => function($query){
            $query->select(['id', 'name', 'transport_code', 'license_number']);
        }])
        ->with(['transaction' => function($query) use($receipt_number){
            $query->where('receipt_number', $receipt_number);
        }])
        ->get();
        
        foreach ($result as $value) {
            if ($value->transaction != null) {
                $data[] = $value;
            }
        }

        $response = [
            'statusCode' => 200,
            'messages' => 'success',
            'content' => $data
        ];

        return response()->json($response, 200);
    }
}
