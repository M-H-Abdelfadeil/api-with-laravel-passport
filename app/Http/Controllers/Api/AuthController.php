<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\MessagesHelper;
use App\Http\Helpers\ResponseHelper;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);

        $token = $user->createToken('api')->accessToken;
        $data = [
            "user"=>$user,
            "token"=>$token
        ];
        return ResponseHelper::sendResponseSuccess($data, Response::HTTP_CREATED);


    }

    public function login(LoginRequest $request){
        if(auth()->attempt(['email'=>$request->email , 'password'=>$request->password])){
            $user = auth()->user();
            $token = $user->createToken('api')->accessToken;
            $data = [
                "user"=>$user,
                "token"=>$token
            ];
            return ResponseHelper::sendResponseSuccess($data, Response::HTTP_OK, MessagesHelper::LOGGED_IN_SUCCESSFULLY);
        }else{
            return ResponseHelper::sendResponseError([], Response::HTTP_UNAUTHORIZED);
        }
    }
}
