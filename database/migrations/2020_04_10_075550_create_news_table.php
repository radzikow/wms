<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateNewsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('news', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
      $table->date('date');
      $table->string('title');
      $table->text('content');
      $table->string('image');
      $table->integer('status')->default(1);
      $table->boolean('deleted')->default(false);
      $table->timestamps();
    });

    DB::table('news')->insert([
      [
        'content' => 'Proin eget mauris ac mi blandit pretium at semper neque. Vestibulum tempor ultricies ante sed ullamcorper. Ut molestie ultrices pellentesque. In bibendum metus sit amet urna iaculis pulvinar. Cras ac mi urna.',
        'date' => '2020-04-15',
        'image' => 'no image',
        'status' => 1,
        'title' => 'Information about coronavirus',
        'user_id' => 1,
      ],
      [
        'content' => 'Proin eget mauris ac mi blandit pretium at semper neque. Vestibulum tempor ultricies ante sed ullamcorper. Ut molestie ultrices pellentesque. In bibendum metus sit amet urna iaculis pulvinar. Cras ac mi urna.',
        'date' => '2020-04-18',
        'image' => 'no image',
        'status' => 0,
        'title' => 'Holiday leaves of doctors in April',
        'user_id' => 1,
      ],
      [
        'content' => 'Proin eget mauris ac mi blandit pretium at semper neque. Vestibulum tempor ultricies ante sed ullamcorper. Ut molestie ultrices pellentesque. In bibendum metus sit amet urna iaculis pulvinar. Cras ac mi urna.',
        'date' => '2020-04-05',
        'image' => 'no image',
        'status' => 1,
        'title' => 'The shop is closed',
        'user_id' => 1,
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
    Schema::dropIfExists('news');
  }
}
