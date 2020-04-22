<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTopicsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('topics', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->text('description')->nullable();
      $table->integer('status')->default(1);
      $table->timestamps();
      $table->boolean('deleted')->default(false);
    });

    DB::table('topics')->insert([
      [
        'name' => 'Technology',
        'description' => 'no description',
        'status' => 1
      ],
      [
        'name' => 'News',
        'description' => 'no description',
        'status' => 1
      ],
      [
        'name' => 'Reviews',
        'description' => 'no description',
        'status' => 1
      ],
      [
        'name' => 'Culture',
        'description' => 'no description',
        'status' => 0
      ]
    ]);
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('topics');
  }
}
