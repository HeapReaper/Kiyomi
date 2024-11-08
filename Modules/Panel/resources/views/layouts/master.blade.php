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

  @include('panel::includes.head')
  <!-- Favicon -->
  <link rel="icon" href="/app_media/faticon.ico" type="image/x-icon">
  <livewire:styles />
  @livewireStyles
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

  {{-- Vite CSS --}}
  {{-- {{ module_vite('build-admin', 'resources/assets/sass/app.scss') }} --}}
</head>

<body>
  @include('panel::includes.navbar')

  <!-- Errors -->
  @if ($errors->any())
    <div class="toast-container showposition-fixed bottom-0 end-0 p-3">
      <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <img src="/app_media/Kiyomi_logo.png" class="rounded me-2" alt="..." style="max-width: 35px">
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
      const toastLiveExample = document.getElementById('liveToast')
      const toast = new bootstrap.Toast(toastLiveExample)
      toast.show()
    </script>
  @endif

  @if (session()->has('error'))
    <div class="toast-container showposition-fixed bottom-0 end-0 p-3">
      <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <img src="/app_media/Kiyomi_logo.png" class="rounded me-2" alt="..." style="max-width: 35px">
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
      const toastLiveExample = document.getElementById('liveToast')
      const toast = new bootstrap.Toast(toastLiveExample)
      toast.show()
    </script>
  @endif

  <!-- Success -->
  @if (session()->has('success'))
    <div class="toast-container showposition-fixed bottom-0 end-0 p-3">
      <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <img src="/app_media/Kiyomi_logo.png" class="rounded me-2" alt="..." style="max-width: 35px">
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
      const toastLiveExample = document.getElementById('liveToast')
      const toast = new bootstrap.Toast(toastLiveExample)
      toast.show()
    </script>
  @endif

  @yield('content')

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  {{-- Vite JS --}}
  {{-- {{ module_vite('build-admin', 'resources/assets/js/app.js') }} --}}

  <style>
    body, html {
      background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%);
      width: 100%;
      height: 100%;
      background-attachment: fixed;
    }

  </style>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <livewire:scripts />
  @livewireScripts
</body>