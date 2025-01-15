@extends('panel::layouts.master')

@section('title', 'Financieel')

@section('content')
  <div class="container bg-dark bg-opacity-25 rounded shadow-lg mt-2 p-2">
    <!-- Page heading -->
    <div class="row">
      <div class="col text-start">
        <h3 class="text-white font-weight-bold">Financieel overzicht</h3>
      </div>
      
      <div class="col text-end">
        <input type="date" class="form-control">
      </div>
    </div>
    
    <hr style="margin-top: 2px; margin-bottom: 4px; color: white;">
  </div>
  
  <!-- Income / expenses summary -->
    <!-- Total Contributions Received -->
    <!-- Contributions by Period -->
    <!-- Outstanding Payments -->
    <!-- Payment Sources -->
  
  <!-- Recent transactions -->
  
  
  <!-- Alerts and Notifications -->
    <!-- Overdue Payments -->
    <!-- Upcoming recurring expenses -->
  
  <style>
    .form-control {
      background-color: rgba(255, 255, 255, 0.1) !important;
      border: 1px solid rgba(255, 255, 255, 0.2) !important;
      border-radius: 5px !important;
      padding: 10px !important;
      color: white !important;
      font-size: 14px !important;
      -webkit-appearance: listbox !important;
    }

    .form-control::placeholder {
      color: white !important;
    }

    .form-control:focus {
      color: white !important;
    }

    .form-control option {
      color: #000000;
      padding: 8px 16px;
      border: 1px solid transparent;
      border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
      cursor: pointer;
    }

    .form-control option:hover {
      background-color: #d53131 !important;
      color: white !important;
    }

    .form-control:after {
      position: absolute !important;
      content: "" !important;
      top: 14px !important;
      right: 10px !important;
      width: 0 !important;
      height: 0 !important;
      border: 6px solid !important;
      border-color: #fff !important;
    }

    .form-control:focus::placeholder {
      color: transparent !important;
    }
  </style>
@endsection