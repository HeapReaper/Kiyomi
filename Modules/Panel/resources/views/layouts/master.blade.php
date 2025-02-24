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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
          const toastLiveExample = document.getElementById('liveToast')
          const toast = new bootstrap.Toast(toastLiveExample)
          toast.show()
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
          const toastLiveExample = document.getElementById('liveToast')
          const toast = new bootstrap.Toast(toastLiveExample)
          toast.show()
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
      </style>
      <style>
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
          color: #000000;
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
      </style>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

      <livewire:scripts />
      @livewireScripts
    </main>
  </body>
</html>
