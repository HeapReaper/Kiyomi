@extends('panel::layouts.master')

@section('title', 'Nieuw artikel')

@section('content')
  <script src="/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>

  <div class="container-fluid ms-4 mt-2">
    <form method="POST" action="{{ route('articles.store') }}">
    <div class="row">
      @csrf
      <div class="col-lg-9 me-3 bg-dark rounded bg-opacity-25 shadow-lg">
        <div class="mt-3 mb-3">
          <div class="mt-3 mb-3 ">
            <label for="title" class="form-label text-white">Titel</label>
            <input type="text" class="form-control" placeholder="Titel..." name="title" value="{{ old('title') }}">
          </div>

          <script>
            const fileUploadUrl = '/articles/upload-media';
            tinymce.init({
              selector: 'textarea',
              plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
              toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
              height: 600,
              images_upload_url: fileUploadUrl,
              automatic_uploads: true,
              images_upload_handler: (blobInfo, success, failure) => {
                const formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());

                fetch(fileUploadUrl, {
                  method: 'POST',
                  headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                  },
                  body: formData,
                })
                  .then(response => response.json())
                  .then(json => {
                    if (json.location) {
                      success(json.location);
                    } else {
                      failure('Upload failed: ' + (json.error || 'Unknown error'));
                    }
                  })
                  .catch(err => {
                    failure('Fetch error: ' + err.message);
                  });
              }
            });
          </script>
          <textarea name="content">
            <!-- Text -->
            {{ old('content') }}
          </textarea>
        </div>

        <div class="mb-2">
          <x-buttons.save />
        </div>
      </div>

      <div class="col-lg-2 ms-3 bg-dark rounded bg-opacity-25 shadow-lg">
        <div class="mt-3 mb-3">
          <p class="text-white fw-bold">Categorieën</p>
          @foreach($categories as $category)
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="{{ $category->slug }}" name="categories[]">
              <label class="form-check-label text-white" for="{{ $category->slug }}">{{ $category->name }}</label>
            </div>
          @endforeach
        </div>

        <hr class="text-white">

        <div class="mt-3 mb-3">
          <p class="text-white fw-bold">Publicatie</p>

          <div class="form-check form-switch">
            <input class="form-check-input" value=1 type="checkbox" id="publication" name="publication">
            <label class="form-check-label text-white" for="publication">Publicatie</label>
          </div>
        </div>

        <hr class="text-white">

        <p class="text-white fw-bold">Auteur</p>

        <div class="mt-3 mb-3">
          <select class="form-control form-control-lg selector_custom" name="author">
            @foreach($users as $user)
              <option value={{ $user->id }} @selected(Auth::id() == $user->id)>{{ $user->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
    </form>
  </div>
@stop
