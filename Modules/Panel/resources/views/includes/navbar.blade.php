<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark bg-opacity-50">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="/">
      <img src="/app_media/faticon.ico" width="30" height="30" class="d-inline-block align-top ms-2" alt="">
      TRMC
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
          <ul class="dropdown-menu bg-dark">
            <li><a class="dropdown-item text-white" href="{{ route('flights-panel.index') }}">Overzicht</a></li>
            <li><a class="dropdown-item text-white" href="{{ route('flights-statistics.index') }}">Statistieken</a></li>
            <li><a class="dropdown-item text-white" href="{{ route('flights-report.index') }}">Rapportages</a></li>
            <!--<li><hr class="dropdown-divider"></li>-->
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Leden
          </a>
          <ul class="dropdown-menu bg-dark">
            <li><a class="dropdown-item text-white" href="{{ route('users.index') }}">Overzicht</a></li>
            <li><a class="dropdown-item text-white" href="{{ route('users-statistics.index') }}">Statistieken</a></li>
            <li><a class="dropdown-item text-white" href="{{ route('users.create') }}">Toevoegen</a></li>
            <li><a class="dropdown-item text-white" href="{{ route('contact.index') }}">Contact</a></li>
            <li><a class="dropdown-item text-white" href="{{ route('users-export.index') }}">Exporteer</a></li>
          </ul>
        </li>

        <!--
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Financieel
          </a>
          <ul class="dropdown-menu bg-dark">
            <a class="dropdown-item text-white" href="">Overzicht</a>
            <a class="dropdown-item text-white" href="">Lidmaatschapskosten</a>
            <a class="dropdown-item text-white" href="">Betalingen</a>
            <a class="dropdown-item text-white" href="">Terugkerende betalingen</a>
          </ul>
        </li>
        -->

        @can('view system')
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Systeem
            </a>
            <ul class="dropdown-menu bg-dark">
              <li><a class="dropdown-item text-white" href="{{ route('settings.index') }}">Instellingen</a></li>
              <li><a class="dropdown-item text-white" href="{{ route('logging.index') }}">Logs</a></li>
              <!--
              <a class="dropdown-item text-white" href="{{ route('mail.index') }}">Email templaten</a>
              -->
            </ul>
          </li>
        @endcan
      </ul>

      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Welkom {{ Auth::user()->name }}!
          </a>
          <ul class="dropdown-menu bg-dark">
            <li><a class="dropdown-item text-white" href="{{ route('users.edit', auth()->user()->id) }}">Profiel</a></li>
            <li><a class="dropdown-item text-white" href="/logout">Uitloggen</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<style>
  .dropdown-menu .dropdown-item:hover {
      background-color: rgba(0,0,0,0.2);
  }
  .dropdown-menu {
    position: absolute !important;
    z-index: 1000;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.2s ease;
  }

  .dropdown.show .dropdown-menu {
    display: block !important;
    opacity: 1;
    pointer-events: auto;
  }

  .nav-item.dropdown {
    margin-bottom: 0;
    padding-bottom: 0;
  }

  .navbar-nav > .nav-item {
    margin-bottom: 0;
    padding-bottom: 0;
  }
</style>
