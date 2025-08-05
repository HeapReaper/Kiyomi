<?php

use Illuminate\Support\Facades\Route;
use Modules\Panel\Http\Controllers\NotificationController;
use Modules\Panel\Http\Controllers\PanelController;
use App\Jobs\TestJob;

Route::group(['middleware' => 'auth'], function () {
    Route::resource('panel', PanelController::class)->names('panel');
    Route::post('/notifications/read', [NotificationController::class, 'markSingleAsRead'])->name('notifications.markReadSingle');
});

Route::get('/dispatch-test', function () {
    TestJob::dispatch();
    return 'Job dispatched!';
});