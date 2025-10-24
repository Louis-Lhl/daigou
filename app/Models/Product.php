<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $fillable = ['name','slug','description','price_twd','stock','status','cover_image_url','published_at'];
    protected $casts = ['published_at'=>'datetime'];
}
