<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use OwenIt\Auditing\Contracts\Auditable;

class Banner extends Model implements Auditable
{
  use Notifiable;
  use Sortable;
  use \OwenIt\Auditing\Auditable;

  protected $attributes = [
    'status' => 0,
    'deleted' => false,
  ];

  public $sortable = [
    'title',
    'status',
  ];

  protected $fillable = [
    'title',
    'text_1',
    'text_2',
    'btn_link',
    'btn_text',
    'image',
  ];
}
