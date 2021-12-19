<?php

namespace App\Helpers;


class StringHelper {
    public static function is_null_or_empty_string($str){
        return (!isset($str) || trim($str) === "" || strlen($str) > 25);
    }
}