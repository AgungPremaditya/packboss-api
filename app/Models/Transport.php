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
        'status',
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

    /**
     * Get all of the tracking for the Transport
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tracking(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
