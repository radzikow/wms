<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use OwenIt\Auditing\Contracts\Auditable;

class Setting extends Model implements Auditable
{
  use Notifiable;
  use Sortable;
  use \OwenIt\Auditing\Auditable;

  protected $attributes = [
    'status' => 1,
    'deleted' => false,
  ];

  public $sortable = [
    'nesting',
    'name',
    'status'
  ];

  protected $fillable = [
    'nesting',
    'name',
    'status'
  ];
}
