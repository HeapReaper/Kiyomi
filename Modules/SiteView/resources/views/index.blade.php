@extends('siteview::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('siteview.name') !!}</p>
@endsection
