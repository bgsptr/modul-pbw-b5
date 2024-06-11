<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

Route::get("/register", [UserController::class, 'view_signup']);
Route::get("/login", [UserController::class, 'view_signin']);

Route::post("/register", [UserController::class, 'send_credential']);
Route::post("/login", [UserController::class, 'login']);

// Route::get("/dashboard", [UserController::class, 'show_home']);

Route::get("/blog/{username}/{id}", [PostController::class, 'read_blog']);

Route::get("/menu", [PostController::class, 'show_menu']);

Route::get("/blog/{username}", [PostController::class, 'read_user_blog']);
Route::get("/blog/edit/menu/{id}", [PostController::class, 'menu_edit_blog']);

Route::post("/blog", [PostController::class, 'create_blog']);


Route::put("/blog/{id}", [PostController::class, 'update_blog']);
Route::delete("/blog/{id}", [PostController::class, 'delete_blog']);

Route::get("/logout", [UserController::class, 'logout']);
Route::get("/yourposts", [PostController::class, 'author_menu']);   

Route::get('/', function () {
    return view('welcome');
});

Route::get("/hello", function() {
    return "Hello";
});