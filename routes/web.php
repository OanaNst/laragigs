<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

// All Listings
Route::get('/', [ListingController::class, 'index']);

// Show Create Form

Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Store Listing Data

Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// Show Edit Form

Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Edit Submit to Update

Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Delete

Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

// Single Listing

Route::get('/listings/{listing}', [ListingController::class, 'show']);

// Show Register/Create Form

Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Create New User

Route::post('/users', [UserController::class, 'store']);

// Log User Out

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show Login Form

Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Login User

Route::post('/users/authenticate', [UserController::class, 'authenticate']);