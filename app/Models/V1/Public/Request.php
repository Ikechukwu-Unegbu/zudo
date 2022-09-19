<?php

namespace App\Models\V1\Public;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id');
    }
}
