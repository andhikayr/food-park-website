<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'code' => 'required|max:50',
            'quantity' =>'required',
            'min_purchase_amount' =>'required|max:255',
            'expire_date' =>'required|max:255|date|after_or_equal:today',
            'discount_type' =>'required',
            'discount' =>'required',
            'status' =>'required',
        ];
    }

    public function messages(): array
    {
        return [
            'expire_date.after_or_equal' => 'Tanggal kadaluarsa tidak boleh sebelum tanggal hari ini',
        ];
    }
}
