<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\traits\OfferTrait;
use Illuminate\Http\Request;

class Offercontroller extends Controller
{
    use OfferTrait;

    public function all()
    {
        $offers = Offer::select('id', 'name_en', 'price', 'details_en', 'photo')->get();
        return view('AjaxOffer.all', compact('offers'));
    }

    public function create()
    {
        return view('AjaxOffer.create');
    }
    public function insert(OfferRequest $request)
    {
        $file_name = $this->saveImage($request->photo, 'images/offers');
        $offer = Offer::create([
            'photo'             => $file_name,
            'name_ar'           => $request->name_ar,
            'name_en'           => $request->name_en,
            'price'             => $request->price,
            'details_ar'        => $request->details_ar,
            'details_en'        => $request->details_en,
        ]);
        if ($offer) {
            return response()->json([
                'status'        => true,
                'msg'           => 'Offer has been successfully added',
            ]);
        } else {
            return response()->josn([
                'status'        => false,
                'msg'           => 'Bid adding failed, please try again',
            ]);
        }
    }


    public function delete(Request $request)
    {
        $offer = Offer::find($request->id);
        if (!$offer) {
            return response()->json([
                'status' => false,
                'msg'   => 'offer in not exist'
            ]);
        }
        $offer->delete();
        return response()->json([
            'status'    => true,
            'msg'       => 'offer is successfully deleted',
            'data'      => $request->id
        ]);
    }

    public function edit($offer_id)
    {
        $offer = Offer::select(['id', 'name_ar', 'name_en', 'price', 'details_ar', 'details_en','photo'])->find($offer_id);
        if (!$offer) {
            return redirect()->back();
        }
        return view('AjaxOffer.edit', compact('offer'));
    }

    public function update(Request $request){
        $offer=Offer::find($request->id);
        if(!$offer){
            return response()->json([
                'status'    => false,
                'msg'       => 'offer is not exist',
            ]);
        }
        $offer->update($request->all());
        return response()->json([
            'status'    => true,
            'msg'       => 'offer is successfully updated',
            'data'      => $request->id
        ]);
    }
}
