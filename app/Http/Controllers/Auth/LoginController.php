<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use Auth;
use App\Events\LoggedIn;
use App\Notifications\LoginNotification;

class LoginController extends Controller
{
    public function login (LoginRequest $request){

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(auth()->attempt($credentials )){
          $user = Auth::user();

          $user->tokens()->delete();
          $success['id'] = $user->id;
          $token = $user->createToken(request()->userAgent());
          $success['token'] = $token->plainTextToken;
          $success['name'] = $user->first_name;
          $success['success'] = true;
          $user->notify(new LoginNotification());
          return response()->json( $success,200);
          
        }else{
          return response()->json(['error'=> __('auth.Unauthorised')],401);
        }

  }
}
