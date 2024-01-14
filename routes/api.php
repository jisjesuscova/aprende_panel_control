<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('audit', [\App\Http\Controllers\Api\AuditController::class, 'index']);
Route::post('audit', [\App\Http\Controllers\Api\AuditController::class, 'store']);

Route::get('section', [\App\Http\Controllers\Api\SectionController::class, 'index']);
Route::get('section/all', [\App\Http\Controllers\Api\SectionController::class, 'index']);
Route::delete('section/{id}', [\App\Http\Controllers\Api\SectionController::class, 'destroy']);
Route::get('section/{id}', [\App\Http\Controllers\Api\SectionController::class, 'edit']);
Route::post('section/store', [\App\Http\Controllers\Api\SectionController::class, 'store']);
Route::post('section/{id}', [\App\Http\Controllers\Api\SectionController::class, 'update']);
Route::get('section/move_up/{id}', [\App\Http\Controllers\Api\SectionController::class, 'move_up']);
Route::get('section/move_down/{id}', [\App\Http\Controllers\Api\SectionController::class, 'move_down']);
Route::get('section/copy/{id}', [\App\Http\Controllers\Api\SectionController::class, 'copy']);

Route::get('category', [\App\Http\Controllers\Api\CategoryController::class, 'index']);
Route::get('category/search/{id}', [\App\Http\Controllers\Api\CategoryController::class, 'search']);
Route::get('category/all/{id}', [\App\Http\Controllers\Api\CategoryController::class, 'index']);
Route::delete('category/{id}', [\App\Http\Controllers\Api\CategoryController::class, 'destroy']);
Route::get('category/{id}', [\App\Http\Controllers\Api\CategoryController::class, 'edit']);
Route::post('category/store', [\App\Http\Controllers\Api\CategoryController::class, 'store']);
Route::post('category/{id}', [\App\Http\Controllers\Api\CategoryController::class, 'update']);
Route::get('category/move_up/{section_id}/{id}', [\App\Http\Controllers\Api\CategoryController::class, 'move_up']);
Route::get('category/move_down/{section_id}/{id}', [\App\Http\Controllers\Api\CategoryController::class, 'move_down']);
Route::get('category/copy/{id}', [\App\Http\Controllers\Api\CategoryController::class, 'copy']);

Route::get('content', [\App\Http\Controllers\Api\ContentController::class, 'index']);
Route::get('content/search/{section_id}/{category_id}', [\App\Http\Controllers\Api\ContentController::class, 'search']);
Route::delete('content/{id}', [\App\Http\Controllers\Api\ContentController::class, 'destroy']);
Route::get('content/{id}', [\App\Http\Controllers\Api\ContentController::class, 'edit']);
Route::post('content/store', [\App\Http\Controllers\Api\ContentController::class, 'store']);
Route::post('content/{id}', [\App\Http\Controllers\Api\ContentController::class, 'update']);
Route::get('content/move_up/{section_id}/{category_id}/{id}', [\App\Http\Controllers\Api\ContentController::class, 'move_up']);
Route::get('content/move_down/{section_id}/{category_id}/{id}', [\App\Http\Controllers\Api\ContentController::class, 'move_down']);
Route::get('content/copy/{id}', [\App\Http\Controllers\Api\ContentController::class, 'copy']);

Route::get('region', [\App\Http\Controllers\Api\RegionController::class, 'index']);
Route::delete('region/{id}', [\App\Http\Controllers\Api\RegionController::class, 'destroy']);
Route::get('region/{id}', [\App\Http\Controllers\Api\RegionController::class, 'edit']);
Route::post('region/store', [\App\Http\Controllers\Api\RegionController::class, 'store']);
Route::post('region/{id}', [\App\Http\Controllers\Api\RegionController::class, 'update']);
Route::post('region/find', [\App\Http\Controllers\Api\RegionController::class, 'find']);

Route::get('commune/{id}', [\App\Http\Controllers\Api\CommuneController::class, 'index']);
Route::get('commune', [\App\Http\Controllers\Api\CommuneController::class, 'index']);
Route::post('commune/find', [\App\Http\Controllers\Api\CommuneController::class, 'find']);

Route::get('section_region/{id}', [\App\Http\Controllers\Api\SectionRegionController::class, 'edit']);
Route::get('section_commune/{id}', [\App\Http\Controllers\Api\SectionCommuneController::class, 'edit']);

Route::get('category_region/{id}', [\App\Http\Controllers\Api\CategoryRegionController::class, 'edit']);
Route::get('category_commune/{id}', [\App\Http\Controllers\Api\CategoryCommuneController::class, 'edit']);

Route::get('content_region/{id}', [\App\Http\Controllers\Api\CategoryRegionController::class, 'edit']);
Route::get('content_commune/{id}', [\App\Http\Controllers\Api\CategoryCommuneController::class, 'edit']);

Route::post('audit/store', [\App\Http\Controllers\Api\AuditController::class, 'store']);

Route::post('user/login', [\App\Http\Controllers\Api\UserController::class, 'login']);
Route::post('user/logout', [\App\Http\Controllers\Api\UserController::class, 'logout']);

Route::get('front_section/{region_id}/{commune_id}', [\App\Http\Controllers\Api\FrontSectionController::class, 'index']);
Route::get('front_section/show/{id}', [\App\Http\Controllers\Api\FrontSectionController::class, 'show']);
Route::get('front_category/{id}/{region_id}/{commune_id}', [\App\Http\Controllers\Api\FrontCategoryController::class, 'index']);
Route::get('front_category/show/{id}', [\App\Http\Controllers\Api\FrontCategoryController::class, 'show']);
Route::get('front_content/{section_id}/{category_id}/{region_id}/{commune_id}', [\App\Http\Controllers\Api\FrontContentController::class, 'index']);
Route::get('front_content/show/data/{id}', [\App\Http\Controllers\Api\FrontContentController::class, 'show']);