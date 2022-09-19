<?php

namespace App\Models\V1\Public;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
