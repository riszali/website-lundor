<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home'); 
});

// Route untuk halaman Web Development
Route::get('/web-development', function () {
    return view('pages.web-development'); 
});

// Route untuk halaman Social Media Management
Route::get('/social-media', function () {
    return view('pages.social-media'); 
});

// Route baru untuk halaman UI/UX Design
Route::get('/uiux-design', function () {
    return view('pages.uiux-design'); 
});

// Route untuk halaman About
Route::get('/about', function () {
    return view('pages.about'); 
});


// Route untuk halaman Contact
Route::get('/contact', function () {
    return view('pages.contact'); 
});


// Route untuk halaman Portfolio
Route::get('/portfolio', function () {
    return view('pages.portfolio'); 
});