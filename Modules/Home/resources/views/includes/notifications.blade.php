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
          <li>{{ $error }}</li>
        @endforeach
      </div>
    </div>
  </div>

  <script>
    (new bootstrap.Toast(document.getElementById('liveToast'))).show()
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
    (new bootstrap.Toast(document.getElementById('liveToast'))).show()
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
    (new bootstrap.Toast(document.getElementById('liveToast'))).show()
  </script>
@endif
