@extends('panel::layouts.master')

@section('title', 'Bewerk artikel')

@section('content')
  <script src="/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>

  <div class="container-fluid ms-4 mt-2">
    <form method="POST" action="{{ route('articles.update', $article->id) }}">
      @csrf
      @method('PUT')

      <div class="row">
        <div class="col-9 me-3 bg-dark rounded bg-opacity-25 shadow-lg">
          <div class="mt-3 mb-3">
            <div class="mt-3 mb-3 ">
              <label for="title" class="form-label text-white">Titel</label>
              <input type="text" class="form-control" placeholder="Titel..." name="title" value="{{ $article->title }}">
            </div>

            <script>
              const fileUploadUrl = '/articles/upload-media';

              tinymce.init({
                selector: 'textarea',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                height: 600,

                media_live_embeds: true,

                images_upload_url: fileUploadUrl,
                automatic_uploads: true,

                file_picker_types: 'image media',

                file_picker_callback: (callback, value, meta) => {
                  const existingMedia = document.querySelectorAll('img, video');
                  let existingMediaSrc = [];

                  existingMedia.forEach(media => {
                    existingMediaSrc.push(media.src);
                  });

                  const input = document.createElement('input');
                  input.setAttribute('type', 'file');

                  if (meta.filetype === 'image') {
                    input.setAttribute('accept', 'image/*');
                  } else if (meta.filetype === 'media') {
                    input.setAttribute('accept', 'video/*');
                  }

                  input.onchange = function () {
                    const file = this.files[0];

                    if (existingMediaSrc.includes(URL.createObjectURL(file))) {
                      console.log('File already exists in content, skipping upload.');
                      return;
                    }

                    const formData = new FormData();
                    formData.append('file', file);

                    fetch(fileUploadUrl, {
                      method: 'POST',
                      headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                      },
                      body: formData,
                    })
                      .then(res => res.json())
                      .then(data => {
                        if (data.location) {
                          callback(data.location);
                        } else {
                          alert('Upload failed');
                        }
                      })
                      .catch(err => {
                        console.error('Upload error:', err);
                        alert('Error uploading file: ', err);
                      });
                  };

                  input.click();
                },

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
                },

                drag_drop: true,
              });

            </script>
            <textarea name="content">
              <!-- Text -->
              {{ $article->content }}
          </textarea>
          </div>

          <button type="submit" class="btn text-white m-1 mb-3" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%)">Update</button>
        </div>

        <div class="col-2 ms-3 bg-dark rounded bg-opacity-25 shadow-lg">
          <div class="mt-3 mb-3">
            <p class="text-white fw-bold">Categorieën</p>
            @foreach($categories as $category)
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="{{ $category->slug }}" name="categories[]"
                @checked($article->categories->contains('id', $category->id) )>
                <label class="form-check-label text-white" for="{{ $category->slug }}">{{ $category->name }}</label>
              </div>
            @endforeach
          </div>

          <hr class="text-white">

          <div class="mt-3 mb-3">
            <p class="text-white fw-bold">Publicatie</p>

            <div class="form-check form-switch">
              <input class="form-check-input" value=1 type="checkbox" id="publication" name="publication"
              @checked($article->published === true)>
              <label class="form-check-label text-white" for="publication">Publicatie</label>
            </div>
          </div>

          <hr class="text-white">

          <p class="text-white fw-bold">Auteur</p>

          <div class="mt-3 mb-3">
            <select class="form-control form-control-lg selector_custom" name="author">
              @foreach($users as $user)
                <option value={{ $user->id }} @selected($user->id === $article->user_id)>{{ $user->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
    </form>
  </div>
@stop
