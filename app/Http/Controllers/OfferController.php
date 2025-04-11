<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Inertia\Inertia;




class OfferController extends Controller{

    public static function middleware(): array
    {
        return [
            'auth' => 'index',
        ];
    }



    public function index()
    {
        $offers = Offer::all();
        return Inertia::render('Offers', [ 'offers' => $offers,]);
    }



}
