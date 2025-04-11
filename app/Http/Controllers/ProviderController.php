<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProviderController extends Controller
{
    public static function middleware(): array
    {
        return [
            'auth' => 'index',
        ];
    }
    public function index()
    {
        $providers = Provider::all()->toArray();
        return Inertia::render('Providers',['providers' => $providers]);
    }
}
