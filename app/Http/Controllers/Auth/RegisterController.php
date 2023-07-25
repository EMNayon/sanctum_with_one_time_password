<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App
use Hash;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Notifications\EmailVerificationNotification;
use App\Models\User;

class RegisterController extends Controller
{
    public function register (RegistrationRequest $request){
        $newuser = $request->validated();

        $newuser['password'] = Hash::make($newuser['password']);
        $newuser['role'] = 'user';
        $newuser['status'] = 'active';

        $user = User::create($newuser);
        // $success['token'] = $request->user()->createToken($request->ainoviq)->accessToken;
        // $success['token'] = $user->createToken('user',['app:all'])->plainTextToken;
        // $success = $user->createToken('user', ['app:all'])->plainTextToken();
        $token = $user->createToken('user', ['app:all']);
        $success['token'] = $token->plainTextToken;

        // $success['name'] = $user->first_name;
        $success['success'] = true;
        // $success['token'] = $success;

        $user->notify(new EmailVerificationNotification());

        return response()->json(['user'=> $user, 'token' => $success]);
    }
}
