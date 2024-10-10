@extends('panel::layouts.master')

@section('title', 'Vluchten')

@section('content')
  <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">

  <main>
    <!-- Total container-->
    <div class="container">
      <!-- Total -->
      <h1 class="text-white mt-4">Vluchten overzicht</h1>
      <!-- Total cards -->
      <div class="row">
        <!-- Total flights -->
        <div class="col-sm text-center ml-2 mr-2 mt-2 bg-dark bg-opacity-75 rounded m-2">
          <h3 class="text-white mt-2">Totaal:</h3>
          <h1 class="text-white"></h1>
        </div>
        <!-- This week flights -->
        <div class="col-sm text-center ml-2 mr-2 mt-2 bg-dark bg-opacity-75 rounded m-2">
          <h3 class="text-white mt-2">Deze week:</h3>
          <h1 class="text-white"></h1>
        </div>
        <!-- Today flights -->
        <div class="col-sm text-center ml-2 mr-2 mt-2 bg-dark bg-opacity-75 rounded m-2">
          <h3 class="text-white mt-2">Vandaag:</h3>
          <h1 class="text-white"></h1>
        </div>
      </div>
      <!-- End total cards -->
    </div>

    <!-- Table last flights -->
    <div class="container bg-dark bg-opacity-75 rounded">
      <h1 class="mt-4 text-white">Vluchten</h1>
      <div class="table-responsive">
        <table class="table table-striped table-hover text-white ml-2 mr-2">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Naam</th>
              <th scope="col">Datum</th>
              <th scope="col">Tijd</th>
              <th scope="col">Vlucht informatie</th>
              <th scope="col">Bewerk/verwijder</th>

            </tr>
          </thead>
            <tbody>

            </tbody>
        </table>
      </div>
    </div>

    <!-- HELP ICON -->
    <!--
    <a class="help_icon text-white mr-3" data-toggle="modal" data-target="#helpModal" >
      <img class="img-fluid" src="/media/images/help.ico" alt="help" style="width: 50px;"></img>
    </a>
    -->
    <!-- HELP MODAL -->
    <div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="helpModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="helpModalLabel">Hulp</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- -->
            <h4>Uitleg voor het gebruiken van de admin pagina:</h4>
            <p>wip</p>
            <!-- -->
            <span aria-hidden="true"></span>
            <h4>Errors en contact:</h4>
            <p>Is er een error of lukt iets niet? Neem dan contact met ons op via Email: <a href="mailto:webmaster@auticodes.nl">webmaster@auticodes.nl</a></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluit</button>
          </div>
        </div>
      </div>
    </div>
  </main>

  <style>
    body, html {
    background-color: #2f3031;
  }
  .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
    background-color: #5c3838;
  }

  .help_icon {
    position: fixed;
    bottom:0;
    right: 0;
    padding: 10px;
  }

  input[type="checkbox"] {
    width: 1.2rem;
    height: 1.2rem;
    border-radius: 50%;
  }
  </style>
@stop