<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Tracking extends Model
{
    use HasFactory;

    protected $table = 'trackings';
    protected $fillable = [
        'id',
        'id_transaction',
        'id_transport',
        'id_user'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function($tracking){
            $tracking->{$tracking->getKeyName()} = (string) Str::uuid();
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
