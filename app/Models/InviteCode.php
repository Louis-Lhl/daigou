<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InviteCode extends Model {
    protected $fillable = ['code','max_uses','used_count','expires_at','status'];
    protected $casts = ['expires_at'=>'datetime'];
    public function users(){ return $this->hasMany(User::class); }
    public function isUsable(): bool {
        return $this->status==='ACTIVE'
            && (!$this->expires_at || $this->expires_at->isFuture())
            && $this->used_count < $this->max_uses;
    }
}

