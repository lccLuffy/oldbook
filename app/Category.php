<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function books()
    {
        return $this->belongsToMany('App\Book', 'book_category_pivot');
    }

    public function children()
    {
        return $this->hasMany('App\Category', 'parent_id');
    }

    public function parent()
    {
        return $this->hasOne('App\Category', 'child_id');
    }
}
