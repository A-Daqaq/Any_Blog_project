<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
// |
// */

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [MainController:: class, "homePage"])->name('home');
Route::get('/about',[MainController::class ,"aboutPage"]);

Route::get('/login',[AuthController::class ,"loginPage"])->name('login');
Route::post('/login',[AuthController::class ,"login"])->middleware('guest');

Route::get('post/login',[AuthController::class ,"loginPage"])->name('login');
Route::post('post/login',[AuthController::class ,"login"])->middleware('guest');

Route::get('/logout',[AuthController::class,'logout'])->middleware('auth');

Route::get('/sign-up',[AuthController::class ,"signUpPage"])->middleware('guest');
Route::post('/sign-up',[AuthController::class ,"signUp"])->middleware('guest');


Route::get('post/sign-up',[AuthController::class ,"signUpPage"])->middleware('guest');
Route::post('post/sign-up',[AuthController::class ,"signUp"])->middleware('guest');

Route::get('/create-post',[PostController::class,"createPostPage"]);
Route::post('/create-post',[PostController::class,"createPost"])->name('createPost');

Route::get('/post/{post}',[PostController::class,"postPage"]);

Route::get('/post/edit/{post}',[PostController::class,"editPostPage"])->middleware("can:update,post");
Route::put('/post/edit/{post}',[PostController::class,"editPost"])->middleware("can:update,post");


// Route::get('/post/delete/{post}',[PostController::class,"deletePost"])->middleware("can:delete,post");

Route::delete("/post/delete/{post}",[PostController::class, "confirmDelete"])->middleware("can:delete,post");
Route::get("/post/delete/{post}",[PostController::class, "confirmDeletePage"])->middleware("can:delete,post");

Route::post("/post/comment/{post}",[CommentController::class, "createComment"])->middleware("auth");


Route::get("/author/{user}",[PostController::class, "authorPage"])->name('author');

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});


Route::post("/post/like/{post}",[PostController::class, "like"])->middleware('auth');
Route::post("/search/",[MainController::class, "searchPage"]);
Route::get("/search/",[MainController::class, "searchPage"]);
Route::post("/read-later",[MainController::class, "readLater"]);
Route::get("/saved-posts",[MainController::class, "savedPostPage"]);

Route::get('/change-avatar/{user}',[MainController::class,"changeAvatarPage"])->middleware('can:update,user');
Route::put('/change-avatar/{user}',[MainController::class,"changeAvatar"])->middleware('can:update,user');
