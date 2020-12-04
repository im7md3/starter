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
            'photo'     =>'required',
            'name_ar'  =>'required|max:100|unique:Offers,name_ar',
            'name_en'  =>'required|max:100|unique:Offers,name_en',
            'price'  =>'required|numeric',
            'details_ar'  =>'required|max:100',
            'details_en'  =>'required|max:100',
        ];
    }
    public function messages(){
        return [
            'name_ar.required'  =>__("message.The name field is required"),
            'name_ar.unique'  =>__("message.The name has already been taken"),
            'name_en.required'  =>__("message.The name field is required"),
            'name_en.unique'  =>__("message.The name has already been taken"),
            'price.required'  =>__("message.The price field is required"),
            'details_ar.required'  =>__("message.The details field is required"),
            'details_en.required'  =>__("message.The details field is required"),
            
        ];
    }

}
