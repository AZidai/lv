<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $fillable = [
    'body', 'attachment', 'user_id','post_id'
  ];


  public function createComment($input)
  {
    return $this->create($input->all());
  }

  public function updateComment($id, $input)//metoda koja se poziva u kontroleru za akiciju
  {
    $updated = $this->find($id)->update($input);
    $comment = $this->find($id);
    if($updated) {
      return $comment;
    }
      return false;
    }

  public function getComment($id)
    {
      return $this->find($id);
    }

  public function getComments()
    {
      $query = $this;
      return $query->paginate(20);
    }
}
