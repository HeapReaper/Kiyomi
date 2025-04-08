@extends('home::layouts.master')

@section('title', 'Artikelen')

@section('content')
  @foreach($articles as $article)
    <div class="container mt-3 border shadow rounded">
      <div class="row">

        @if ($article->image !== null)
          <div class="col-md-3 d-flex justify-content-center align-items-center">
            <img src="{{$article->image}}" alt="picture" class="img-fluid rounded" style="max-width: 150px; max-height: 150px; object-fit: contain;">
          </div>
        @endif

        @if ($article->image !== null)
          <div class="col-md-9">
        @else
          <div class="col-md-12">
        @endif
          <div class="custom-card">
            <span class="badge mt-2" style="background-color: #d80414;">Nieuws</span>
            <a href="#" style="color: black;">
              <h3 class="mt-2 fw-bold">{{ $article->title }}</h3>
            </a>
            <p class="mb-0">
              <x-heroicon-s-clock width="20" class="mb-1" style="color: #d80414;" />
              {{ \Carbon\Carbon::parse($article->created_at)->format('d-m-Y') }}
              <x-heroicon-s-user width="20" class="mb-1" style="color: #d80414;" />
              {{ $article->author->name }}
            </p>
            <p>
              {!! Str::words(strip_tags($article->content), 20) !!}
            </p>
          </div>
        </div>
      </div>
    </div>
  @endforeach
@stop
