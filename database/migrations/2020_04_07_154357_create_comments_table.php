<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCommentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('comments', function (Blueprint $table) {
      $table->id();
      $table->string('nickname');
      $table->string('firstname')->nullable();
      $table->string('lastname')->nullable();
      $table->foreignId('post_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
      $table->text('text');
      $table->integer('likes')->default(0);
      $table->date('added_at')->useCurrent();
      // Default statusis 2, which means "waiting for accept"
      $table->boolean('status')->default(2);
      $table->boolean('deleted')->default(false);
      $table->timestamps();
    });

    DB::table('comments')->insert([
      [
        'nickname' => 'radzikow',
        'post_id' => 1,
        'text' => 'Wow! This is really good article.',
        'added_at' => '2020-04-04',
        'status' => 1
      ],
      [
        'nickname' => 'kingkong',
        'post_id' => 1,
        'text' => 'Hahah! This is good one!',
        'added_at' => '2020-04-11',
        'status' => 0
      ],
      [
        'nickname' => 'johnny',
        'post_id' => 2,
        'text' => 'Hahah! This is good one!',
        'added_at' => '2020-03-24',
        'status' => 2
      ],
      [
        'nickname' => 'schwarz',
        'post_id' => 1,
        'text' => 'Hasta la vista!',
        'added_at' => '2020-02-25',
        'status' => 1
      ],
      [
        'nickname' => 'pig123',
        'post_id' => 2,
        'text' => 'Can you write article about coronavirus? It would be great!',
        'added_at' => '2020-03-21',
        'status' => 0
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
    Schema::dropIfExists('comments');
  }
}
