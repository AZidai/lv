<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $fillable = [
    'body', 'title', 'user_id','attachment','location'
  ];

  public function comments()
  {
    return $this->hasMany('App\Comment','id');
  }
  public function user()
  {
    return $this->hasMany('App\User','id');
  }
}
