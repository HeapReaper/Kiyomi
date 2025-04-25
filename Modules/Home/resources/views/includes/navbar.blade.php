<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-dark bg-opacity-50">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="/">
      <img src="/app_media/faticon.ico" width="30" height="30" class="d-inline-block align-top ms-2" alt="">
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
          <a class="nav-link text-white" href="{{ route('articles-public.index') }}">Nieuws</a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('flights.create') }}">Vlucht aanmelden</a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('new_member.create') }}">Aanmelden als nieuw lid</a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('panel.index') }}">
              {{ Auth::check() ? 'Dashboard' : 'login' }}
            </a>
        </li>

        <button class="btn" id="theme-toggle">
          <img src="/app_media/moon.png" style="width: 30px; color: white;" id="theme-icon"/>
        </button>

        <script>
          document.addEventListener('DOMContentLoaded', function() {
            const currentTheme = localStorage.getItem('theme');
            const icon = document.getElementById('theme-icon');

            if (localStorage.getItem('theme') === 'dark') {
              icon.src = '/app_media/sun.png';
            } else {
              icon.src = '/app_media/moon.png';
            }

            if (currentTheme) {
              document.body.classList.add(currentTheme);
            }

            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
              if (currentTheme) return;
              document.body.classList.add('dark');
            } else {
              if (currentTheme) return;
              document.body.classList.add('light');
            }
          });

          document.getElementById('theme-toggle').addEventListener('click', function () {
            const currentTheme = localStorage.getItem('theme') || 'light';
            const icon = document.getElementById('theme-icon');

            console.log('Changing theme');
            console.log('Current theme from local storage: ' + currentTheme)

            const newTheme = currentTheme === 'light' ? 'dark' : 'light';

            console.log('New theme from local storage: ' + newTheme)

            document.body.classList.remove(currentTheme);
            document.body.classList.add(newTheme);

            localStorage.setItem('theme', newTheme);

            if (icon.className === 'heroicon-s-moon') {
              icon.className = 'heroicon-s-sun'; // Change this to the appropriate icon for dark mode
            } else {
              icon.className = 'heroicon-s-moon'; // Change this to the appropriate icon for light mode
            }


            location.reload();

          });
        </script>
      </ul>
    </div>
  </div>
</nav>
