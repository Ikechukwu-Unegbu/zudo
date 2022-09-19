<?php

namespace App\Models\V1\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\V1\Admin\Transaction;
use App\Models\User;


class Comment extends Model
{
    use HasFactory, SoftDeletes;

    public function transaction(){
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    // public function transaction(){
    //     return $this->belongsTo(Transaction::class, 'transaction_id');
    // }
}
