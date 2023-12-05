<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('home');
});

Route::get('/user_id', function () {
    return response()->json(['user_id' => auth()->id()]);
});

Route::get('/session-data', function () {
    return response()->json(auth()->user());
});

Route::get('/account', function () {
    return view('home');
});

Route::get('/alliances', function () {
    return view('home');
});

Route::get('/alliance/create', function () {
    return view('home');
});

Route::get('/alliance/edit/{id}', function () {
    return view('home');
});

Route::get('/sections', function () {
    return view('home');
});

Route::get('/section/edit/{id}', function () {
    return view('home');
});

Route::get('/section/create', function () {
    return view('home');
});

Route::get('/categories', function () {
    return view('home');
});

Route::get('/category/edit/{id}', function () {
    return view('home');
});

Route::get('/category/create', function () {
    return view('home');
});

Route::get('/contents', function () {
    return view('home');
});

Route::get('/content/edit/{id}', function () {
    return view('home');
});

Route::get('/content/create', function () {
    return view('home');
});

require __DIR__.'/auth.php';
