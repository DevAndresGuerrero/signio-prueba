<?php

use Illuminate\Support\Facades\Http;

if (!function_exists('getCountries')) {
    function getCountries() {
        $url    = "https://api.first.org/data/v1/countries?region=South+America&pretty=true";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($result, true)['data'];

        return array_map(fn ($item) => $item['country'], $data);
    }
}

// https://api.first.org/data/v1/countries?region=South+America&q=CO&pretty=true

if (!function_exists('getCountry')) {
    function getCountry($query = 'CO') {
        $url = "https://api.first.org/data/v1/countries?region=South+America&q={$query}&pretty=true";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($result, true)['data'];

        return array_map(fn ($item) => $item['country'], $data);
    }
}