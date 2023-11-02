<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Ramsey\Uuid\Rfc4122\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
    ]);
    // 1
    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }
    // 2

    $input = $request->all();
    $input['password'] = bcrypt($input['password']);
    $user = User::create($input);
    // 3

}
}
