@extends('panel::layouts.master')

@section('title', 'Contact')

@section('content')
  <div class="m-2">
    <div class="container mt-4 p-2 bg-dark rounded shadow-lg bg-opacity-25">
      <h2 class="text-white font-weight-bold">Leden contact</h2>

      <h5 class="text-white">Voor wie is deze email?</h5>
      <form action="{{ route('contact.store') }}" method="POST">
        @csrf
        <div class="form-check m-1">
          <input class="form-check-input" type="checkbox" value="junior_member" id="junior_members" name="send_to[]" style="width: 20px; height: 20px">
          <label class="form-check-label text-white" for="flexCheckDefault">
            <strong>Jeugd leden</strong>
          </label>
        </div>

        <div class="form-check m-1">
          <input class="form-check-input" type="checkbox" value="aspirant_member" id="aspirant_member" name="send_to[]" style="width: 20px; height: 20px">
          <label class="form-check-label text-white" for="aspirant_member">
            <strong>Aspirant leden</strong>
          </label>
        </div>

        <div class="form-check m-1">
          <input class="form-check-input" type="checkbox" value="member" id="member" name="send_to[]" style="width: 20px; height: 20px">
          <label class="form-check-label text-white" for="member">
            <strong>Leden</strong>
          </label>
        </div>

        <div class="form-check m-1">
          <input class="form-check-input" type="checkbox" value="management" id="management" name="send_to[]" style="width: 20px; height: 20px">
          <label class="form-check-label text-white" for="management">
            <strong>Bestuurs leden</strong>
          </label>
        </div>

        <div class="form-check m-1">
          <input class="form-check-input" type="checkbox" value="donor" id="donor" name="send_to[]" style="width: 20px; height: 20px">
          <label class="form-check-label text-white" for="donor">
            <strong>Donateurs</strong>
          </label>
        </div>

        <div class="form-check m-1">
          <input class="form-check-input" type="checkbox" value="not_paid" id="not_paid" name="send_to[]" style="width: 20px; height: 20px">
          <label class="form-check-label text-white" for="not_paid">
            <strong>Niet betaalden</strong>
          </label>
        </div>

        <div class="form-check m-1">
          <input class="form-check-input" type="checkbox" value="to_yourself" id="to_yourself" name="send_to[]" style="width: 20px; height: 20px">
          <label class="form-check-label text-white" for="to_yourself">
            <strong>Naar jezelf</strong>
          </label>
        </div>

        <div class="form-group m-1">
          <h4 class="text-white mt-2">Onderwerp</h4>
          <input type="text" class="form-control" id="subject" name="subject" aria-describedby="subject" placeholder="Onderwerp...">
        </div>

        <script src="js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>

        <h4 class="text-white mt-2">Content</h4>

        <div class="m-1 mt-3">
          <script>
            tinymce.init({
              selector: 'textarea',
              plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
              toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
              height: 600,
            });
          </script>
          <textarea name="content">
            <!-- Text -->
          </textarea>
        </div>

        <x-buttons.send />
      </form>
    </div>
  </div>
@endsection
