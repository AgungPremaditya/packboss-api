<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use App\Models\User;

use Validator, Hash, Exception;

class AuthController extends Controller
{
    public function Login(Request $request) 
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            $response = [
                'statusCode' => 422,
                'massages' => $validate->errors(),
                'content' => null
            ];
            return response()->json($response, 422);
        } else {
            $credentials = request(['email', 'password']);
            $credentials =  Arr::add($credentials, 'status', 'active');

            if (!Auth::attempt($credentials)) {
                $this->Unauthorized();
            }

            $user = User::where('email', $request->email)->first();
            if (! Hash::check($request->password, $user->password)) {
                throw new Exception('Error on Login');
            }
            
            $tokenResult = $user->createToken('token-auth')->plainTextToken;
            $response = [
                'statusCode' => 200,
                'massages' => 'Success',
                'content' => [
                    'accessToken' => $tokenResult,
                    'tokenType' => 'Bearer' 
                ]
            ];
            return response()->json($response, 200);
        }
        
    }

    public function Register(Request $request)
    {
        //Make Validator
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'email|required',
            'phone' => 'required|numeric|min:11',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        //If Validator fails return error
        if ($validator->fails()) {
            $response = [
                'code' => 422,
                'messages' => $validator->errors(),
                'content' => null
            ];
            return response()->json($response, 422);
        }

        //Add user data
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'status' => 'active'
        ];

        $user = User::create($data);
        
        $tokenResult = $user->createToken('token-auth')->plainTextToken;
        $response = [
            'statusCode' => 200,
            'massages' => 'Success',
            'content' => [
                'user' => $user,
                'accessToken' => $tokenResult,
                'tokenType' => 'Bearer' 
            ]
        ];
        return response()->json($response, 200);
    }

    public function Unauthorized()
    {
        $response = [
            'statusCode' => '401',
            'messages' => 'Unauthorized',
            'content' => null
        ];
        return response()->json($response, 401);
    }
}