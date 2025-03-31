<div class="mt-5">
  <div class="sidebar-header">
    <div class="sidebar-title fw-bold">
      @if (Auth::check())
        Welkom {{ Auth::user()->name }}!
      @else
        Inloggen
      @endif
    </div>
  </div>

  <form class="mt-4">
    @if (Auth::check())
      <div class="row">
        <div class="col d-flex justify-content-center align-items-center">
          <div class="mt-4 mb-3">
            @if (Auth::user()->profile_picture)
              <img src="{{ asset('storage/uploads/' . Auth::user()->profile_picture) }}" class="img-fluid rounded-circle" style="max-width: 80px; object-fit: cover;">
            @else
              <img src="https://placehold.co/80x80" class="rounded-circle">
            @endif
          </div>
        </div>

        <div class="col">
          <div class="mt-4 mb-3">
            <a href="#" class="sidebar-links">
              Dashboard
            </a>
          </div>

          <div class="mt-4 mb-3">
            <a href="#" class="sidebar-links">
              Profiel
            </a>
          </div>

          <div class="mt-4 mb-3">
            <a href="/logout" class="sidebar-links">
              Uitloggen
            </a>
          </div>
        </div>
      </div>

    @else
      <form>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label text-black">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Email..." aria-describedby="">
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Wachtwoord</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Wachtwoord...">
        </div>

        <button type="submit" class="btn fw-bold button-subtle-animation" style="background-color: #d80414; color: white; width: 100px;">Log in</button>
        <br>
        <small class="text-dark">Wachtwoord vergeten? <a href="{{ route('password.request') }}">Klik hier</a></small>
      </form>
    @endif
  </form>

</div>
