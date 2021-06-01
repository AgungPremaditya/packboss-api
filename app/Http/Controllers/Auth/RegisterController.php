<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Validator;

class RegisterController extends Controller
{
    //Register Auth
    public function register(Request $request)
    {
        //Make Validator
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'email|required',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        //If Validator fails return error
        if ($validator->fails()) {
            $response = [
                'code' => 422,
                'messages' => $validator->errors()->toArray()
            ];
            return response()->json($response, 422);
        }

        //Add user data
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ];
        $user = User::create($data);
        $user['token'] = $user->createToken('MyApp')->accessToken;

        return response()->json([
            'code' => 200,
            'messages' => $user
        ], 200);
    }
}
