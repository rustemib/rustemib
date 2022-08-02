<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/')->group(function () {
    Route::get('/', \App\Http\Controllers\Main\IndexController::class)->name('main.index');

});
Route::prefix('posts')->group(function () {
    Route::get('/', \App\Http\Controllers\Post\IndexController::class)->name('post.index');
    Route::get('/{post}', \App\Http\Controllers\Post\ShowController::class)->name('post.show');
    Route::prefix('{post}')->group(function(){
        Route::post('/comments', \App\Http\Controllers\Post\Comment\StoreController::class)->name('post.comment.store');
    });
    Route::prefix('{post}/likes')->group(function(){
        Route::post('/likes', \App\Http\Controllers\Post\Like\StoreController::class)->name('post.like.store');
    });
});
Route::prefix('category')->group(function(){
    Route::get('/', \App\Http\Controllers\Category\IndexController::class)->name('category.index');
    Route::prefix('{category}/posts')->group(function() {
        Route::get('/', \App\Http\Controllers\Category\Post\IndexController::class)->name('category.post.index');
    });
});


Route::prefix('personal')->group(function () {
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/', \App\Http\Controllers\Personal\Main\IndexController::class)->name('personal.main.index');
        Route::get('/liked', \App\Http\Controllers\Personal\Liked\IndexController::class)->name('personal.liked.index');
        Route::delete('/liked/{post}', \App\Http\Controllers\Personal\Liked\DeleteController::class)->name('personal.liked.delete');

        Route::get('/comment', \App\Http\Controllers\Personal\Comment\IndexController::class)->name('personal.comment.index');
        Route::get('/{comment}/edit', \App\Http\Controllers\Personal\Comment\EditController::class)->name('personal.comment.edit');
        Route::patch('/{comment}', \App\Http\Controllers\Personal\Comment\UpdateController::class)->name('personal.comment.update');
        Route::delete('/{comment}', \App\Http\Controllers\Personal\Comment\DeleteController::class)->name('personal.comment.delete');

    });

});
Route::prefix('admin')->group(function () {
    Route::middleware(['auth', 'admin', 'verified'])->group(function () {
        Route::get('/', \App\Http\Controllers\Admin\Main\IndexController::class)->name('admin.main.index');
        Route::get('/categories', \App\Http\Controllers\Admin\Category\IndexController::class)->name('admin.category.index');
        Route::get('/categories/create', \App\Http\Controllers\Admin\Category\CreateController::class)->name('admin.category.create');
        Route::post('/categories', \App\Http\Controllers\Admin\Category\StoreController::class)->name('admin.category.store');
        Route::get('/categories/{category}', \App\Http\Controllers\Admin\Category\ShowController::class)->name('admin.category.show');
        Route::get('/categories/{category}/edit', \App\Http\Controllers\Admin\Category\EditController::class)->name('admin.category.edit');
        Route::patch('/categories/{category}', \App\Http\Controllers\Admin\Category\UpdateController::class)->name('admin.category.update');
        Route::delete('/categories/{category}', \App\Http\Controllers\Admin\Category\DeleteController::class)->name('admin.category.delete');


        Route::get('/tags', \App\Http\Controllers\Admin\Tag\IndexController::class)->name('admin.tag.index');
        Route::get('/tags/create', \App\Http\Controllers\Admin\Tag\CreateController::class)->name('admin.tag.create');
        Route::post('/tags', \App\Http\Controllers\Admin\Tag\StoreController::class)->name('admin.tag.store');
        Route::get('/tags/{tag}', \App\Http\Controllers\Admin\Tag\ShowController::class)->name('admin.tag.show');
        Route::get('/tags/{tag}/edit', \App\Http\Controllers\Admin\Tag\EditController::class)->name('admin.tag.edit');
        Route::patch('/tags/{tag}', \App\Http\Controllers\Admin\Tag\UpdateController::class)->name('admin.tag.update');
        Route::delete('/tags/{tag}', \App\Http\Controllers\Admin\Tag\DeleteController::class)->name('admin.tag.delete');

        Route::get('/posts', \App\Http\Controllers\Admin\Post\IndexController::class)->name('admin.post.index');
        Route::get('/posts/create', \App\Http\Controllers\Admin\Post\CreateController::class)->name('admin.post.create');
        Route::post('/posts', \App\Http\Controllers\Admin\Post\StoreController::class)->name('admin.post.store');
        Route::get('/posts/{post}', \App\Http\Controllers\Admin\Post\ShowController::class)->name('admin.post.show');
        Route::get('/posts/{post}/edit', \App\Http\Controllers\Admin\Post\EditController::class)->name('admin.post.edit');
        Route::patch('/posts/{post}', \App\Http\Controllers\Admin\Post\UpdateController::class)->name('admin.post.update');
        Route::delete('/posts/{post}', \App\Http\Controllers\Admin\Post\DeleteController::class)->name('admin.post.delete');

        Route::get('/users', \App\Http\Controllers\Admin\User\IndexController::class)->name('admin.user.index');
        Route::get('/users/create', \App\Http\Controllers\Admin\User\CreateController::class)->name('admin.user.create');
        Route::post('/users', \App\Http\Controllers\Admin\User\StoreController::class)->name('admin.user.store');
        Route::get('/users/{user}', \App\Http\Controllers\Admin\User\ShowController::class)->name('admin.user.show');
        Route::get('/users/{user}/edit', \App\Http\Controllers\Admin\User\EditController::class)->name('admin.user.edit');
        Route::patch('/users/{user}', \App\Http\Controllers\Admin\User\UpdateController::class)->name('admin.user.update');
        Route::delete('/users/{user}', \App\Http\Controllers\Admin\User\DeleteController::class)->name('admin.user.delete');

    });
});


Auth::routes(['verify'=>true]);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
