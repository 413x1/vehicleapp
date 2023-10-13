<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'plat_code',
        'content',
        'is_owned',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

}
