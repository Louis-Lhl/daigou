<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    protected $fillable = [
      'user_id','order_no','status','subtotal_twd','shipping_fee_twd','total_twd',
      'payment_method','payment_proof_path','payment_verified_at',
      'receiver_name','receiver_phone','receiver_address','placed_at'
    ];
    protected $casts = ['payment_verified_at'=>'datetime','placed_at'=>'datetime'];
    public function items(){ return $this->hasMany(OrderItem::class); }
    public function user(){ return $this->belongsTo(User::class); }
}
