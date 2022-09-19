<?php

namespace App\Models\V1\Public;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complain extends Model
{
    use HasFactory, SoftDeletes;

    public function complainant(){
        return $this->belongsTo(User::class, 'complainant_id');
    }

    public function resolver(){
        return $this->belongsTo(User::class, 'resolver_id');
    }
}
