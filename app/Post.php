<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $dates = ['created_at','updated_at','published_at'];

    protected $fillable = [
      'slug','title','excerpt','content','published_at','post_writer_id'
    ];
    public function user(){
      return $this->belongsTo('App\User','user_id');
    }

    public function comments(){
      return $this->hasMany('App\Comment','post_id');
    }
}
