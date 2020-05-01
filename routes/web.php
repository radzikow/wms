<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Contracts\Session\Session;

// Routes
Auth::routes();

// Disabled
Auth::routes([
  'register' => false, // Registration Routes...
  'reset' => false, // Password Reset Routes...
  'verify' => false, // Email Verification Routes...
]);

// Logout
Route::get('/logout', 'Auth\LoginController@logout');

// Home
Route::get('/', function () {
  return view('home');
});

// Dashboard
Route::get('/dashboard', 'DashboardController@index');

// Newsletter
Route::get('/dashboard/newsletter', 'SubscriberController@index');
Route::delete('/dashboard/newsletter/{id}', 'SubscriberController@destroy');

// Activity
Route::get('/dashboard/activity', 'ActivityController@index');

// Settings
Route::get('/dashboard/settings', 'SettingsController@index');
Route::put('/dashboard/settings/{id}/active', 'SettingsController@active');
Route::put('/dashboard/settings/{id}/inactive', 'SettingsController@inactive');

// Profile
Route::get('/dashboard/profile', 'ProfileController@index');
Route::put('/dashboard/profile/info', 'ProfileController@updateInfo');
Route::put('/dashboard/profile/pass', 'ProfileController@updatePass');

// Users
Route::get('/dashboard/users', 'UserController@index');
Route::get('/dashboard/users/create', 'UserController@create');
Route::get('/dashboard/users/{id}', 'UserController@show');
Route::post('/dashboard/users', 'UserController@store');
Route::put('/dashboard/users', 'UserController@update');
Route::delete('/dashboard/users/{id}', 'UserController@destroy');

// Blog Posts
Route::get('/dashboard/posts', 'PostController@index');
Route::get('/dashboard/posts/create', 'PostController@create');
Route::get('/dashboard/posts/{id}', 'PostController@show');
Route::post('/dashboard/posts', 'PostController@store');
Route::put('/dashboard/posts', 'PostController@update');
Route::delete('/dashboard/posts/{id}', 'PostController@destroy');

// Blog Topics
Route::get('/dashboard/topics', 'TopicController@index');
Route::get('/dashboard/topics/create', 'TopicController@create');
Route::get('/dashboard/topics/{id}', 'TopicController@show');
Route::post('/dashboard/topics', 'TopicController@store');
Route::put('/dashboard/topics', 'TopicController@update');
Route::delete('/dashboard/topics/{id}', 'TopicController@destroy');

// Blog Comments
Route::get('/dashboard/comments', 'CommentController@index');
Route::get('dashboard/comments/{id}', 'CommentController@show');
Route::put('/dashboard/comments', 'CommentController@update');
Route::put('/dashboard/comments/{id}/accept', 'CommentController@accept');
Route::put('/dashboard/comments/{id}/reject', 'CommentController@reject');
Route::delete('/dashboard/comments/{id}', 'CommentController@destroy');

// Privacy & Cookies Policy
Route::get('/dashboard/policy', 'PolicyController@index');
Route::put('/dashboard/policy', 'PolicyController@store');

// Contact Information
Route::get('/dashboard/contact', 'ContactController@index');
Route::put('/dashboard/contact', 'ContactController@store');

// News
Route::get('/dashboard/news', 'NewsController@index');
Route::get('/dashboard/news/create', 'NewsController@create');
Route::get('/dashboard/news/{id}', 'NewsController@show');
Route::post('/dashboard/news', 'NewsController@store');
Route::put('/dashboard/news', 'NewsController@update');
Route::delete('/dashboard/news/{id}', 'NewsController@destroy');

// Numbers
Route::get('/dashboard/numbers', 'NumbersController@index');
Route::put('/dashboard/numbers', 'NumbersController@store');

// FAQ
Route::get('/dashboard/faq', 'FaqController@index');
Route::get('/dashboard/faq/create', 'FaqController@create');
Route::get('/dashboard/faq/{id}', 'FaqController@show');
Route::post('/dashboard/faq', 'FaqController@store');
Route::put('/dashboard/faq', 'FaqController@update');
Route::delete('/dashboard/faq/{id}', 'FaqController@destroy');

// Banners
Route::get('/dashboard/banners', 'BannerController@index');
Route::get('/dashboard/banners/create', 'BannerController@create');
Route::get('/dashboard/banners/{id}', 'BannerController@show');
Route::post('/dashboard/banners', 'BannerController@store');
Route::put('/dashboard/banners', 'BannerController@update');
Route::delete('/dashboard/banners/{id}', 'BannerController@destroy');

// Projects
Route::get('/dashboard/projects', 'ProjectController@index');
Route::get('/dashboard/projects/create', 'ProjectController@create');
Route::get('/dashboard/projects/{id}', 'ProjectController@show');
Route::post('/dashboard/projects', 'ProjectController@store');
Route::put('/dashboard/projects', 'ProjectController@update');
Route::delete('/dashboard/projects/{id}', 'ProjectController@destroy');

// Testimonials
Route::get('/dashboard/testimonials', 'TestimonialController@index');
Route::get('/dashboard/testimonials/create', 'TestimonialController@create');
Route::get('/dashboard/testimonials/{id}', 'TestimonialController@show');
Route::post('/dashboard/testimonials', 'TestimonialController@store');
Route::put('/dashboard/testimonials', 'TestimonialController@update');
Route::delete('/dashboard/testimonials/{id}', 'TestimonialController@destroy');

// Clearing page
Route::get('/clear', function() {
  return view('clear');
});

// Clear cache facade value:
Route::get('/clear-cache', function() {
  $exitCode = Artisan::call('cache:clear');
  // Session::flash('clear-message', 'Cache facade value cleared!');
  return back()->with('clear-message', 'Cache facade value cleared!');
});

// Route cache:
Route::get('/route-cache', function() {
  $exitCode = Artisan::call('route:cache');
  // Session::flash('clear-message', 'Routes cached!');
  return back()->with('clear-message', 'Routes cached!');
});

// Clear route cache:
Route::get('/route-clear', function() {
  $exitCode = Artisan::call('route:clear');
  // Session::flash('clear-message', 'Route cache cleared!');
  return back()->with('clear-message', 'Route cache cleared!');
});

// Clear view cache:
Route::get('/view-clear', function() {
  $exitCode = Artisan::call('view:clear');
  // Session::flash('clear-message', 'View cache cleared!');
  return back()->with('clear-message', 'View cache cleared!');
});

// Clear config cache:
Route::get('/config-cache', function() {
  $exitCode = Artisan::call('config:cache');
  // Session::flash('clear-message', 'Clear Config cleared!');
  return back()->with('clear-message', 'Config cache cleared!');
});
