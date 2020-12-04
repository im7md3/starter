<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\OfferRequest;
use App\Models\video;
use App\Scopes\offerScopes;
use App\traits\OfferTrait;
use LaravelLocalization;


class CrudController extends Controller
{

    use OfferTrait;

    public function __construct()
    {
    }

    public function getAllOffers()
    {
        /* $offers = Offer::select(
            'id',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'price',
            'details_' . LaravelLocalization::getCurrentLocale() . ' as details',
            'photo'
        )->get(); */

        /* ================================= pagination =================================*/
        $offers = Offer::get();
        return view('offers.all', compact('offers'));
    }

    public function getAllInactiveOffers(){
        //global scope
        //$offers = Offer::get();
        $offers = Offer::withoutGlobalScope(offerScopes::class)->get();
        return view('offers.all', compact('offers'));
    }

    /* public function store()
    {
        Offer::create([
            'name'      => 'offer3',
            'price'     => '500',
            'details'   => 'ghi',
        ]);
        return 'Done ^-^';
    } */

    public function create()
    {
        return view('offers.create');
    }

    public function insert(OfferRequest $request)
    {

        /* $validator=Validator::make($request->all(),$rules);
        if($validator -> fails()){
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } */

        $file_name = $this->saveImage($request->photo, 'images/offers');

        Offer::create([
            'photo'             => $file_name,
            'name_ar'           => $request->name_ar,
            'name_en'           => $request->name_en,
            'price'             => $request->price,
            'details_ar'        => $request->details_ar,
            'details_en'        => $request->details_en,
        ]);
        return redirect()->back()->with(['success' => __('message.Offer has been added successfully')]);
    }

    public function editOffer($offer_id)
    {
        //Offer::findOrFail($offer_id);
        $offer = Offer::select('id', 'name_ar', 'name_en', 'details_ar', 'details_en', 'price')->find($offer_id);
        if (!$offer) {
            return redirect()->back();
        }
        return view('offers.edit', compact('offer'));
    }

    public function updateOffer(OfferRequest $request, $offer_id)
    {
        $offer = Offer::find($offer_id);
        if (!$offer) {
            return redirect()->back()->with(['error' => __('message.Sorry this offer does not exist')]);
        }
        $offer->update($request->all());
        return redirect()->back()->with(['success' => __('message.Successfully updated')]);
    }

    public function deleteOffer($offer_id)
    {
        $offer = Offer::find($offer_id);
        if (!$offer) {
            return redirect()->back()->with(['fail' => 'Sorry this offer does not exist']);
        }
        $offer->delete();
        return redirect()->route('offer.all')->with(['success' => __('message.Offer has been successfully deleted')]);
    }

    public function getVideo()
    {
        $videos = video::first();
        event(new VideoViewer($videos));
        return view('video', compact('videos'));
    }
}
