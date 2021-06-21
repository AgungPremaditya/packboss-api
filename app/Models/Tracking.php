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
        'id_user',
        'tracking_status'
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

    /**
     * Get the user that owns the Tracking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Get the transport that owns the Tracking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transport()
    {
        return $this->belongsTo(Transport::class, 'id_transport');
    }

    /**
     * Get the transaction that owns the Tracking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'id_transaction');
    }
}
