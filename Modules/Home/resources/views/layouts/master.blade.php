<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title')</title>

    <meta name="description" content="{{ $description ?? '' }}">
    <meta name="keywords" content="{{ $keywords ?? '' }}">
    <meta name="author" content="{{ $author ?? '' }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.css') }}" rel="stylesheet">
    <script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.js') }}"></script>

    <link rel="icon" href="/app_media/faticon.ico" type="image/x-icon">

    {{-- Vite CSS --}}
    {{-- {{ module_vite('build-home', 'resources/assets/sass/app.scss') }} --}}
    @vite(['Modules/Home/resources/assets/js/app.js', 'Modules/Home/resources/assets/css/app.css'])
  </head>

  <body>
    <!-- Header image -->
    <div class="position-relative">
      <img src="app_media/header-img.jpg" class="img-fluid w-100 header-img" alt="Overlay Image">
      <div class="position-absolute start-50 translate-middle text-white text-center header-text" style="top: 25%">
        <h1 class="fw-bold display-6">
          Twentse Radio Modelvlieg Club
        </h1>
        <p class="mt-3">
          Een prachtige hobby – Modelvliegen.
        </p>
      </div>
    </div>

    @include('home::includes.navbar')

    <main class="m-2">

      <div class="row mt-3">
        <div class="col-12 col-md-8">
          <div class="ms-2">
            @yield('content')
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="me-2">
            @include('home::includes.sidebar-search')
            @include('home::includes.sidebar-login')
            @include('home::includes.sidebar-clubs')
            @include('home::includes.sidebar-vacations')
          </div>
        </div>
      </div>

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
                <li>{{ $error }}</li>
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
    </main>

    <style>
      body, html {
        background-color: white;
        width: 100%;
        min-height: 100%;
        background-attachment: fixed;
        font-family: 'Open Sans', sans-serif;
      }

      .form-control:focus {
        border: solid #d80414 !important;
        outline: none;
        box-shadow: 0 0 0 0.0rem rgba(0, 0, 0, 0);
      }

      .form-control:hover {
        border: solid #d80414 !important;
        outline: none;
        box-shadow: 0 0 0 0.0rem rgba(0, 0, 0, 0);
      }

      input[type="checkbox"]:focus {
          box-shadow: 0 0 0 0.2rem rgba(0, 128, 0, 0.25);
      }

      .form-control option {
          color: #ffffff;
          padding: 8px 16px;
          border: 1px solid transparent;
          border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
          cursor: pointer;
      }

      .header-img {
        object-fit: cover;
      }

      @media (max-width: 768px) {
        .header-text  {
          margin-top: 20px;
          top: 50%;
          width: 90%;
        }

        .header-img {
          height: 200px;
        }
      }

      @media (max-width: 480px) {
        .header-text {
          top: 55%;
          font-size: 16px;
        }
      }

      .navbar {
        background-color: #d80414 !important;
      }

      .sidebar-header {
        padding: 10px;
        position: relative;
      }

      .sidebar-title {
        background-color: #d80414;
        color: white;
        padding: 8px 30px;
        position: absolute;
        top: 0;
        left: 0;
        clip-path: polygon(0 0, 80% 0, 100% 100%, 0 100%); /** angle shape **/
      }
    </style>


    {{-- Vite JS --}}
    {{-- {{ module_vite('build-home', 'resources/assets/js/app.js') }} --}}
  </body>
</html>
