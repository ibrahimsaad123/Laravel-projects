<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'title',
        'desc',
        'user_id'
    ];
    public function details ()
    {
        return $this -> hasOne(ProductDetail::class,'product_id','id');
    }
    public function image()
    {
        return $this->morphOne('App\Models\Image','imagable');
    }
    public function reviwes ()
    {
        return $this->hasMany(Review::class,'product_id','id');
    }
    public function user ()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }


}
