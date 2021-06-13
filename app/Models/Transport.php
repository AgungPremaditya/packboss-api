<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Transport extends Model
{
    use HasFactory;

    protected $table = 'transports';
    protected $fillable = [
        'id',
        'name',
        'license_number',
        'transport_type',
        'transport_code'
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
