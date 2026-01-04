<?php

namespace App\Services;

class PasswordGenerator
{
    public static function generate(
        int $length = 16,
        bool $uppercase = true,
        bool $lowercase = true,
        bool $numbers = true,
        bool $symbols = true
    ): string {
        $chars = '';
        
        if ($lowercase) $chars .= 'abcdefghijklmnopqrstuvwxyz';
        if ($uppercase) $chars .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if ($numbers) $chars .= '0123456789';
        if ($symbols) $chars .= '!@#$%^&*()-_=+[]{}|;:,.<>?';
        
        if (empty($chars)) {
            throw new \Exception('Debe seleccionar al menos un tipo de carácter');
        }
        
        $password = '';
        $charsLength = strlen($chars);
        
        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[random_int(0, $charsLength - 1)];
        }
        
        return $password;
    }
}