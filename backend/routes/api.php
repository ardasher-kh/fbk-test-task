<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Request example:
// http://localhost:8000/api/comments?sort_by_created_at=DESC&sort_by_user_name=ASC&sort_by_likes_count=ASC&page=1
Route::get('comments', [\App\Http\Controllers\CommentController::class, 'show']);
