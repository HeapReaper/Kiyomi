<?php

use Illuminate\Support\Facades\Route;
use Modules\Panel\Http\Controllers\NotificationController;
use Modules\Panel\Http\Controllers\PanelController;

Route::group(['middleware' => 'auth'], function () {
    Route::resource('panel', PanelController::class)->names('panel');
    Route::post('/notifications/read', [NotificationController::class, 'markSingleAsRead'])->name('notifications.markReadSingle');
    Route::geT('/notifications/test', [NotificationController::class, 'test'])->name('notifications.test');
});