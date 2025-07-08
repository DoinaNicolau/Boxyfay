<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;      
use App\Http\Controllers\CheckoutController;

Route::get('/', [PublicController::class, 'homepage'])->name('homepage');
Route::get('/search/article', [PublicController::class, 'search'])->name('search.article');
Route::post('/lingua/{lang}',[PublicController::class,'setLanguage'])->name('setLocale');
// Google Login
Route::get('/auth/google/redirect', [PublicController::class, 'googleLogin'])->name('google.login');
Route::get('/auth/google/callback', [PublicController::class, 'googleCallback'])->name('google.callback');

Route::get('/article/create',[ArticleController::class,'create'])->name('article.create')->middleware('auth');
Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store')->middleware('auth');
Route::get('/article/index', [ArticleController::class, 'index'])->name('article.index');
Route::get('/article/{article}', [ArticleController::class, 'show'])->name('article.show');
Route::get('/article/category/{category}', [ArticleController::class, 'bycategory'])->name('article.bycategory');
Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update')->middleware('auth');
Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy')->middleware('auth');

Route::get('/revisor/index', [RevisorController::class, 'index'])->name('revisor.index')->middleware('isRevisor');
Route::patch('/accept/{article}', [RevisorController::class, 'accept'])->name('accept')->middleware('isRevisor');
Route::patch('/reject/{article}', [RevisorController::class, 'reject'])->name('reject')->middleware('isRevisor');
// Route::get('/revisor/request', [RevisorController::class, 'becomeRevisor'])->middleware('auth')->name('become.revisor');
Route::post('/work-with-us/submit', [RevisorController::class, 'submitRevisorRequest'])->name('revisor.submit')->middleware('auth');
Route::get('/make/revisor/{user}', [RevisorController::class, 'makeRevisor'])->name('make.revisor')->middleware('isRevisor');
Route::patch('/change/{article}', [RevisorController::class, 'changeStatus'])->name('change')->middleware('isRevisor');
//Rotta revisor.load utile solo ad aprire la modale (la funzione non esiste nel controller)
Route::get('/revisor/load/{article}', [RevisorController::class, 'loadArticle'])->name('revisor.load')->middleware('isRevisor');

Route::get('/user/profile', [UserController::class,'index'])->name('user.index')->middleware('auth');
Route::get('/user/profile/edit/{user}', [UserController::class,'edit'])->name('user.edit')->middleware('auth');
Route::put('/user/profile/update', [UserController::class,'update'])->name('user.update')->middleware('auth');
Route::delete('/user/profile/delete/{user}', [UserController::class,'delete'])->name('user.delete')->middleware('auth');

// ... altre rotte per gli articoli ...

// Rotte per il carrello
Route::post('/cart/add/{article}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Rotte per il checkout
  Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');






?>
 