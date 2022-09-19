<?php

namespace App\Models\V1\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\V1\Admin\Comment;


class Transaction extends Model
{
    use HasFactory;

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id');
    }


    public function agent(){
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function comment(){
        return $this->hasMany(Comment::class,'transaction_id');
    }

}
