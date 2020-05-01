<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
  use Notifiable;
  use Sortable;
  use \OwenIt\Auditing\Auditable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'firstname', 'lastname', 'email', 'password',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  /**
   * The model's default values for attributes.
   *
   * @var array
   */
  protected $attributes = [
    'status' => 1,
    'role' => 'admin',
    'deleted' => false,
  ];

  public $sortable = [
    'firstname',
    'lastname',
    'email',
    'role',
    'status'
  ];

  protected $auditExclude = [
    'password',
    'remember_token'
  ];

  // Get posts written by specific user
  public function posts()
  {
    return $this->hasMany('App\Post');
  }
}
