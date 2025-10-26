<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

use Illuminate\Support\Facades\Route;
use MySara\Front\Controllers;
use MySara\Front\Controllers\Account;


Route::get('/', [Controllers\HomeController::class, 'index'])->name('home.index');

// Social
Route::get('/social/{provider}/redirect', [Account\SocialController::class, 'redirect'])->name('social.redirect');
Route::get('/social/{provider}/callback', [Account\SocialController::class, 'callback'])->name('social.callback');

// Upload
Route::post('/upload/images', [Controllers\UploadController::class, 'images'])->name('upload.images');
Route::post('/upload/docs', [Controllers\UploadController::class, 'docs'])->name('upload.docs');
Route::post('/upload/files', [Controllers\UploadController::class, 'files'])->name('upload.files');

// Sitemap
Route::get('/sitemap.xml', [Controllers\SitemapController::class, 'index'])->name('sitemap.index');
