<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\MembersController;

Route::get('/', [LoansController::class, 'index']);

Route::resource('books', BooksController::class); 

Route::resource('loans', LoansController::class); 

Route::resource('members', MembersController::class);

Route::get('/search-books', [BooksController::class, 'searchBooks'])->name('searchBooks');

Route::get('/members/search', [MembersController::class, 'search'])->name('members.search');
