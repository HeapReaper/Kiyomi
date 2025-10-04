<?php

use Illuminate\Support\Facades\Route;
use Modules\Tests\Http\Controllers\TestsController;
use Modules\Tests\Jobs\TestQueueJob;


Route::group(['middleware' => 'auth'], function () {
    Route::resource('tests', TestsController::class)->names('tests');

    Route::get('/queue-check', function () {
        TestQueueJob::dispatch();
        
        return redirect()->back()->with('queue_status', 'Job is verzonden!');
    });
});
