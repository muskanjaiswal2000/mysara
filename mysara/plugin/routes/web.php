<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

use Illuminate\Support\Facades\Route;
use MySara\Plugin\Controllers\MarketplaceController;
use MySara\Plugin\Controllers\PluginController;
use MySara\Plugin\Controllers\PluginMarketController;
use MySara\Plugin\Controllers\SettingController;
use MySara\Plugin\Controllers\ThemeMarketController;

Route::post('/plugins/enabled', [PluginController::class, 'updateStatus'])->name('plugins.update_status');
Route::get('/plugins/settings', [SettingController::class, 'index'])->name('plugins.settings');
Route::put('/plugins/settings', [SettingController::class, 'update'])->name('plugins.settings.update');
Route::resource('/plugins', PluginController::class);

Route::get('/plugin_market', [PluginMarketController::class, 'index'])->name('plugin_market.index');
Route::get('/plugin_market/{slug}', [PluginMarketController::class, 'show'])->name('plugin_market.show');

Route::get('/theme_market', [ThemeMarketController::class, 'index'])->name('theme_market.index');
Route::get('/theme_market/{slug}', [ThemeMarketController::class, 'show'])->name('theme_market.show');

Route::get('/marketplaces/{id}/download', [MarketplaceController::class, 'download'])->name('marketplaces.download');
Route::post('/marketplaces/quick_checkout', [MarketplaceController::class, 'quickCheckout'])->name('marketplaces.quick_checkout');
Route::put('/marketplaces/domain_token', [MarketplaceController::class, 'updateDomainToken'])->name('marketplaces.domain_token');
