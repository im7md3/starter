<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\OfferRequest;
use LaravelLocalization;


class CrudController extends Controller
{
    public function __construct()
    {
    }

    public function getAllOffers()
    {
        $offers = Offer::select(
            'id',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'price',
            'details_' . LaravelLocalization::getCurrentLocale(). ' as details',
        )->get();
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

    public function store(OfferRequest $request)
    {

        /* $validator=Validator::make($request->all(),$rules);
        if($validator -> fails()){
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } */

        Offer::create([
            'name_ar'           => $request->name_ar,
            'name_en'           => $request->name_en,
            'price'             => $request->price,
            'details_ar'        => $request->details_ar,
            'details_en'        => $request->details_en,
        ]);
        return redirect()->back()->with(['success' => __('message.Offer has been added successfully')]);
    }
}
