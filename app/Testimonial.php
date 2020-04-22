<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use OwenIt\Auditing\Contracts\Auditable;

class Testimonial extends Model implements Auditable
{
  use Notifiable;
  use Sortable;
  use \OwenIt\Auditing\Auditable;

  protected $attributes = [
    'stars' => 5,
    'status' => 0,
    'deleted' => false,
  ];

  public $sortable = [
    'name',
    'company',
    'date',
    'status'
  ];

  protected $fillable = [
    'name',
    'company',
    'text',
    'image',
    'stars',
    'date',
    'status'
  ];
}
