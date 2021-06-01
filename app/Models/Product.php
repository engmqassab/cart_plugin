<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'category_id', 'description', 'price',
        'sale_price', 'image', 'quantity', 
    ];

    protected $appends = [
        'final_price', 'image_url'
    ];

    protected $hidden = [
        'image'
    ];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('images/' . $this->image);
        }

        return asset('images/default-image.png');
    }

    public function getFinalPriceAttribute()
    {
        if ($this->sale_price > 0) {
            return $this->sale_price;
        }
        return $this->price;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function orders()
    {
        return $this->belongsToMany(Orders::class , 'order_products')
        ->using(OrderProduct::class)
        ->withPivot([
            'quantity',
            'price'
        ]);
    }

}
