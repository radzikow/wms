<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateBannersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('banners', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->string('text_1')->nullable();
      $table->string('text_2')->nullable();
      $table->string('btn_link')->nullable();
      $table->string('btn_text')->nullable();
      $table->string('image');
      $table->integer('status')->default(0);
      $table->boolean('deleted')->default(false);
      $table->timestamps();
    });

    DB::table('banners')->insert([
      [
        'title' => 'Sed non purus.',
        'text_1' => 'Sed non purus vitae dui euismod tempor.',
        'text_2' => 'Mauris tincidunt egestas faucibus.',
        'btn_link' => 'https://xyz.com/',
        'btn_text' => 'See product',
        'image' => '428571888.JPG',
        'status' => 0
      ],
      [
        'title' => 'Pellentesque risus ante.',
        'text_1' => 'Pellentesque risus ante, porttitor at eros a, sodales euismod nunc.',
        'text_2' => 'Praesent pulvinar eu justo id facilisis.',
        'btn_link' => 'https://xyz.com/',
        'btn_text' => 'See product',
        'image' => '556114385.JPG',
        'status' => 1
      ],
      [
        'title' => 'Ut viverra sit amet leo nec finibus.',
        'text_1' => 'Proin mollis eget purus non fermentum. Class aptent taciti sociosqu.',
        'text_2' => 'In auctor magna quis mattis tempor. Etiam fringilla et lacus nec ullamcorper. Nullam et tincidunt tortor.',
        'btn_link' => 'https://xyz.com/',
        'btn_text' => 'See product',
        'image' => '556114385.JPG',
        'status' => 1
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
    Schema::dropIfExists('banners');
  }
}
