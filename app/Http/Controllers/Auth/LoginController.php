<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __invoke(Request $request, AuthService $service)
    {
        $data = $request->validate([
            'login' => 'required',
            'password' => 'required'
        ]);

        $user = $service->login($data['login'], $data['password']);

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('auth')->plainTextToken
        ]);
    }
}
