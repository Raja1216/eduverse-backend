<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __invoke(Request $request, AuthService $service)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'password' => 'required|min:6',
            'role' => 'required|in:student,parent'
        ]);

        $user = $service->register($data);

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('auth')->plainTextToken
        ]);
    }
}
