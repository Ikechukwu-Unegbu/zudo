<?php

namespace App\Models;

use App\Models\V1\Admin\Comment;
use App\Models\V1\Admin\Transaction;
use App\Models\V1\Public\Complain;
use App\Models\V1\Public\Request;
use App\Models\V1\Public\Testimony;
use App\Models\V1\Users\Bankaccount;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function routeNotificationForVonage($notifiable){
        return $this->phone;
    }

    public function deposit(){
        return $this->hasMany(Transaction::class, 'agent_id');
    }

    public function mydeposit(){
        return $this->hasMany(Transaction::class, 'customer_id');
    }

    public function totaContribution($id){
        return Transaction::where('customer_id', $id)->sum('amount');
    }

    public function totalWithdrawal($id){
        return Request::where('customer_id', $id)->where('approved', 1)->sum('amount');
    }

    public function mybalance($id){
        return Transaction::where('customer_id', $id)->sum('amount') - Request::where('customer_id', $id)->where('approved', 1)->sum('amount');

    }

    public function comment(){
        return $this->hasMany(Comment::class);
    }

    public function complainant(){
        return $this->hasMany(Complain::class, 'complainant_id');
    }

    public function resolver(){
        return $this->hasMany(Complain::class, 'resolver_id');
    }

    public function testimony(){
        return $this->hasMany(Testimony::class, 'user_id');
    }

    public function customer(){
        return $this->hasMany(Request::class, 'customer_id');
    }

    // public function

    public function bankaccount(){
        return $this->hasMany(Bankaccount::class, 'user_id');
    }

}
