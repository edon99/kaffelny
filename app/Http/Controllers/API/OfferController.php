<?php

namespace App\Http\Controllers\API;

use App\Enums\GenderEnum;
use App\Enums\OccupationEnum;
use App\Enums\ServiceEnum;
use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Enum;

class OfferController extends Controller
{
    public function createOffer(Request $request){
//
        $request->validate([
            'service' => ['required', new Enum(ServiceEnum::class)],
            'hours' => 'nullable|numeric',
            'description' => 'nullable|string|max:255',
            'long' => 'required|numeric',
            'lat' => 'required|numeric',
        ]);

        $offer = Offer::create([
            'service' => ServiceEnum::from($request->service),
            'hours' => $request->hours,
            'description' => $request->description,
            'long' => $request->long,
            'lat' => $request->lat,
            'user_id' => auth()->user()->id,
        ]);

        return response()->json(['type' => 'success', 'message' => 'Offer created successfully', 'offer_id' => $offer->id]);
    }
    public function getOffers(Request $request){
        $offers = Offer::where('user_id', auth()->user()->id)->get();
        return response()->json(['type' => 'success', 'message' => 'Offers retrieved successfully', 'data' => $offers]);
    }
    public function getOfferDetails(Request $request, $id){
        $offer = Offer::with('provider')->find($id);
        return response()->json(['type' => 'success', 'message' => 'Offer retrieved successfully', 'data' => $offer]);
    }
}
