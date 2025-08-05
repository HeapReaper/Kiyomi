<div wire:poll.5s>
  <li class="nav-item dropdown">
    <a class="nav-link position-relative" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="bi bi-bell" style="font-size: 1.2rem;"></i>

      @if($this->unreadNotifications->count() > 0)
        <span class="notification-dot"></span>
      @endif
    </a>

    {{-- ✅ Prevent Livewire from interfering with the dropdown --}}
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="width: 300px;" >
      <li class="dropdown-header">Meldingen</li>

      @foreach($this->unreadNotifications as $notification)
        <li id="notification-{{ $notification->id }}" class="position-relative">
          <a class="dropdown-item d-flex align-items-start pe-4 notification-click" href="{{ $notification->data['url'] ?? '#' }}">
            <div>
              <div class="fw-bold">{{ $notification->data['title'] ?? 'No title' }}</div>
              @if(!empty($notification->data['subtitle']))
                <div class="text-muted small">{{ $notification->data['subtitle'] }}</div>
              @endif
              <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
            </div>
          </a>

          <button class="btn btn-sm btn-link text-danger position-absolute top-0 end-0 notification-dismiss"
            data-id="{{ $notification->id }}"
            style="padding: 0.25rem 0.5rem;">
            &times;
          </button>
        </li>
      @endforeach

      <li><hr class="dropdown-divider"></li>
    </ul>
  </li>
</div>
