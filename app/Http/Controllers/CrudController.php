<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function store(Request $request){
        $rules = $this -> getRules();
        $message = $this -> getMessage();

        $validator = validator::make($request->all(), $rules, $message);
        if($validator -> fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        Offer::create([
            'name'=> $request->name,
            'price'=> $request->price,
            'details'=> $request->details,
        ]);
        return redirect()->back()->with(['success'=>'تم اضافه العرض بنجاح']);
    }

    public function getRules(){
        return $rules = [
            'name' => 'required|max:500|unique:offers,name',
            'price' => 'required|numeric',
            'details' => 'required',
        ];
    }
    public function getMessage(){
        return $message = [
            'name.required' => __('messages.offer_name_required'),
            'name.unique' => 'العرض موجود سابقا',
            'price.numeric' => 'مطلوب ارقام',
            'price.required' => 'يرجي اضافه سعر للخصم',
            'details.required' => 'يرجي اضافه تفاصيل',
        ];
    }
}
