<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    
    protected $table = 'categories';
    protected $fillable = [
        'id',
        'category_name',
        'is_fragile',
        'is_hazardous'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function($category){
            $category->{$category->getKeyName()} = (string) Str::uuid();
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
