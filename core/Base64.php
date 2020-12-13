<?php

namespace Core;

class Base64
{
    public static function decode(string $base64): string
    {
        $start = strpos($base64, ',') + 1;
        $data = substr($base64, $start);
        return base64_decode($data);
    }
}
