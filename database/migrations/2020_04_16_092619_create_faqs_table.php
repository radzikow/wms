<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFaqsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('faqs', function (Blueprint $table) {
      $table->id();
      $table->string('question');
      $table->text('answer');
      $table->integer('status')->default(1);
      $table->boolean('deleted')->default(false);
      $table->timestamps();
    });

    DB::table('faqs')->insert([
      [
        'question' => 'Mauris venenatis, orci vel bibendum interdum?',
        'answer' => 'Donec tincidunt, odio a gravida vehicula, metus erat vulputate ex, ut laoreet orci arcu id nisl. Proin ultricies nisi non lorem tincidunt efficitur.',
        'status' => 1
      ],
      [
        'question' => 'Proin eget mauris ac mi blandit pretium at semper neque?',
        'answer' => 'Etiam eu metus egestas, accumsan metus sit amet, consectetur lorem. Maecenas elit orci, faucibus vel dapibus eu, posuere et felis.',
        'status' => 0
      ],
      [
        'question' => 'Vestibulum tempor ultricies ante sed ullamcorper?',
        'answer' => 'Praesent imperdiet ipsum turpis, ut interdum tortor tincidunt eu. Nunc consequat molestie risus vel molestie. Aliquam erat volutpat.',
        'status' => 1
      ],
      [
        'question' => 'Mauris venenatis, orci vel bibendum interdum?',
        'answer' => 'Donec tincidunt, odio a gravida vehicula, metus erat vulputate ex, ut laoreet orci arcu id nisl. Proin ultricies nisi non lorem tincidunt efficitur.',
        'status' => 1
      ],
      [
        'question' => 'Proin eget mauris ac mi blandit pretium at semper neque?',
        'answer' => 'Etiam eu metus egestas, accumsan metus sit amet, consectetur lorem. Maecenas elit orci, faucibus vel dapibus eu, posuere et felis.',
        'status' => 0
      ],
      [
        'question' => 'Vestibulum tempor ultricies ante sed ullamcorper?',
        'answer' => 'Praesent imperdiet ipsum turpis, ut interdum tortor tincidunt eu. Nunc consequat molestie risus vel molestie. Aliquam erat volutpat.',
        'status' => 1
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
    Schema::dropIfExists('faqs');
  }
}
