<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','stu_num','user_info','address','nickname'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function books()
    {
        return $this->hasMany('App\Book');
    }
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function beBoughtOrders()
    {
        return $this->hasMany('App\Order','seller_id');
    }

    public function getUserInfoAttribute($value)
    {
        return json_decode($value,true);
    }
}
