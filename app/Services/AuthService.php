<?php
namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Exception;

class AuthService
{
    public function __construct(
        private UserRepositoryInterface $userRepo
    ) {}

    public function register(array $data)
    {
        if (!empty($data['email']) && $this->userRepo->findByEmail($data['email'])) {
            throw new Exception('Email already exists');
        }

        $data['password'] = Hash::make($data['password']);
        return $this->userRepo->create($data);
    }

    public function login(string $login, string $password)
    {
        $user = filter_var($login, FILTER_VALIDATE_EMAIL)
            ? $this->userRepo->findByEmail($login)
            : $this->userRepo->findByPhone($login);

        if (!$user || !Hash::check($password, $user->password)) {
            throw new Exception('Invalid credentials');
        }

        return $user;
    }
}
