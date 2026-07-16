<?php

namespace App\Http\Controllers;

use App\Models\User;

class MainController extends Controller
{
    protected ?User $user = null;

    public function __construct()
    {
        $userId = session('user.id');
        $this->user = User::with('notes')->find($userId);
    }

    public function index()
    {
        return view('home', [
           'user' => $this->user
        ]);
    }

    public function createNote()
    {
        echo 'Página para criação de uma nova nota!';
    }
}
