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
    @livewireStyles

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.css') }}" rel="stylesheet">
    <script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.bundle.js') }}"></script>

    {{-- Vite CSS --}}
    {{-- {{ module_vite('build-admin', 'resources/assets/sass/app.scss') }} --}}
  </head>

  <body>
    <main>
      @include('panel::includes.navbar')

      <!-- Errors -->
      @if ($errors->any())
        <div class="toast-container showposition-fixed bottom-0 end-0 p-3">
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

      @if (session()->has('error'))
        <div class="toast-container showposition-fixed bottom-0 end-0 p-3">
          <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
              <img src="/app_media/trmc.png" class="rounded me-2" alt="..." style="max-width: 35px">
              <strong class="me-auto">Fout!</strong>
              <small>Een paar seconden geleden</small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
              {{ session('error') }}
            </div>
          </div>
        </div>

        <script>
          (new bootstrap.Toast(document.getElementById('liveToast'))).show()
        </script>
      @endif

      <!-- Success -->
      @if(session('success'))
        <div class="toast-container showposition-fixed bottom-0 end-0 p-3">
          <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
              <img src="/app_media/trmc.png" class="rounded me-2" alt="..." style="max-width: 35px">
              <strong class="me-auto">Success!</strong>
              <small>Een paar seconden geleden</small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
              {{ session('success') }}
            </div>
          </div>
        </div>

        <script>
          (new bootstrap.Toast(document.getElementById('liveToast'))).show()
        </script>
      @endif

      <!-- Success -->
      @if (session()->has('success'))
        <div class="toast-container showposition-fixed bottom-0 end-0 p-3">
          <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
              <img src="/app_media/trmc.png" class="rounded me-2" alt="..." style="max-width: 35px">
              <strong class="me-auto">Success!</strong>
              <small>Een paar seconden geleden</small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
              {{ session('success') }}
            </div>
          </div>
        </div>

        <script>
          (new bootstrap.Toast(document.getElementById('liveToast'))).show()
        </script>
      @endif

      @yield('content')

      {{-- Vite JS --}}
      {{-- {{ module_vite('build-admin', 'resources/assets/js/app.js') }} --}}

      <style>
        body, html {
          background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%);
          width: 100%;
          height: 100%;
          background-attachment: fixed;
          font-family: 'Open Sans', sans-serif;
        }

        #name_search {
          background-color: rgba(255, 255, 255, 0.1);
          border: 1px solid rgba(255, 255, 255, 0.2);
          border-radius: 5px;
          padding: 10px;
          color: white;
          font-size: 14px;
        }

        #name_search::placeholder {
          color: white;
        }

        #name_search:focus::placeholder {
            color: transparent;
        }

        .form-control {
          background-color: rgba(255, 255, 255, 0.1) !important;
          border: 1px solid rgba(255, 255, 255, 0.2) !important;
          border-radius: 5px !important;
          padding: 10px !important;
          color: white !important;
          font-size: 14px !important;
          -webkit-appearance: listbox !important;
        }

        .form-control::placeholder {
          color: white !important;
        }

        .form-control:focus {
          color: white !important;
        }

        .form-control option {
          color: #ffffff;
          padding: 8px 16px;
          border: 1px solid transparent;
          border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
          cursor: pointer;
        }

        .form-control option:hover {
          background-color: #d53131 !important;
          color: white !important;
        }

        .form-control:after {
          position: absolute !important;
          content: "" !important;
          top: 14px !important;
          right: 10px !important;
          width: 0 !important;
          height: 0 !important;
          border: 6px solid !important;
          border-color: #fff !important;
        }

        .form-control:focus::placeholder {
          color: transparent !important;
        }

        .form-check-input:checked {
          background-color: green;
          border-color: #2b5c93;
        }

        .table-custom-dark {
            background-color: transparent;
            color: white;
        }

        .table-custom-dark th,
        .table-custom-dark td {
            background-color: transparent;
            border-color: rgba(255, 255, 255, 0.1);
        }

        .table-custom-dark thead th {
            border-bottom-color: rgba(255, 255, 255, 0.3);
        }

        .table-custom-dark tbody tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .table-custom-dark a {
            color: white;
        }

        .form-control:focus {
            border-color: #000000;
            box-shadow: 0 0 0 0.2rem rgba(0, 128, 0, 0.25);
        }
        input[type="checkbox"]:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 128, 0, 0.25);
        }

        .image-hover-resize-10-shadow {
            transition: transform 0.3s ease;
        }

        .image-hover-resize-10-shadow:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transform: scale(1.2);
        }

        .image-hover-resize-10 {
            transition: transform 0.3s ease;
        }

        .image-hover-resize-10:hover {
            transform: scale(1.2);
        }
        .dropdown-toggle::after {
             display: inline-block;
             margin-left: 0.255em;
             vertical-align: 0.255em;
             content: "";
             border-top: 0.3em solid;
             border-right: 0.3em solid transparent;
             border-bottom: 0;
             border-left: 0.3em solid transparent;
             transition: transform 0.6s ease-in-out;
         }

        .dropdown-toggle.show::after {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            opacity: 0;
            transition: opacity 0.1s ease-in-out;
            display: block;
            pointer-events: none; /* Initially disabled */
        }

        .dropdown-menu.show {
            opacity: 1;
            pointer-events: auto; /* Enabled when shown */
        }

        .badge {
            width: 100px;
        }

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

      <livewire:scripts />
      @livewireScripts
    </main>
  </body>
</html>
