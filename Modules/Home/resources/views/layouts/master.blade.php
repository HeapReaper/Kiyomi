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
      <img src="/app_media/header-img.jpg" class="img-fluid w-100 header-img" alt="Overlay Image">
      <div class="position-absolute start-50 translate-middle text-white text-center header-text" style="top: 25%">
        <h1 class="fw-bold display-6">
          Twentse Radio Modelvlieg Club
        </h1>
        <p class="mt-3">
          Een prachtige hobby – Modelvliegen.
        </p>
      </div>
    </div>

    <!-- NAVBAR -->
    @include('home::includes.navbar')

    <!-- PAGE CONTENT -->
    <main class="m-2">
      <div class="row mt-3">
        <!-- MAIN TEXT -->
        <div class="col-12 col-md-8">
          <div class="ms-2">
            @yield('content')
          </div>
        </div>

        <!-- SIDE BAR -->
        <div class="col-12 col-md-4">
          <div class="me-2">
            @include('home::includes.sidebar-search')
            @include('home::includes.sidebar-login')
            @include('home::includes.sidebar-clubs')
            @include('home::includes.sidebar-vacations')
            @include('home::includes.sidebar-organisations')
            @include('home::includes.sidebar-social-media')
            @include('home::includes.sidebar-trmc')
          </div>
        </div>
      </div>

      <!-- NOTIFICATIONS -->
      @include('home::includes.notifications')
    </main>
    <!-- FOOTER -->
    @include('home::includes.footer')

    <style>
      :root {
        --primary-style-color: #d80414;
      }

      body, html {
        background-color: white;
        width: 100%;
        min-height: 100%;
        background-attachment: fixed;
        font-family: 'Open Sans', sans-serif;
      }

      .form-control:focus {
        outline: 2px solid var(--primary-style-color);
        box-shadow: 0 0 0 0.0rem rgba(0, 0, 0, 0);
      }

      .form-control:hover {
        outline: 2px solid var(--primary-style-color);
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
        background-color: var(--primary-style-color) !important;
      }

      .sidebar-header {
        padding: 10px;
        position: relative;
      }

      .sidebar-title {
        background-color: var(--primary-style-color);
        color: white;
        padding: 4px 40px 4px 4px;
        position: absolute;
        top: 0;
        left: 0;
        clip-path: polygon(0 0, 80% 0, 100% 100%, 0 100%); /** angle shape **/
      }

      .sidebar-links {
        color: black;
        text-decoration: underline var(--primary-style-color);
        display: inline-block;
        transition: transform 0.3s ease;
      }

      .sidebar-links:hover {
        transform: translateX(5px);
      }

      .button-subtle-animation {
        transition: transform 0.2s ease-in-out;
      }

      .button-subtle-animation:hover {
        transform: scale(1.05);
      }

      footer {
        background-color: var(--primary-style-color);
        padding: 0 !important;
        margin: 0 !important;
      }


    </style>

    {{-- Vite JS --}}
    {{-- {{ module_vite('build-home', 'resources/assets/js/app.js') }} --}}
  </body>
</html>
