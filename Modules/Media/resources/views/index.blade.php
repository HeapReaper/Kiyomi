@extends('panel::layouts.master')

@section('title', 'Media')

@section('content')
  @foreach($files as $file)
    @switch($file)
      @case(str_contains($file, 'png'))
        PNG: {{ $file }}<br>
        @break
      @case(str_contains($file, 'pdf'))
        PDF: {{ $file }}<br>
        @break
    @endswitch
  @endforeach
@stop
