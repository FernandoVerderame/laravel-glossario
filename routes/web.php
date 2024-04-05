<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Guest\HomeController as GuestHomeController;
use App\Http\Controllers\Admin\WordController as AdminWordController;
use App\Http\Controllers\Guest\WordController as GuestWordController;
use App\Http\Controllers\Admin\LinkController as AdminLinkController;
use Illuminate\Support\Facades\Route;

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
// Guest home route
Route::get('/', GuestHomeController::class)->name('guest.home');


// Admin group
Route::prefix('/admin')->name('admin.')->middleware('auth')->group(function () {
    // Admin home route
    Route::get('', AdminHomeController::class)->name('home');

    // Soft Deletes
    Route::get('/words/trash', [AdminWordController::class, 'trash'])->name('words.trash');
    Route::patch('/words/{word}/trash', [AdminWordController::class, 'restore'])->name('words.restore')->withTrashed();
    Route::delete('/words/{word}/drop', [AdminWordController::class, 'drop'])->name('words.drop')->withTrashed();

    // Words Admin routes
    Route::resource('words', AdminWordController::class)->withTrashed();

    // Links Admin routes
    Route::resource('links', AdminLinkController::class);
});







Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});







require __DIR__ . '/auth.php';
