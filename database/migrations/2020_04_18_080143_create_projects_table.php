<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateProjectsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('projects', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->string('company')->nullable();
      $table->string('category')->nullable();
      $table->string('description_1')->nullable();
      $table->string('description_2')->nullable();
      $table->string('btn_link')->nullable();
      $table->string('btn_text')->nullable();
      $table->json('list_1')->nullable();
      $table->json('list_2')->nullable();
      $table->string('image');
      $table->integer('status')->default(0);
      $table->boolean('deleted')->default(false);
      $table->timestamps();
    });

    DB::table('projects')->insert([
      [
        'title' => 'Mauris venenatis, orci vel bibendum interdum',
        'company' => 'Donec tincidunt',
        'category' => 'Web application',
        'description_1' => 'Duis nec hendrerit nulla. Aenean tristique, ligula ut condimentum.',
        'description_2' => 'Aenean eget rutrum elit. Curabitur bibendum aliquam sapien convallis volutpat.',
        'btn_link' => 'https://xyz.com/',
        'btn_text' => 'See online',
        'image' => '456177412.JPG',
        'status' => 1
      ],
      [
        'title' => 'Etiam ornare bibendum risus a ultrices interdum',
        'company' => 'Vivamus sed',
        'category' => 'Website',
        'description_1' => 'Aenean tristique, ligula ut condimentum gravida.',
        'description_2' => 'Praesent tristique ex at leo interdum, id condimentum.',
        'btn_link' => 'https://xyz.com/',
        'btn_text' => 'See online',
        'image' => '889192382.JPG',
        'status' => 0
      ],
      [
        'title' => 'Phasellus luctus erat elit interdum',
        'company' => 'Sed hendrerit',
        'category' => 'E-commerce',
        'description_1' => 'Mauris non ligula vulputate, gravida velit sit amet, posuere justo.',
        'description_2' => 'Aliquam eget purus hendrerit, euismod orci vitae.',
        'btn_link' => 'https://xyz.com/',
        'btn_text' => 'See online',
        'image' => '456177412.JPG',
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
    Schema::dropIfExists('projects');
  }
}
