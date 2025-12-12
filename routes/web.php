<?php

use App\Http\Controllers\{HomeController, IdeaController, InterestController, DashboardController, ProfileController, SitemapController};
use Illuminate\Support\Facades\Route;

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'contactStore'])->name('contact.store');

Route::get('/ideas', [IdeaController::class, 'index'])->name('ideas.index');
Route::get('/ideas/{idea:id}', [IdeaController::class, 'show'])->name('ideas.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/post-idea', [IdeaController::class, 'create'])->name('ideas.create');
    Route::post('/ideas', [IdeaController::class, 'store'])->name('ideas.store');
    Route::post('/ideas/{idea}/interest', [InterestController::class, 'store'])->name('interests.store');
});

Route::middleware(['auth', 'verified'])->prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/contacts', [\App\Http\Controllers\Admin\AdminController::class, 'contacts'])->middleware(['auth', 'admin'])->name('admin.contacts');
Route::delete('/admin/contacts/{contact}', [\App\Http\Controllers\Admin\AdminController::class, 'deleteContact'])->middleware(['auth', 'admin'])->name('admin.contacts.delete');

use App\Http\Controllers\Admin\AdminController;
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/ideas', [AdminController::class, 'ideas'])->name('admin.ideas');
    Route::post('/ideas/{idea}/approve', [AdminController::class, 'approveIdea'])->name('admin.ideas.approve');
    Route::post('/ideas/{idea}/reject', [AdminController::class, 'rejectIdea'])->name('admin.ideas.reject');
    Route::post('/ideas/{idea}/toggle-featured', [AdminController::class, 'toggleFeatured'])->name('admin.ideas.toggle-featured');
    Route::post('/ideas/{idea}/toggle-visibility', [AdminController::class, 'toggleVisibility'])->name('admin.ideas.toggle-visibility');
    Route::delete('/ideas/{idea}', [AdminController::class, 'deleteIdea'])->name('admin.ideas.delete');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users/{user}/toggle-admin', [AdminController::class, 'toggleAdmin'])->name('admin.users.toggle-admin');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/interests', [AdminController::class, 'interests'])->name('admin.interests');
    Route::get('/interests/{interest}', [AdminController::class, 'showInterest'])->name('admin.interests.show');
    Route::delete('/interests/{interest}', [AdminController::class, 'deleteInterest'])->name('admin.interests.delete');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('admin.settings.update');
});

Route::get('/verify-otp/{user}', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'showOtpForm'])->name('verify.otp');
Route::post('/verify-otp/{user}', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'verifyOtp'])->name('verify.otp.submit');
Route::post('/resend-otp/{user}', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'resendOtp'])->name('resend.otp');

require __DIR__.'/auth.php';
