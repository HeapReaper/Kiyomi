<?php

namespace Modules\Panel\Livewire;

use Livewire\Component;

class Notifications extends Component
{
    public function getUnreadNotificationsProperty()
    {
        return auth()->user()->unreadNotifications()->take(10)->get();
    }

    public function render()
    {
        return view('panel::livewire.notifications');
    }
}
