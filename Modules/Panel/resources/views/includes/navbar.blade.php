<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="/">
      <img src="/app_media/Kiyomi_logo.png" width="30" height="30" class="d-inline-block align-top ms-2" alt="">
      Kiyomi
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-0">

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Vluchten
          </a>
          <ul class="dropdown-menu">
            <a class="dropdown-item" href="">Overzicht</a>
            <a class="dropdown-item" href="">Rapportages</a>
            <!--<li><hr class="dropdown-divider"></li>-->
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Leden
          </a>
          <ul class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('users.index') }}">Overzicht</a>
            <a class="dropdown-item" href="{{ route('users.create') }}">Toevoegen</a>
            <a class="dropdown-item" href="">Contact</a>
            <!--<li><hr class="dropdown-divider"></li>-->
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Instellingen
          </a>
          <ul class="dropdown-menu">
            <a class="dropdown-item" href="">Algemeen</a>
            <a class="dropdown-item" href="">Email</a>
            <!--<li><hr class="dropdown-divider"></li>-->
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Systeem
          </a>
          <ul class="dropdown-menu">
            <a class="dropdown-item" href="">Logs</a>
            <!--<li><hr class="dropdown-divider"></li>-->
          </ul>
        </li>

      </ul>

      <ul class="navbar-nav ms-auto"> 
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Welkom {{ Auth::user()->name }}!
          </a>
          <ul class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('users.edit', auth()->user()->id) }}">Profiel</a>
            <a class="dropdown-item" href="/logout">Uitloggen</a>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
