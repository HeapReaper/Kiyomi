@extends('panel::layouts.master')

@section('title', 'Leden')

@section('content')
  <div class="container-fluid">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <div class="container bootstrap mt-4 pl-0">
      <div class="row mt-3 mb-4">
        <div class="col-sm  ml-2 mr-2 text-center text-white">
          <h3>Aantal ingeschreven</h3>
          <h1>{{ $AllMembers ?? 0 }}</h1>
        </div>

        <div class="col-sm  ml-2 mr-2 text-center text-white">
          <h3>Aantal leden</h3>
          <h1></h1>
        </div>

        <div class="col-sm  ml-2 mr-2 text-center text-white">
          <h3>Aantal donateurs</h3>
          <h1></h1>
        </div>
      </div>
        @livewire('show-users')
    </div>
  </div>


  <style>
    body{
        background:#eee;
    }
    .main-box.no-header {
        padding-top: 20px;
    }
    .main-box {
        -webkit-box-shadow: 1px 1px 2px 0 #CCCCCC;
        -moz-box-shadow: 1px 1px 2px 0 #CCCCCC;
        -o-box-shadow: 1px 1px 2px 0 #CCCCCC;
        -ms-box-shadow: 1px 1px 2px 0 #CCCCCC;
        box-shadow: 1px 1px 2px 0 #CCCCCC;
        margin-bottom: 16px;
        -webikt-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }
    .table a.table-link.danger {
        color: #e74c3c;
    }
    .label {
        border-radius: 3px;
        font-size: 0.875em;
        font-weight: 600;
    }
    .user-list tbody td .user-subhead {
        font-size: 0.875em;
        font-style: italic;
    }
    .user-list tbody td .user-link {
        display: block;
        font-size: 1.25em;
        padding-top: 3px;
        margin-left: 0px;
    }
    a {
        color: #ffffff;
        outline: none!important;
    }
    .user-list tbody td>img {
        position: relative;
        max-width: 50px;
        float: left;
        margin-right: 15px;
    }

    .table thead tr th {
        text-transform: uppercase;
        font-size: 0.875em;
    }
    .table thead tr th {
    }
    .table tbody tr td:first-child {
        font-size: 1.125em;
        font-weight: 300;
    }
    .table tbody tr td {
        font-size: 0.875em;
        vertical-align: middle;
        border-top: 1px solid #e7ebee;
        padding: 2px 2px;
    }
    a:hover{
    text-decoration:none;
    }
  </style>
@endsection