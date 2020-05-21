<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePostsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('posts', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
      $table->date('date');
      $table->string('title');
      $table->foreignId('topic_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
      $table->string('tags');
      $table->text('short_text');
      $table->text('long_text');
      $table->string('image_public_path')->nullable();
      $table->string('image_s3_path')->nullable();
      $table->integer('status')->default(1);
      $table->integer('views')->default(0);
      $table->integer('comments')->default(0);
      $table->boolean('deleted')->default(false);
      $table->timestamps();
    });

    DB::table('posts')->insert([
      [
        'user_id' => 3,
        'date' => '2020-04-14',
        'title' => '3 JavaScript Performance Mistakes You Should Stop Doing',
        'topic_id' => 1,
        'tags' => 'angular frontend technology news',
        'short_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent quis nisi aliquam, finibus mauris et, malesuada justo. Proin sed tincidunt dolor. Mauris venenatis, orci vel bibendum interdum, tellus lorem semper orci, eu sollicitudin nulla sapien vulputate risus. Ut viverra sit amet leo nec finibus. Proin eget mauris ac mi blandit pretium at semper neque.',
        'long_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent quis nisi aliquam, finibus mauris et, malesuada justo. Proin sed tincidunt dolor. Mauris venenatis, orci vel bibendum interdum, tellus lorem semper orci, eu sollicitudin nulla sapien vulputate risus. Ut viverra sit amet leo nec finibus. Proin eget mauris ac mi blandit pretium at semper neque. Vestibulum tempor ultricies ante sed ullamcorper. Ut molestie ultrices pellentesque. In bibendum metus sit amet urna iaculis pulvinar. Cras ac mi urna. Sed non purus vitae dui euismod tempor. Maecenas a purus semper, sollicitudin ante ut, tincidunt ex. Curabitur laoreet felis lectus. Duis eget metus leo. Maecenas pretium, sapien eget tempus mollis, massa tellus gravida tortor, vel varius erat nulla eget enim. Cras pharetra posuere risus interdum elementum. Proin vel gravida lorem.

        Cras porttitor sodales mauris, at tristique lacus placerat et. Donec eget nisi vehicula, consequat diam sit amet, molestie mi. Maecenas ornare ultrices nulla ut vestibulum. Etiam eget luctus nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam vitae magna eget ante varius condimentum eu id risus. Ut purus ipsum, egestas id consequat et, efficitur ut felis. Cras placerat ut enim vitae laoreet. Aliquam erat volutpat. Curabitur rutrum ligula sit amet nunc hendrerit, id tincidunt enim viverra. Aliquam erat volutpat.

        Cras porttitor sodales mauris, at tristique lacus placerat et. Donec eget nisi vehicula, consequat diam sit amet, molestie mi. Maecenas ornare ultrices nulla ut vestibulum. Etiam eget luctus nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam vitae magna eget ante varius condimentum eu id risus. Ut purus ipsum, egestas id consequat et, efficitur ut felis. Cras placerat ut enim vitae laoreet. Aliquam erat volutpat. Curabitur rutrum ligula sit amet nunc hendrerit, id tincidunt enim viverra. Aliquam erat volutpat.
        ',
        'image_public_path' => '1488153671.JPG',
        'image_s3_path' => '1488153671.JPG',
        'status' => 1,
      ],
      [
        'user_id' => 2,
        'date' => '2020-04-01',
        'title' => 'WeWork’s 15,000 Employees Are in Purgatory',
        'topic_id' => 2,
        'tags' => 'angular frontend technology news',
        'short_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent quis nisi aliquam, finibus mauris et, malesuada justo. Proin sed tincidunt dolor. Mauris venenatis, orci vel bibendum interdum, tellus lorem semper orci, eu sollicitudin nulla sapien vulputate risus. Ut viverra sit amet leo nec finibus. Proin eget mauris ac mi blandit pretium at semper neque.',
        'long_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent quis nisi aliquam, finibus mauris et, malesuada justo. Proin sed tincidunt dolor. Mauris venenatis, orci vel bibendum interdum, tellus lorem semper orci, eu sollicitudin nulla sapien vulputate risus. Ut viverra sit amet leo nec finibus. Proin eget mauris ac mi blandit pretium at semper neque. Vestibulum tempor ultricies ante sed ullamcorper. Ut molestie ultrices pellentesque. In bibendum metus sit amet urna iaculis pulvinar. Cras ac mi urna. Sed non purus vitae dui euismod tempor. Maecenas a purus semper, sollicitudin ante ut, tincidunt ex. Curabitur laoreet felis lectus. Duis eget metus leo. Maecenas pretium, sapien eget tempus mollis, massa tellus gravida tortor, vel varius erat nulla eget enim. Cras pharetra posuere risus interdum elementum. Proin vel gravida lorem.

        Cras porttitor sodales mauris, at tristique lacus placerat et. Donec eget nisi vehicula, consequat diam sit amet, molestie mi. Maecenas ornare ultrices nulla ut vestibulum. Etiam eget luctus nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam vitae magna eget ante varius condimentum eu id risus. Ut purus ipsum, egestas id consequat et, efficitur ut felis. Cras placerat ut enim vitae laoreet. Aliquam erat volutpat. Curabitur rutrum ligula sit amet nunc hendrerit, id tincidunt enim viverra. Aliquam erat volutpat.

        Cras porttitor sodales mauris, at tristique lacus placerat et. Donec eget nisi vehicula, consequat diam sit amet, molestie mi. Maecenas ornare ultrices nulla ut vestibulum. Etiam eget luctus nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam vitae magna eget ante varius condimentum eu id risus. Ut purus ipsum, egestas id consequat et, efficitur ut felis. Cras placerat ut enim vitae laoreet. Aliquam erat volutpat. Curabitur rutrum ligula sit amet nunc hendrerit, id tincidunt enim viverra. Aliquam erat volutpat.
        ',
        'image_public_path' => '1488153671.JPG',
        'image_s3_path' => '1488153671.JPG',
        'status' => 0,
      ],
      [
        'user_id' => 3,
        'date' => '2020-04-19',
        'title' => 'The most important skill a programmer can learn',
        'topic_id' => 3,
        'tags' => 'angular frontend technology news',
        'short_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent quis nisi aliquam, finibus mauris et, malesuada justo. Proin sed tincidunt dolor. Mauris venenatis, orci vel bibendum interdum, tellus lorem semper orci, eu sollicitudin nulla sapien vulputate risus. Ut viverra sit amet leo nec finibus. Proin eget mauris ac mi blandit pretium at semper neque.',
        'long_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent quis nisi aliquam, finibus mauris et, malesuada justo. Proin sed tincidunt dolor. Mauris venenatis, orci vel bibendum interdum, tellus lorem semper orci, eu sollicitudin nulla sapien vulputate risus. Ut viverra sit amet leo nec finibus. Proin eget mauris ac mi blandit pretium at semper neque. Vestibulum tempor ultricies ante sed ullamcorper. Ut molestie ultrices pellentesque. In bibendum metus sit amet urna iaculis pulvinar. Cras ac mi urna. Sed non purus vitae dui euismod tempor. Maecenas a purus semper, sollicitudin ante ut, tincidunt ex. Curabitur laoreet felis lectus. Duis eget metus leo. Maecenas pretium, sapien eget tempus mollis, massa tellus gravida tortor, vel varius erat nulla eget enim. Cras pharetra posuere risus interdum elementum. Proin vel gravida lorem.

        Cras porttitor sodales mauris, at tristique lacus placerat et. Donec eget nisi vehicula, consequat diam sit amet, molestie mi. Maecenas ornare ultrices nulla ut vestibulum. Etiam eget luctus nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam vitae magna eget ante varius condimentum eu id risus. Ut purus ipsum, egestas id consequat et, efficitur ut felis. Cras placerat ut enim vitae laoreet. Aliquam erat volutpat. Curabitur rutrum ligula sit amet nunc hendrerit, id tincidunt enim viverra. Aliquam erat volutpat.

        Cras porttitor sodales mauris, at tristique lacus placerat et. Donec eget nisi vehicula, consequat diam sit amet, molestie mi. Maecenas ornare ultrices nulla ut vestibulum. Etiam eget luctus nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam vitae magna eget ante varius condimentum eu id risus. Ut purus ipsum, egestas id consequat et, efficitur ut felis. Cras placerat ut enim vitae laoreet. Aliquam erat volutpat. Curabitur rutrum ligula sit amet nunc hendrerit, id tincidunt enim viverra. Aliquam erat volutpat.
        ',
        'image_public_path' => '1488153671.JPG',
        'image_s3_path' => '1488153671.JPG',
        'status' => 1,
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
    Schema::dropIfExists('posts');
  }
}
