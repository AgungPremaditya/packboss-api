<?php

namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Validator, Hash, Session;

class AuthController extends Controller
{
    public function loginIndex()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        } else {
            return view('auth.login');
        }
    }

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }
        
        $user = User::where('email', $request->email)->first();


        if ($user->role == 'user') {
            return view('auth.forbidden');
        } else {
            Auth::attempt(['email' => $request->email, 'password' => $request->password]);

            if (Auth::check()) {
                if (Auth::user()->role == 'user') {
                    return redirect()->route('unauthorized');    
                }
                return redirect()->route('home');
            } else {
                Session::flash('error', 'Email atau Password Salah');
                return redirect()->route('/');
            }
        }
    }

    public function unauthorized()
    {
        return view('auth.unauthorized');
    }

    public function forbidden()
    {
        return view('auth.forbidden');
    }
}
