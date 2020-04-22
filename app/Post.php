<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use OwenIt\Auditing\Contracts\Auditable;

class Post extends Model implements Auditable
{
  use Notifiable;
  use Sortable;
  use \OwenIt\Auditing\Auditable;

  // /**
  //  * The table associated with the model.
  //  *
  //  * @var string
  //  */
  // protected $table = 'my_posts';

  protected $attributes = [
    'status' => 1,
    'views' => 0,
    'comments' => 0,
    'deleted' => false,
  ];

  public $sortable = [
    'title',
    'user_id',
    'date',
    'views',
    'topic_id',
    'status',
  ];

  protected $fillable = [
    'date',
    'title',
    'tags',
    'short_text',
    'long_text',
    'image'
  ];

  // Get use who has written a post
  public function user()
  {
    return $this->belongsTo('App\User', 'user_id');
  }

  // Get comments that belong to post
  public function comments()
  {
    return $this->hasMany('App\Comment');
  }

  // Get topic related to this post
  public function topic()
  {
    return $this->hasOne('App\Topic');
  }

  // Get topic related to this post
  public function topics()
  {
    return $this->hasMany('App\Topic');
  }
}
