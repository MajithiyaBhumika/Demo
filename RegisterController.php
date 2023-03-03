<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\registration;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
class RegisterController extends Controller
{
    //
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'firstname'=>'required|string',
            'lastname'=>'required|string',
            'email'=>'required|email',
            'phone'=>'required',
            'password'=>'required',
            'address'=>'required'
        ]);

        if($validator->fails())
        {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }
        
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = registration::create($input);
        dd($user);
        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['firstname'] = $user->firstname;

        $response = [
            'success' => true,
            'data' => $success,
            'message'=>'User register successfully'
        ];

        return response()->json($response,200);
           

    }


    public function login(Request $request)
    
    {
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
             $user = Auth::user();
             $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['firstname'] = $user->firstname;

        $response = [
            'success' => true,
            'data' => $success,
            'message'=>'User login successfully'
        ];
        return response()->json($response,200);
        }
        else{
            $response = [
                'success' => false,
                'message' => 'Unauthorised'
            ];
            return response()->json($response);
        }
    }
}
