<?php

namespace App\Http\Requests;

use App\Rules\Country;
use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() {
        return [
            'name'           => ['required', 'string', 'min:5', 'max:100'],
            'lastname'       => ['required', 'string', 'min:5', 'max:100'],
            'dni'            => ['required', 'string', 'unique:users'],
            'email'          => ['required', 'string', 'email', 'max:150', 'unique:users'],
            'country'        => ['required', new Country()],
            'address'        => ['required', 'string', 'max:180'],
            'phone'          => ['required', 'string', 'max:10'],
            'category_id'    => ['string', 'exists:categories,id'],
            'password'       => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
