@extends('panel::layouts.master')

@section('title', 'Categorieën')

@section('content')
  <div class="container mt-4">
    <div class="row">
      <div class="col me-1 bg-dark rounded bg-opacity-25 shadow-lg">
        <h1 class="text-white">Categorie maken</h1>

        <form method="POST" action="{{ route('categories.store') }}">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label text-white">Naam</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Naam...">
          </div>

          <div class="mb-3">
            <label for="slug" class="form-label text-white">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug...">
          </div>

          <div class="mb-3">
            <x-buttons.save />
          </div>
        </form>
      </div>

      <div class="col ms-1 bg-dark rounded bg-opacity-25 shadow-lg">
        <h1 class="text-white">Categorieën</h1>

        <table class="table table-custom-dark user-list ml-2 mr-2" >
          <thead>
            <tr>
              <th scope="col" class="text-white">#</th>
              <th scope="col" class="text-white">Naam</th>
              <th scope="col" class="text-white">Slug</th>
              <th scope="col" class="text-white">Opties</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($categories as $category)
              <tr>
                <th scope="row" class="text-white">{{ $category->id }}</th>
                <td class="text-white">{{ $category->name }}</td>
                <td class="text-white">{{ $category->slug }}</td>
                <td class="text-white">
                  <div style="display: flex;">
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="table-link text-info image-hover-resize-10"
                              onclick="return confirm('Weet je zeker dat je de categorie <> wilt verwijderen?');"
                              style="border: none; background: none; padding: 0; cursor: pointer;">
                        <x-heroicon-o-trash stroke="white" style="width: 27px;" />
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@stop
