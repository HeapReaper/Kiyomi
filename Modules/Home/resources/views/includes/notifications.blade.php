<!-- Errors -->
<div class="toast-container show position-fixed bottom-0 end-0 p-3">
  <div id="liveToastMultipleErrors" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="/app_media/faticon.ico" class="rounded me-2" alt="..." style="max-width: 35px">
      <strong class="me-auto">Fout!</strong>
      <small>Een paar seconden geleden</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body" id="toastBodyErrors">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </div>
  </div>
</div>

@if ($errors->any())
  <script>
    (new bootstrap.Toast(document.getElementById('liveToastMultipleErrors'))).show()
  </script>
@endif

<!-- Single error -->
<div class="toast-container show position-fixed bottom-0 end-0 p-3">
  <div id="liveToastError" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="/app_media/faticon.ico" class="rounded me-2" alt="..." style="max-width: 35px">
      <strong class="me-auto">Fout!</strong>
      <small>Een paar seconden geleden</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body" id="toastBodyError">
      {{ session('error') }}
    </div>
  </div>
</div>

@if (session()->has('error'))
  <script>
    (new bootstrap.Toast(document.getElementById('liveToastError'))).show()
  </script>
@endif

<!-- Success -->
<div class="toast-container show position-fixed bottom-0 end-0 p-3">
  <div id="liveToastSuccess" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="/app_media/faticon.ico" class="rounded me-2" alt="..." style="max-width: 35px">
      <strong class="me-auto">Success!</strong>
      <small>Een paar seconden geleden</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body" id="toastBodySuccess">
      {{ session('success') }}
    </div>
  </div>
</div>
@if (session()->has('success'))
  <script>
    (new bootstrap.Toast(document.getElementById('liveToastSuccess'))).show()
  </script>
@endif
