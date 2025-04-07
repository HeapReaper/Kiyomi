@extends('panel::layouts.master')

@section('title', 'Nieuw artikel')

@section('content')
  <script src="/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>

  <div class="container-fluid ms-4 mt-4">
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
            tinymce.init({
              selector: 'textarea',
              plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
              toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
              height: 600,
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
      </div>
    </div>
    </form>
  </div>
@stop
