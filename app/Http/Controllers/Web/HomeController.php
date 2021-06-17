<?php

namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Package;
use App\Models\Transport;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Pickup;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->role != 'user') {

            //Get Data
            $waitingList = Transaction::where('status', 'waiting-for-pickup')->get();
            $transport = Transport::all();

            //Count Waiting List
            $countedwaitingList = count($waitingList->toArray());

            //Count Transport
            $countedTransport = count($transport->toArray());

            //Array Data
            $data =[ 
                'waiting-list' => $countedwaitingList,
                'transport' => $countedTransport
            ];

            if (Auth::user()->role == 'operator') {
                $pickup = Pickup::with(['transaction' => function ($query){
                    $query->with(['package' => function ($query){
                        $query->select('id', 'id_origin')->with('origin');
                    }]);
                }])
                ->get();

            }

            if (Auth::user()->role == 'admin') {
              
                //Get Data
                $transactions = Transaction::all();
                $operator = User::where('role', 'operator')->get();
                $pickup = Pickup::with(['transaction' => function ($query){
                    $query->with(['package' => function ($query){
                        $query->select('id', 'id_origin')->with('origin');
                    }]);
                }])
                ->get();


                //Count Transport
                $countedOperator = count($operator->toArray());

                //Count Transaction
                $countedTransactions = count($transactions->toArray());

                $data['operator'] = $countedOperator;
                $data['transaction'] = $countedTransactions;
            }   

            $data['pickup'] = $pickup;

            return view('home.index')->with(['data' => $data]);
        }else{
            return redirect()->route('unauthorized');
        }
    }
}
