<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = [
        'brand_id',
        'category_id',
        'name',
        'slug',
        'author',
        'small_description',
        'description',
        'original_price',
        'selling_price',
        'quantity',
        'trending',
        'featured',
        'status',
        'meta_title',
        'meta_keyword',
        'meta_description',
    ];

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id','id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id','id');
    }

    public function productImages(){
        return $this->hasMany(ProductImage::class, 'product_id','id');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'product_id','id');
    }
}
