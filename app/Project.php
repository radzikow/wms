<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use OwenIt\Auditing\Contracts\Auditable;

class Project extends Model implements Auditable
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
    'company',
    'category',
    'status'
  ];

  protected $fillable = [
    'title',
    'company',
    'category',
    'description_1',
    'description_2',
    'btn_link',
    'btn_text',
    'list_1',
    'list_2',
    'image',
    'status'
  ];
}
