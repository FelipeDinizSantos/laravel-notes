<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function create()
    {
        return view('login');
    }

    public function logout()
    {
        // return view('logout');
    }

    private function validateData(Request $request): void
    {
        $request->validate([
            'text_username' => 'required|email',
            'text_password' => 'required|min:6|max:16'
        ], [
            'text_username.required' => 'Username é obrigatório.',
            'text_username.email' => 'Username deve ser um e-mail válido.',
            'text_password.required' => 'A password é obrigatória e precisa ter no minimo 6 e no máximo 16 caracteres',
            'text_password.min' => 'A password deve ter pelo menos :min caracteres',
            'text_password.max' => 'A password deve ter no máximo :max caracteres',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateData($request);

        $username = $request->input('text_username');
        $password = $request->input('text_password');

        dd([
            'success' => true
        ]);
    }
}
