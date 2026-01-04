<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class GeneratedPassword extends Model
{
    protected $fillable = [
        'user_id', 'password_encrypted', 'length',
        'has_uppercase', 'has_lowercase', 'has_numbers',
        'has_symbols', 'was_used'
    ];

    protected $casts = [
        'has_uppercase' => 'boolean',
        'has_lowercase' => 'boolean',
        'has_numbers' => 'boolean',
        'has_symbols' => 'boolean',
        'was_used' => 'boolean',
    ];

    protected function passwordEncrypted(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => decrypt($value),
            set: fn ($value) => encrypt($value),
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}   