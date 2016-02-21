<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = ['url'];

    public function book()
    {
        return $this->belongsTo('App\Book');
    }
}
