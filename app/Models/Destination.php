<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Destination extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'country_name',
        'province_name',
        'region_name',
        'postal_code',
        'detail_address'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function($user){
            $user->{$user->getKeyName()} = (string) Str::uuid();
        });
    }
}
