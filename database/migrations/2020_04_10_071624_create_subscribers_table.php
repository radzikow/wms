<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSubscribersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('subscribers', function (Blueprint $table) {
      $table->id();
      $table->string('firstname');
      $table->string('lastname')->nullable();
      $table->string('email')->unique();
      $table->string('phone')->nullable();
      $table->string('country')->nullable();
      $table->string('city')->nullable();
      $table->timestamps();
    });

    DB::table('subscribers')->insert([
      [
        'firstname' => 'John',
        'lastname' => 'Doe',
        'email' => 'john@mail.com',
        'phone' => '123-987-456'
      ],
      [
        'firstname' => 'Jane',
        'lastname' => 'Doe',
        'email' => 'jane@mail.com',
        'phone' => '123-987-456'
      ],
      [
        'firstname' => 'Radek',
        'lastname' => 'Doe',
        'email' => 'radek@mail.com',
        'phone' => '123-987-456'
      ],
      [
        'firstname' => 'Steve',
        'lastname' => 'Doe',
        'email' => 'steve@mail.com',
        'phone' => '123-987-456'

      ],
    ]);
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('subscribers');
  }
}
