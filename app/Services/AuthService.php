<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use function PHPUnit\Framework\isNull;

class AuthService
{
    public function __construct( protected UserService $userService)
    {
    }

    public function login(array $data): array
    {
        $user = $this->userService->findByEmail($data['email']);

        if (is_null($user) || !Hash::check($data['password'], $user->getAuthPassword())){
            return $this->responseData('fails', 'Email or password not correct, try again with correct credential!');
        }

        Auth::login($user, $data['remember_me']);
        self::setSessionVariables($user);

        return $this->responseData('success', '');
    }

    public function logout(): void
    {
        Session::flush();
        Auth::logout();
    }


    public function register(array $data): User
    {
        $user = User::create($data);
        $user->assignRole('User');
        Auth::login($user);
        $this->setSessionVariables($user);

        return $user;
    }

    public static function setSessionVariables(User $user): void
    {
        Session::put('restaurant', $user->restaurant);
    }

    private function responseData(string $key, string $value): array
    {
        return [
            'key' => $key,
            'value' => $value
        ];
    }
}
