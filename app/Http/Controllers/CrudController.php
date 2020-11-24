<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;



class CrudController extends Controller
{
    public function __construct()
    {
    }

    public function getOffer()
    {
        return Offer::get();
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

    public function create(){
        return view('offers.create');
    }

    public function store(Request $request){
        $rules=[
            'name'  =>'required|max:100|unique:Offers,name',
            'price'  =>'required|numeric',
            'details'  =>'required|max:100',
        ];
        $validator=Validator::make($request->all(),$rules);
        if($validator -> fails()){
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        Offer::create([
            'name'      =>$request['name'],
            'price'      =>$request['price'],
            'details'      =>$request['details'],
        ]);
        return redirect()->back()->with(['success'=>__('message.Offer has been added successfully')]);
    }

}
