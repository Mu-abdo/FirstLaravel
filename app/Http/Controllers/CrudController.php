<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    // public function store(){
    //     Offer::create([
    //         'name' => 'ahmed',
    //         'price' => '500',
    //         'details' => 'bla bla bla',
    //     ]);
    // }


    public function createOffer(){
        return view('create');
    }

    public function store(Request $request){
        // return $request;
        Offer::create([
            'name'=> $request->name,
            'price'=> $request->price,
            'details'=> $request->details,
        ]);
        return $request->name .'succfuly submit';
    }
}
