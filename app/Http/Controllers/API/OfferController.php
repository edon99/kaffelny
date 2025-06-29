<?php

namespace App\Http\Controllers\API;

use App\Enums\OfferStateEnum;
use App\Enums\ServiceEnum;
use App\Http\Controllers\Controller;
use App\Models\Offer;

use Illuminate\Http\Request;

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
        $offer = Offer::with(['provider', 'user'])->find($id);
        return response()->json(['type' => 'success', 'message' => 'Offer retrieved successfully', 'data' => $offer]);
    }

    public function getProviderOffers(Request $request){
        try {
            $provider = auth()->user();
            $offers = $provider->offers()->with('user')->get();
            return response()->json(['type' => 'success', 'message' => 'Offers retrieved successfully', 'data' => $offers]);
        } catch (\Exception $e) {
            return response()->json(['type' => 'error', 'message' => $e->getMessage()]);
        }

    }
    public function getUserOffers(Request $request){
        try {
            $user = auth()->user();
            $offers = $user->offers()->with('provider')->get();
            return response()->json(['type' => 'success', 'message' => 'Offers retrieved successfully', 'data' => $offers]);
        } catch (\Exception $e) {
            return response()->json(['type' => 'error', 'message' => $e->getMessage()]);
        }

    }

    public function fetchNearbyOffers(Request $request)
    {

        try {

            $user = $request->user();
            if (!$user) {
                return response()->json([
                    'type' => 'error',
                    'message' => 'Unauthorized',
                ], 401);
            }


            $latitude = $request->input('lat');
            $longitude = $request->input('long');
            $radius = $request->input('radius', 10);


            $offers = Offer::selectRaw(
                '*, (6371 * acos(cos(radians(?)) * cos(radians(lat)) * cos(radians(`long`) - radians(?)) + sin(radians(?)) * sin(radians(lat)))) AS distance',
                [$latitude, $longitude, $latitude]
            )
                ->having('distance', '<', $radius)
                ->get(20);


            return response()->json([
                'type' => 'success',
                'message' => 'Offers retrieved',
                'data' => $offers,
            ], 200);

        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => 'Failed to fetch offers: ' . $exception->getMessage(),
            ], 500);
        }
    }

    public function acceptOffer(Request $request, $id)
    {
        $offer = Offer::find($id);
        if (!$offer) {
            return response()->json([
                'type' => 'error',
                'message' => 'Offer not found',
            ], 404);
        }
        $offer->state = OfferStateEnum::ACCEPTED;
        $offer->provider_id = auth()->user()->id;
        $offer->save();
        return response()->json([
            'type' => 'success',
            'message' => 'Offer accepted',
        ]);
    }

    public function cancelOffer(Request $request, $id)
    {
        $offer = Offer::find($id);
        if (!$offer) {
            return response()->json([
                'type' => 'error',
                'message' => 'Offer not found',
            ], 404);
        }
        $offer->state = OfferStateEnum::CANCELED;
        $offer->save();
        return response()->json([
            'type' => 'success',
            'message' => 'Offer canceled',
        ]);
    }



}
