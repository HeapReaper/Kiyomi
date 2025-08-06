<?php

namespace Modules\Panel\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewTestNotification;
use Modules\Users\Models\User;

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

    public function test(Request $request) {
        User::find(Auth::id())->notify(new NewTestNotification());

        return 'notified!';
    }
}
