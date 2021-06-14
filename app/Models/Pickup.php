<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Pickup extends Model
{
    use HasFactory;

    protected $table = 'pickups';
    protected $fillable = [
        'id',
        'id_transaction',
        'id_user',
        'id_transport',
        'pickedup_at',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function($pickup){
            $pickup->{$pickup->getKeyName()} = (string) Str::uuid();
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
     * Get the Transaction that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'id_transaction');
    }
    
    
}
