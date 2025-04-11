<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public static function middleware(): array
    {
        return [
            'auth' => 'index',
        ];
    }
    public function index()
    {
        $users = User::all();
        return Inertia::render('Users', [ 'users' => $users,]);
    }
}
