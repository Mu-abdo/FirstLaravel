<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:500|unique:offers,name',
            'price' => 'required|numeric',
            'details' => 'required',
        ];
    }

    public function messages(){
        return [
            'name.required' => __('messages.offer_name_required'),
            'name.unique' => 'العرض موجود سابقا',
            'price.numeric' => 'مطلوب ارقام',
            'price.required' => 'يرجي اضافه سعر للخصم',
            'details.required' => 'يرجي اضافه تفاصيل',
        ];
    }
}
