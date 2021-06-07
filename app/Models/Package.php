<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Package extends Model
{
    use HasFactory;

    protected $table = 'package';
    protected $fillable = [
        'id',
        'id_user',
        'id_destination',
        'id_origin',
        'id_category',
        'package_name',
        'recepient_name',
        'recepient_phone',
        'weight',
        'dimension'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function($package){
            $package->{$package->getKeyName()} = (string) Str::uuid();
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
