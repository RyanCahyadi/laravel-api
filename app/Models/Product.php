<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'desc', 'brand_id'
    ];

    protected $table = 'products';

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

}
