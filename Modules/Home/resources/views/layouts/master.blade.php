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

    <main>

      <div class="row">
        <div class="col-8">
          @yield('content')
        </div>

        <div class="col-4">

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

      .form-control {
          background-color: rgba(255, 255, 255, 0.1) !important;
          border: 1px solid rgba(255, 255, 255, 0.2) !important;
          border-radius: 5px !important;
          padding: 10px !important;
          color: white !important;
          font-size: 14px !important;
          -webkit-appearance: listbox !important;
      }

      .form-control:focus {
          border-color: #000000;
          box-shadow: 0 0 0 0.2rem rgba(0, 128, 0, 0.25);
      }
      input[type="checkbox"]:focus {
          box-shadow: 0 0 0 0.2rem rgba(0, 128, 0, 0.25);
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
    </style>


    {{-- Vite JS --}}
    {{-- {{ module_vite('build-home', 'resources/assets/js/app.js') }} --}}
  </body>
</html>
