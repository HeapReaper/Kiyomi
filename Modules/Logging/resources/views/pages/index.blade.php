@extends('panel::layouts.master')

@section('content')
  <h1>Hello World</h1>

  <p>Module: {!! config('logging.name') !!}</p>
@endsection
