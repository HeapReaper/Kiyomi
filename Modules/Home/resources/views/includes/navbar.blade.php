<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-dark bg-opacity-50">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="/">
      <img src="/app_media/trmc.png" width="30" height="30" class="d-inline-block align-top ms-2" alt="">
      TRMC
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('home.index') }}">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('flights.create') }}">Vlucht aanmelden</a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('panel.index') }}">Login</a>
        </li>

      </ul>
    </div>
  </div>
</nav>