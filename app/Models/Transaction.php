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
        'receipt_number',
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

    /**
     * Get the Package that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package()
    {
        return $this->belongsTo(Package::class, 'id_package');
    }

    
    /**
     * Get all of the pickup for the Pickup
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pickup()
    {
        return $this->hasOne(Pickup::class);
    }

}
