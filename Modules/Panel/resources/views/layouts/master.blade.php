<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" >
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title')</title>

    <meta name="description" content="{{ $description ?? '' }}">
    <meta name="keywords" content="{{ $keywords ?? '' }}">
    <meta name="author" content="{{ $author ?? '' }}">

    <!-- Favicon -->
    <link rel="icon" href="app_media/faticon.ico" type="image/x-icon">
    <livewire:styles />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.css') }}" rel="stylesheet">
    <script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.bundle.js') }}"></script>

    {{-- Vite CSS --}}
    {{-- {{ module_vite('build-admin', 'resources/assets/sass/app.scss') }} --}}
    @vite(['Modules/Panel/resources/assets/js/app.js', 'Modules/Panel/resources/assets/css/app.css'])
  </head>

  <body>
    <main>
      @include('panel::includes.navbar')

      <!-- Errors -->
      @if ($errors->any())
        <div class="toast-container show position-fixed bottom-0 end-0 p-3">
          <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
              <img src="/app_media/trmc.png" class="rounded me-2" alt="..." style="max-width: 35px">
              <strong class="me-auto">Fout!</strong>
              <small>Een paar seconden geleden</small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
              @foreach ($errors->all() as $error)
              <li>{{ session('error') }}</li>
              @endforeach
            </div>
          </div>
        </div>

        <script>
          (new bootstrap.Toast(document.getElementById('liveToast'))).show()
        </script>
      @endif


      <div class="toast-container showposition-fixed bottom-0 end-0 p-3">
        <div id="liveToastError" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <img src="/app_media/trmc.png" class="rounded me-2" alt="..." style="max-width: 35px">
            <strong class="me-auto">Fout!</strong>
            <small>Een paar seconden geleden</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body" id="toastBodyContent">
            {{ session('error') }}
          </div>
        </div>
      </div>
      @if (session()->has('error'))
        <script>
          (new bootstrap.Toast(document.getElementById('liveToastError'))).show()
        </script>
      @endif

      <!-- Success -->
      @if(session('success'))
        <div class="toast-container show position-fixed bottom-0 end-0 p-3">
          <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
              <img src="/app_media/trmc.png" class="rounded me-2" alt="..." style="max-width: 35px">
              <strong class="me-auto">Success!</strong>
              <small>Een paar seconden geleden</small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toastBodyContent">
              {{ session('success') }}
            </div>
          </div>
        </div>

        <script>
          (new bootstrap.Toast(document.getElementById('liveToast'))).show()
        </script>
      @endif

      <!-- Success -->
      <div class="toast-container show position-fixed bottom-0 end-0 p-3">
        <div id="liveToastSuccess" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <img src="/app_media/trmc.png" class="rounded me-2" alt="..." style="max-width: 35px">
            <strong class="me-auto">Success!</strong>
            <small>Een paar seconden geleden</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body" id="toastBodyContent">
            {{ session('success') }}
          </div>
        </div>
      </div>
      @if (session()->has('success'))
        <script>
          (new bootstrap.Toast(document.getElementById('liveToastSuccess'))).show()
        </script>
      @endif

      @yield('content')

      {{-- Vite JS --}}
      {{-- {{ module_vite('build-admin', 'resources/assets/js/app.js') }} --}}
      <livewire:scripts />
    </main>
  </body>
</html>
