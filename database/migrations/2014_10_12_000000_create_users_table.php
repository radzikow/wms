<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('firstname');
      $table->string('lastname');
      $table->string('email')->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->integer('status')->default(1);
      $table->string('role');
      $table->rememberToken();
      $table->timestamps();
      $table->boolean('deleted')->default(false);
    });

    // Insert admin user
    DB::table('users')->insert([
      // default admin user
      [
        'firstname' => 'admin',
        'lastname' => 'admin',
        'email' => 'admin@mail.com',
        'password' => Hash::make('pass'),
        'role' => 'admin',
        'status' => '1',
      ],
      [
        'firstname' => 'Jane',
        'lastname' => 'Doe',
        'email' => 'jane@mail.com',
        'password' => Hash::make('pass'),
        'role' => 'admin',
        'status' => '1',
      ],
      [
        'firstname' => 'John',
        'lastname' => 'Doe',
        'email' => 'john@mail.com',
        'password' => Hash::make('pass'),
        'role' => 'author',
        'status' => '1',
      ],
      [
        'firstname' => 'Jonathan',
        'lastname' => 'Doe',
        'email' => 'jonathan@mail.com',
        'password' => Hash::make('pass'),
        'role' => 'author',
        'status' => '0',
      ],
      [
        'firstname' => 'David',
        'lastname' => 'Doe',
        'email' => 'david@mail.com',
        'password' => Hash::make('pass'),
        'role' => 'admin',
        'status' => '0',
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
    Schema::dropIfExists('users');
  }
}
