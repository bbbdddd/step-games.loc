<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $password = $request->get('password');
        $login = $request->get('login');
        $user = User::where('login', $login)->FirstOrFail();
        if (Hash::check($password, $user->password)) {
            //$user->revoke();
            return $user ->createToken("test")->plainTextToken;
        }
        return new \HttpException("Password is not correct", 403);
        //return abort(401, 'Password not correct');
    }

}
