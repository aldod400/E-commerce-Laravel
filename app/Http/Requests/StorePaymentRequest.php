<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'mobile' => ['required', 'min:11', 'numeric'],
            'city'  =>  ['required', 'string'],
            'address' => ['required'],
            'card_number' => ['required', 'numeric','regex:/^4[0-9]{12}(?:[0-9]{3})?/'],
            'expiry_date'=> ['required','regex:/(?:0[1-9]|1[0-2])\/[0-9]{2}/'],
            'cvv_code' => ['required', 'min:3', 'numeric','regex:/^[0-9]{3,4}/'],
        ];
    }
}
