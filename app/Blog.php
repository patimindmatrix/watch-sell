<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['name', 'picture', 'author', 'title', 'content', 'description',
        'quote', 'status', 'type', 'slug'];

    public function category(){
        return $this->belongsTo("App\BlogCategory", "category_id");
    }

    public function tags(){

    }

    public function comments(){
        return $this->hasMany("App\Comment", "post_id");
    }
}
