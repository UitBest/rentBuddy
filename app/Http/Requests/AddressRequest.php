<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
//        return Auth::check();
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'street' => 'required',
            'postal_code' => 'required',
            'city_id' => 'required|exists:cities,id',
        ];
    }

    /**
     * Define validation rule messages for store and update requests.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'street.required' => 'Street is required',
            'postal_code.required' => 'Postal code is required',
            'city_id.required' => 'City is required',
            'city_id.exists' => 'City does not exist',
        ];
    }
}
