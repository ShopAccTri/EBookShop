<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $table = "comments";

    protected $fillable = [
        'user_id',
        'product_id',
        'comment_body',
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
