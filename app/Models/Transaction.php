<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;
    
    protected $table = 'transactions';
    protected $fillable = [
        'id',
        'id_package',
        'id_user',
        'transaction_date',
        'price_per_kg',
        'total_price',
        'status'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function($transaction){
            $transaction->{$transaction->getKeyName()} = (string) Str::uuid();
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
