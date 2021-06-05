<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Origin extends Model
{
    use HasFactory;
    
    protected $table = 'origins';
    protected $fillable = [
        'id',
        'id_user',
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

    /**
     * Get the user that owns the Origin
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
