<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Budget extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id','category_id','year','month','limit_amount','spent_amount'
    ];

    protected $casts = [
        'year' => 'integer',
        'month' => 'integer',
        'limit_amount' => 'decimal:2',
        'spent_amount' => 'decimal:2',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function category() { return $this->belongsTo(Category::class); }
}
