@extends('panel::layouts.master')

@section('title', 'Media')

@section('content')
  <div class="container">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Bestand</th>
          <th scope="col">Auteur</th>
          <th scope="col">Opties</th>
        </tr>
      </thead>
      <tbody>
      @foreach($files as $file)
        <tr>
          <th scope="row">{{ $loop->index }}</th>
          @switch($file)
            @case(str_contains($file, 'png'))
              <img src="{{ Storage::disk('minio')->url($file) }}" class="w-25">
              PNG: {{ $file }}<br>
              URL: {{ Storage::disk('minio')->url($file) }}
              @break
            @case(str_contains($file, 'pdf'))
              PDF: {{ $file }}<br>
              URL: {{ Storage::disk('minio')->url($file) }}
              @break
          @endswitch
        </tr>
      @endforeach
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
      </tbody>
    </table>
  </div>

@stop
