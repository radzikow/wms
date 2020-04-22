<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use OwenIt\Auditing\Contracts\Auditable;

class Comment extends Model implements Auditable
{
  use Notifiable;
  use Sortable;
  use \OwenIt\Auditing\Auditable;

  protected $attributes = [
    'status' => 2,
    'likes' => 0,
    'deleted' => false,
  ];

  public $sortable = [
    'nickname',
    'firstname',
    'lastname',
    'post_id',
    'text',
    'added_at',
    'status',
  ];

  protected $fillable = [
    'nickname',
    'firstname',
    'lastname',
    'comment',
  ];

  // Get post to which this comment belong
  public function post()
  {
    return $this->belongsTo('App\Post');
  }
}
