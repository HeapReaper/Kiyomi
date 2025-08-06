@extends('panel::layouts.master')

@section('title', 'Logs')

@section('content')
  <div class="container bg-dark bg-opacity-25 rounded shadow-lg mt-4 p-2">
    <h2 class="text-white">Logs</h2>

    <div class="row">
      <div class="col">
        <div class="float-start">
          <ul class="nav nav-tabs" id="log-tabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="laravel-logs-tab" data-bs-toggle="tab" data-bs-target="#laravel-logs"
                      type="button" role="tab" aria-controls="home" aria-selected="true">
                Applicatie
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="user-error-tab" data-bs-toggle="tab" data-bs-target="#user-errors" type="button"
                      role="tab" aria-controls="profile" aria-selected="false">
                Gebruikers fouten
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="access-tab" data-bs-toggle="tab" data-bs-target="#access" type="button"
                      role="tab" aria-controls="profile" aria-selected="false">
                Toegang
              </button>
            </li>
          </ul>
        </div>
      </div>
      <div class="col">
        <div class="float-end">
          <a href="logs-purge" onclick="return confirm('Weet je zeker dat je de logs wilt wissen?')">
            <x-heroicon-o-trash class="image-hover-resize-10" stroke="white" style="width: 27px;"/>
          </a>
          <script>
          </script>
        </div>
      </div>
    </div>


    <div class="tab-content bg-dark rounded mt-2 mb-1 p-2" id="tab-content">
      <div class="tab-pane fade show active" id="laravel-logs" role="tabpanel" aria-labelledby="laravel-logs">
        @foreach(\App\Helpers\logs::laravel() as $logEntry)
          @if ($loop->index > 300)
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
      <div class="tab-pane fade" id="access" role="tabpanel" aria-labelledby="access">
        @foreach(\App\Helpers\logs::access() as $logEntry)
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
@endsection
