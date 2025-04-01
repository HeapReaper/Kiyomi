@extends('articles::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('articles.name') !!}</p>
@endsection
