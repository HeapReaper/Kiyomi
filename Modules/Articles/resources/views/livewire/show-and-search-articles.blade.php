<div>
  <h4 class="text-white">Alle artikelen</h4>

  <!-- FILTERS -->
  <div class="row">
    <div class="col ml-2">
      <div class="float-start mb-4 ms-0 mt-2">
        <input wire:model.live="articleSearch" type="text" id="article_search" placeholder="#, author, title, slug" class="form-control rounded">
      </div>
    </div>
  </div>

  <table class="table table-custom-dark user-list ml-2 mr-2">
    <thead>
    <tr>
      <th scope="col" class="text-white">#</th>
      <th scope="col" class="text-white">Titel</th>
      <th scope="col" class="text-white">Slug</th>
      <th scope="col" class="text-white">Author</th>
      <th scope="col" class="text-white">Datum en tijd</th>
      <th scope="col" class="text-white">Gepubliceerd</th>
      <th scope="col" class="text-white">Categorieën</th>
      <th scope="col" class="text-white">Opties</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($articles as $article)
      <tr>
        <th scope="row" class="text-white">{{ $article->id }}</th>
        <th scope="row" class="text-white">{{ $article->title }}</th>
        <th scope="row" class="text-white">{{ $article->slug }}</th>
        <th scope="row" class="text-white">{{ $article->author->name }}</th>
        <th scope="row" class="text-white">
          {{ \Carbon\Carbon::parse($article->created_at)->format('d-m-Y H:i:s') }}
        </th>
        <th scope="row" class="text-white">{{ $article->published === true ? 'Ja' : 'Nee' }}</th>
        <th scope="row" class="text-white">
          @foreach($article->categories as $category)
            {{ $category->name }}<br>
          @endforeach
        </th>
        <td style="width: 20%;" class="text-center">
          <div style="display: flex;">
            <form action="{{ route('articles.edit', $article->id) }}" method="GET" style="margin-right: 10px;">
              @csrf
              <button type="submit" class="table-link text-info image-hover-resize-10" style="border: none; background: none; padding: 0; cursor: pointer;">
                <x-heroicon-o-pencil stroke="white" style="width: 27px;" />
              </button>
            </form>

            <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
              @method('DELETE')
              @csrf
              <button type="submit" class="table-link text-info image-hover-resize-10"
                      onclick="return confirm('Weet je zeker dat het artikel {{ $article->name }} wilt verwijderen?');"
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

  {!! $articles->links('pagination::bootstrap-5') !!}
</div>
