@extends('panel::layouts.master')

@section('title', 'Contact')

@section('content')
  <div class="container mt-4 p-2 bg-dark rounded bg-opacity-25">
    <h4 class="text-white">Voor wie is deze email?</h4>
    <form action="{{ route('contact.store') }}", method="POST">
      @csrf
      <div class="form-check m-1">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" style="width: 20px; height: 20px">
        <label class="form-check-label text-white" for="flexCheckDefault">
          <strong>Jeugd leden</strong>
        </label>
      </div>

      <div class="form-check m-1">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" style="width: 20px; height: 20px">
        <label class="form-check-label text-white" for="flexCheckDefault">
          <strong>Aspirant leden</strong>
        </label>
      </div>

      <div class="form-check m-1">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" style="width: 20px; height: 20px">
        <label class="form-check-label text-white" for="flexCheckDefault">
          <strong>Leden</strong>
        </label>
      </div>

      <div class="form-check m-1">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" style="width: 20px; height: 20px">
        <label class="form-check-label text-white" for="flexCheckDefault">
          <strong>Bestuurs leden</strong>
        </label>
      </div>

      <div class="form-check m-1">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" style="width: 20px; height: 20px">
        <label class="form-check-label text-white" for="flexCheckDefault">
          <strong>Donateurs</strong>
        </label>
      </div>

      <div class="form-check m-1">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" style="width: 20px; height: 20px">
        <label class="form-check-label text-white" for="flexCheckDefault">
          <strong>Niet betaalden</strong>
        </label>
      </div>

      <div class="form-group m-1">
        <h4 class="text-white mt-2">Onderwerp</h4>
        <input type="text" class="form-control" id="subject" aria-describedby="subject" placeholder="Onderwerp...">
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
        <textarea name="text_editor">
          <!-- Text -->
        </textarea>
      </div>

      <button type="submit" class="btn text-white m-1" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%)">Verstuur</button>

    </form>
  </div>
@endsection