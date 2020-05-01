{{-- Metadata --}}
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Website Management System - website app helping you manage all your website content, in a easy and simple way.">
<meta name="keywords" content="website management system cms wms radzikow content app laravel php">
<meta name="author" content="radzikow.com">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- Title --}}
<title>{{ config('app.name', 'Website Management System') }}</title>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<!-- Styles -->
<link href="{{ asset('css/main.css') }}" rel="stylesheet">

{{-- CKEditor --}}
<script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
