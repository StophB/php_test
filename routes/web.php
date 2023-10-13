<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\adminTestimonialController;

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


Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::post('/store', [HomeController::class, 'store']);




// Routes pour la gestion des témoignages par l'admin
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function () {
    Route::get('testimonials', [adminTestimonialController::class, 'index']);
    Route::get('testimonials/create', [adminTestimonialController::class, 'create']);
    Route::post('testimonials', [adminTestimonialController::class, 'store']);
    Route::get('testimonials/{testimonial}/edit', [adminTestimonialController::class, 'edit']);
    Route::put('testimonials/{testimonial}', [adminTestimonialController::class, 'update']);
    Route::get('testimonials/{testimonial}/delete', [adminTestimonialController::class, 'destroy']);
});
