<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Destination extends Model
{
    use HasFactory;
    
    protected $table = 'destinations';
    protected $fillable = [
        'id',
        'country_name',
        'province_name',
        'region_name',
        'postal_code',
        'detail_address'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function($destination){
            $destination->{$destination->getKeyName()} = (string) Str::uuid();
        });
    }

    public function getIncrementing()
    {
        return false;
    }


    public function getKeyType()
    {
        return 'string';
    }

}
