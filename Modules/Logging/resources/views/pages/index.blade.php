@extends('panel::layouts.master')

@section('content')
  <div class="container bg-dark bg-opacity-25 rounded shadow-lg mt-4 p-2">
    <h2 class="text-white">Logs</h2>

    <ul class="nav nav-tabs" id="log-tabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="laravel-logs-tab" data-bs-toggle="tab" data-bs-target="#laravel-logs"
                type="button" role="tab" aria-controls="home" aria-selected="true">
          Laravel logs
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="user-error-tab" data-bs-toggle="tab" data-bs-target="#user-errors" type="button"
                role="tab" aria-controls="profile" aria-selected="false">
          Gebruiker fout log
        </button>
      </li>
    </ul>

    <div class="tab-content bg-dark rounded mt-2 mb-1 p-2" id="tab-content">
      <div class="tab-pane fade show active" id="laravel-logs" role="tabpanel" aria-labelledby="laravel-logs">
        @foreach(\App\Helpers\logs::laravel() as $logEntry)
          @if ($loop->index > 50)
            @break
          @endif
          <code>
            {{ $logEntry }}
            <br>
          </code>
        @endforeach
      </div>
      <div class="tab-pane fade" id="user-errors" role="tabpanel" aria-labelledby="user-errors">
        @foreach(\App\Helpers\logs::userError() as $logEntry)
          @if ($loop->index > 50)
            @break
          @endif
          <code>
            {{ $logEntry }}
            <br>
          </code>
        @endforeach
      </div>
    </div>
  </div>

  <style>
      .nav-tabs {
          border-bottom: none !important;
      }

      .nav-tabs .nav-link {
          background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%) !important;
          color: white !important;
          transition: all 0.3s ease-in-out;
          border-radius: 3px;
      }

      .nav-tabs .nav-item {
          background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%) !important;
          color: white !important;
          border-radius: 3px;
      }

      .nav-tabs .nav-link.active {
          background-color: rgba(0, 0, 0, 0.0) !important;
          color: white !important;
          border-radius: 3px;
      }
  </style>
@endsection
