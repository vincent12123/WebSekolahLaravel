<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\StaffController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Announcements
Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
Route::get('/announcements/{announcement}', [AnnouncementController::class, 'show'])->name('announcements.show');

// Articles/Blog
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/category/{category}', [ArticleController::class, 'category'])->name('articles.category');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
Route::post('/articles/{article}/comments', [ArticleController::class, 'storeComment'])->name('articles.comments.store');

// Gallery
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/gallery/{album}', [GalleryController::class, 'show'])->name('gallery.show');

// Downloads
Route::get('/downloads', [DownloadController::class, 'index'])->name('downloads.index');
Route::get('/downloads/category/{category}', [DownloadController::class, 'category'])->name('downloads.category');

// Extracurriculars
Route::get('/extracurriculars', [ExtracurricularController::class, 'index'])->name('extracurriculars.index');
Route::get('/extracurriculars/{extracurricular}', [ExtracurricularController::class, 'show'])->name('extracurriculars.show');

// Jobs
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
Route::post('/jobs/{job}/apply', [JobController::class, 'apply'])->name('jobs.apply');

// Staff
Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');

// Complaint Form
Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('complaints.create');
Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
