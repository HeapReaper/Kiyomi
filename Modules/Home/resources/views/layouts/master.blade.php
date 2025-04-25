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
  <script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.bundle.js') }}"></script>

  <link rel="icon" href="/app_media/faticon.ico" type="image/x-icon">

  {{-- Vite CSS --}}
  {{-- {{ module_vite('build-home', 'resources/assets/sass/app.scss') }} --}}

  @vite(['Modules/Home/resources/assets/js/app.js'])
  <script>
    if (localStorage.getItem('theme') == 'dark') {
      const link = document.createElement('link');
      link.rel = 'stylesheet';
      link.href = "{{ mix('Modules/Home/resources/assets/css/app-dark.css') }}";
      document.head.appendChild(link);
    } else {
      const link = document.createElement('link');
      link.rel = 'stylesheet';
      link.href = "{{ mix('Modules/Home/resources/assets/css/app.css') }}";
      document.head.appendChild(link);
    }
  </script>

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
        @include('home::includes.sidebar.search')
        @include('home::includes.sidebar.login')
        @include('home::includes.sidebar.weather')
        @include('home::includes.sidebar.clubs')
        @include('home::includes.sidebar.vacations')
        @include('home::includes.sidebar.trmc')
        @include('home::includes.sidebar.organisations')
        @include('home::includes.sidebar.social-media')
      </div>
    </div>
  </div>

  <!-- NOTIFICATIONS -->
  @include('home::includes.notifications')
</main>
<!-- FOOTER -->
@include('home::includes.footer')


{{-- Vite JS --}}
{{-- {{ module_vite('build-home', 'resources/assets/js/app.js') }} --}}
</body>
</html>
