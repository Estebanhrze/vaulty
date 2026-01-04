<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vault extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'name', 'icon'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function passwords()
    {
        return $this->hasMany(Password::class);
    }
}