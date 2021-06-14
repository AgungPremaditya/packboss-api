<?php

namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tracking;
use App\Models\Transaction;
use App\Models\Transport;

use Validator;

class TrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($receipt_number)
    {
        $transaction = Transaction::where('receipt_number', $receipt_number)->first();
        $transport = Transport::where('status', 1)->get();
        $data = [
            'transaction' => $transaction,
            'transport' => $transport
        ];
        return view('tracking.create')->with(['data' => $data]);
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
            'status' => 'required'
        ]);

        if ($validate->fails()) {
            $error = $validate->errors();
            return redirect()->back()->withErrors($error)->withInput();
        }

         $transaction = Transaction::select('id')
         ->where('receipt_number', $request->receipt_number)
         ->first();

        $data = [
            'tracking_status' => $request->status,
            'id_user' => Auth::user()->id, 
            'id_transaction' => $transaction->id,
            'id_transport' => $request->id_transport
        ];
        
        $transaction->update(['status' => $request->status]);
        Tracking::create($data);

        return redirect()->route('home');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
}
