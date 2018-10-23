<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [
      'slug','title','excerpt','content','published_at','post_writer_id'      
    ];
    public function user(){
      return $this->belongsTo('App\User','post_writer_id');
    }
}
