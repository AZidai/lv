<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $fillable = [
    'body', 'title', 'user_id','attachment','location','comment_id'
  ];

  protected $hidden = [
    'user_id'
  ];
  public function comments()
  {
    return $this->hasMany('App\Comment');
  }
  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
