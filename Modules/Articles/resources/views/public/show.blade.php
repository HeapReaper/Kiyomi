@extends('home::layouts.master')

@section('title', $article->title)

@section('content')
  <div class="container mt-3 border shadow rounded">
    @foreach($article->categories as $category)
      <span class="badge mt-2" style="background-color: #d80414;">
        {{ $category->name }}
      </span>
    @endforeach

    <h1 class="fw-bold mt-2">{{$article->title}}</h1>

    <hr>

    <div class="mb-3">
      <p class="mb-0">
        @if ($article->author->profile_picture)
          <img src="{{ Storage::url('uploads/' . $article->author->profile_picture) }}" class="img-fluid rounded-circle mb-1" style="max-width: 40px; object-fit: cover;">
        @else
          <img src="https://placehold.co/80x80" class="rounded-circle">
        @endif

        <x-heroicon-s-clock width="20" class="mb-1" style="color: #d80414;" />
        {{ \Carbon\Carbon::parse($article->created_at)->format('d-m-Y') }}
        <x-heroicon-s-user width="20" class="mb-1" style="color: #d80414;" />
        {{ $article->author->name }}
      </p>
    </div>

    <div>
      {!! $article->content !!}
    </div>
  </div>
@stop
