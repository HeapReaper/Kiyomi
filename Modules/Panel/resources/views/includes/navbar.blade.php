<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-dark">
  <a class="navbar-brand text-white" href="/">
    <img src="/app_media/Kiyomi_logo.png" width="30" height="30" class="d-inline-block align-top ms-2" alt="">
    Kiyomi
  </a>
  <button class="navbar-toggler me-2" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-white" href="/">Home</a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Vluchten
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="">Overzicht</a>
          <a class="dropdown-item" href="">Rapportages</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Leden
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="">Overzicht</a>
          <a class="dropdown-item" href="">Toevoegen</a>
          <a class="dropdown-item" href="">Contact</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Bestuur
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="">Overzicht</a>
          <a class="dropdown-item" href="">Toevoegen</a>
          <a class="dropdown-item" href="">Contact</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Instellingen
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="">Algemeen</a>
          <a class="dropdown-item" href="">Email</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Systeem
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="">Logs</a>
        </div>
      </li>
    </ul>

    <ul class="navbar-nav ms-auto"> 
      <li class="nav-item dropdown mr-3">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Welkom {{ Auth::user()->name }}!
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('users.edit', auth()->user()->id) }}">Profiel</a>
          <a class="dropdown-item" href="/logout">Uitloggen</a>
        </div>
      </li>
    </ul>

  </div>
</nav>