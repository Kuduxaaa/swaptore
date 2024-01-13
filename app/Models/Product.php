<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'images',
        'title',
        'description',
        'price',
        'discounted_price',
        'category_id'
    ];

    public function productOptions()
    {
        return $this->hasMany(ProductOptions::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Orders::class);
    }

    public function getImagesAttribute($value)
    {
        return json_decode($value, true);
    }

    public function getFormatedPriceAttribute($value)
    {
        return number_format($this->attributes['price'], 2, '.', ',');
    }  
    
    public function getFormatedDiscountedPriceAttribute($value)
    {
        return number_format($this->attributes['discounted_price'], 2, '.', ',');
    }  
}
