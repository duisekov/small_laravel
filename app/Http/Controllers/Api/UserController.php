<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public $successStatus = 200;

    public function login()
    {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            if ($user->role_id == 1){
                $success['token'] = $user->createToken('small', ['moderator'])->accessToken;
            } else {
                $success['token'] = $user->createToken('small', ['client'])->accessToken;
            }

            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorized', 401]);
        }
    }
}
