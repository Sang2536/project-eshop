<?php

if (!function_exists('formatDate')) {
    function formatDate($date, string $format = 'Y/m/d')
    {
        if ($date instanceof \Carbon\Carbon) {
            return $date->format($format);
        }

        return $date;
    }
}

if (!function_exists('formatDatetime')) {
    function formatDatetime($date, string $format = 'Y/m/d H:i:s')
    {
        if ($date instanceof \Carbon\Carbon) {
            return $date->format($format);
        }

        return $date;
    }
}

if (!function_exists('formatCurrency')) {
    function formatCurrency($currency, string $char = '.')
    {
        $format_currency = substr($currency, 0, -5);

        return $format_currency;
    }
}

if (!function_exists('generateRandomString')) {
    function generateRandomString(string $input, int $lenght = 8)
    {
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $lenght; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }
}

if (!function_exists('uploadPhoto')) {
    function uploadPhoto($photo)
    {
        $url_photo = null;

        return $url_photo;
    }
}
