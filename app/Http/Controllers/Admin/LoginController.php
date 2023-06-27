<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function __construct( protected AuthService $authService)
    {
    }

    public function login(): View|RedirectResponse
    {
        if (Auth::check() && Auth::user()->hasRole(['Super Admin', 'Owner'])){
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    public function checkLogin(LoginRequest $loginRequest): RedirectResponse
    {
        $response = $this->authService->login($loginRequest->validated());

        if ($response['key'] == 'fails')
            return redirect()->back()->withErrors($response['value']);

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        $this->authService->logout();

        return redirect()->route('admin_login');
    }
}
