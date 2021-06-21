<?php

namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Transport;
use App\Models\Transaction;
use App\Models\Pickup;

use Carbon\Carbon;

use Validator;

class PickupController extends Controller
{
    public function onWaiting()
    {
        $data = Transaction::where('status', 'waiting-for-pickup')->get();
        
        return view('pickup.index')->with(['data' => $data]);
    }

    public function create($receipt_number)
    {
        $data = [];
        $transaction = Transaction::where('receipt_number', $receipt_number)->first();
        $transport = Transport::get();

        $data =[
            'transaction' => $transaction,
            'transport' => $transport
        ];

        return view('pickup.create')->with(['data' => $data]);
    }

    public function store(Request $request)
    {   
        $validate = Validator::make($request->all(), [
            'id_transport' => 'required',
            'pickedup_at_time' => 'required',
            'pickedup_at_date' => 'required'
        ]);

        if ($validate->fails()) {
            $error = $validate->errors();
            return redirect()->back()->withErrors($error)->withInput();
        }


        $strTime = strtotime($request->pickedup_at_time." ".$request->pickedup_at_date);
        $timestamp = date("Y-m-d H:i:s", $strTime);

        $transaction = Transaction::select('id')
        ->where('receipt_number', $request->receipt_number)
        ->first();


        $transport = Transport::find($request->id_transport);

        $data = [
            'id_transaction' => $transaction->id,
            'id_user' => Auth::user()->id,
            'id_transport' => $request->id_transport,
            'pickedup_at' => $timestamp
        ];

        $result = Pickup::create($data);

        $transaction->update(['status' => 'on-pickup']);
        $transport->update(['status' => 0]);

        return redirect()->route('home');
    }
}
