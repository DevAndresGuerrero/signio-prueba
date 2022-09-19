<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Country implements Rule {
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) {
        return (bool) array_filter(getCountries(), fn ($country) => $country == $value, ARRAY_FILTER_USE_KEY);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message() {
        return 'The :attribute must be specified in select is invalid';
    }
}
