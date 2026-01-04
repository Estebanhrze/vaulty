<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Password extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'vault_id', 'title', 'username',
        'password_encrypted', 'url', 'notes', 'is_favorite'
    ];

    protected $casts = [
        'is_favorite' => 'boolean',
        'last_used_at' => 'datetime',
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

    public function vault()
    {
        return $this->belongsTo(Vault::class);
    }
}