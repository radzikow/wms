<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTestimonialsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('testimonials', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('company')->nullable();
      $table->text('text');
      $table->string('image')->nullable();
      $table->integer('stars')->default(5);
      $table->date('date')->nullable();
      $table->integer('status')->default(1);
      $table->boolean('deleted')->default(false);
      $table->timestamps();
    });

    DB::table('testimonials')->insert([
      [
        'name' => 'John Doe',
        'company' => 'Green Energy Ltd.',
        'text' => 'Proin eget mauris ac mi blandit pretium at semper neque. Vestibulum tempor ultricies ante sed ullamcorper. Ut molestie ultrices pellentesque. ',
        'image' => '146000999.JPG',
        'stars' => 5,
        'date' => '2020-02-06',
        'status' => 1
      ],
      [
        'name' => 'Jonathan Doe',
        'company' => 'Bee Group Ltd.',
        'text' => 'Curabitur laoreet felis lectus. Duis eget metus leo. Maecenas pretium, sapien eget tempus mollis, massa. ',
        'image' => '146000999.JPG',
        'stars' => 5,
        'date' => '2020-03-25',
        'status' => 1
      ],
      [
        'name' => 'David Doe',
        'company' => 'Globe Ltd.',
        'text' => 'Mauris venenatis, orci vel bibendum interdum, tellus lorem semper orci, eu sollicitudin nulla sapien vulputate.',
        'image' => '146000999.JPG',
        'stars' => 5,
        'date' => '2020-04-11',
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
    Schema::dropIfExists('testimonials');
  }
}
