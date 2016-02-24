<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $dates = ['delete_at'];

    protected $fillable =
        ['name', 'description', 'price', 'address', 'is_draft', 'phone_number', 'other_contact_way'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function pictures()
    {
        return $this->hasMany('App\Picture');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'book_category_pivot');
    }

    public function syncCategories(array $categories)
    {
        if (count($categories)) {
            $this->categories()->sync($categories);
            return;
        }

        $this->categories()->detach();
    }
}
