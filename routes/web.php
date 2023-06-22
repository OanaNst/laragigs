<?php

use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

// All Listings
Route::get('/', [ListingController::class, 'index']);

// Show Create Form

Route::get('/listings/create', [ListingController::class, 'create']);

// Store Listing Data

Route::post('/listings', [ListingController::class, 'store']);

// Show Edit Form

Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']);

// Edit Submit to Update

Route::put('/listings/{listing}', [ListingController::class, 'update']);

// Delete

Route::delete('/listings/{listing}', [ListingController::class, 'destroy']);




// Single Listing

Route::get('/listings/{listing}', [ListingController::class, 'show']);
