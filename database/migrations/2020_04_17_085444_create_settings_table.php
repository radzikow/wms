<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSettingsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('settings', function (Blueprint $table) {
      $table->id();
      $table->string('nesting');
      $table->string('name');
      $table->string('url');
      $table->string('icon');
      $table->integer('status')->default(1);
      $table->boolean('deleted')->default(false);
      $table->timestamps();
    });

    DB::table('settings')->insert([
      [
        'nesting' => 'Website Content',
        'name' => 'Banners',
        'url' => 'banners',
        'icon' => 'angle-right'
      ],
      [
        'nesting' => 'Website Content',
        'name' => 'Projects',
        'url' => 'projects',
        'icon' => 'angle-right'
      ],
      [
        'nesting' => 'Website Content',
        'name' => 'Testimonials',
        'url' => 'testimonials',
        'icon' => 'angle-right'
      ],
      [
        'nesting' => 'Website Content',
        'name' => 'Contact Information',
        'url' => 'contact',
        'icon' => 'angle-right'
      ],
      [
        'nesting' => 'Website Content',
        'name' => 'Numbers',
        'url' => 'numbers',
        'icon' => 'angle-right'
      ],
      [
        'nesting' => 'Website Content',
        'name' => 'Privacy & Cookies',
        'url' => 'policy',
        'icon' => 'angle-right'
      ],
      [
        'nesting' => 'Website Content',
        'name' => 'FAQ',
        'url' => 'faq',
        'icon' => 'angle-right'
      ],
      [
        'nesting' => 'Sidebar',
        'name' => 'News',
        'url' => 'news',
        'icon' => 'news'
      ],
      [
        'nesting' => 'Blog',
        'name' => 'Blog Posts',
        'url' => 'posts',
        'icon' => 'angle-right'
      ],
      [
        'nesting' => 'Blog',
        'name' => 'Blog Topics',
        'url' => 'topics',
        'icon' => 'angle-right'
      ],
      [
        'nesting' => 'Blog',
        'name' => 'Blog Comments',
        'url' => 'comments',
        'icon' => 'angle-right'
      ],
      [
        'nesting' => 'Sidebar',
        'name' => 'Newsletter',
        'url' => 'newsletter',
        'icon' => 'newsletter'
      ],
      [
        'nesting' => 'Sidebar',
        'name' => 'Activity',
        'url' => 'activity',
        'icon' => 'notifications'
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
    Schema::dropIfExists('settings');
  }
}
