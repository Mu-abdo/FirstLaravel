<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Offer;

class CrudController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // kkk
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getOffers()
    {
        return Offer::get();
    }

    public function createOffer(){
        return view('create');
    }

    public function store(OfferRequest $request){

        Offer::create([
            'name'=> $request->name,
            'price'=> $request->price,
            'details'=> $request->details,
        ]);
        return redirect()->back()->with(['success'=>'تم اضافه العرض بنجاح']);
    }

    public function getOfferAll(){
        $Offers = Offer::select('id','name','price','details')->get();
        return view('alloffers', compact('Offers'));
    }

}
