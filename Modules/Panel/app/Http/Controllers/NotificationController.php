<?php

namespace Modules\Panel\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markSingleAsRead(Request $request)
    {
        $notification = Auth::user()->notifications()->find($request->id);
        if ($notification) {
            $notification->markAsRead();
        }

        return response()->json(['status' => 'ok']);
    }
}
