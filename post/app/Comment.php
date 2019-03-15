<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $fillable = [
    'body', 'attachment', 'user_id','post_id'
  ];

  //elloquent relationships
  public function post()
  {
      return $this->belongsTo('App/Post');
  }
  
  public function user()
  {
    return $this->belongsTo('App/User');
  }
}

