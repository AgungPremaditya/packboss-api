<?php

namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Package;
use App\Models\Transport;
use App\Models\Transaction;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->role != 'user') {

            //Get Data
            $transactions = Transaction::all();
            $transport = Transport::all();

            //Count Transaction
            $countedTransactions = count($transactions->toArray());

            //Count Transport
            $countedTransport = count($transport->toArray());

            $data =[ 
                'transaction' => $countedTransactions,
                'transport' => $countedTransport
            ];

            dd($data);
            if (Auth::user()->role == 'admin') {
                
            }
            
            return view('home.index')->with($data);
        }else{
            return redirect()->route('unauthorized');
        }
    }
}
