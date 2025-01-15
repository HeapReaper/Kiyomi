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
        <div class="mb-4 me-4 float-end">
          <select wire:model.live="year" class="form-control form-control-lg selector_custom">
            <option value="2024">
              2024
            </option>
            <option value="2025">
              2025
            </option>
            <option value="2026">
              2026
            </option>
          </select>
        </div>
      </div>
    </div>
    
    <hr style="margin-top: 2px; margin-bottom: 4px; color: white;">
    
    <h3 class="text-white font-weight-bold mt-2 mb-2">Contributies 2024</h3>

    <!-- Contributions -->
    <div class="row justify-content-center align-items-center" style=";">
      <div class="col-auto">
        <div class="card text-white bg-dark bg-opacity-25 mb-3" style="max-width: 18rem;">
          <div class="card-header">Ontvangen</div>
          <div class="card-body">
            <h5 class="card-title">€ 750</h5>
            <p class="card-text">Berekening: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          </div>
        </div>
      </div>
      
      <div class="col-auto">
        <div class="card text-white bg-dark bg-opacity-25 mb-3" style="max-width: 18rem;">
          <div class="card-header">Betaalde contributies aantal</div>
          <div class="card-body">
            <h5 class="card-title">23</h5>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          </div>
        </div>
      </div>

      <div class="col-auto">
        <div class="card text-white bg-dark bg-opacity-25 mb-3" style="max-width: 18rem;">
          <div class="card-header">Openstaande contributies aantal</div>
          <div class="card-body">
            <h5 class="card-title">23</h5>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          </div>
        </div>
      </div>
      
      <div class="col-auto">
        <div class="card text-white bg-dark bg-opacity-25 mb-3" style="max-width: 18rem;">
          <div class="card-header">Openstaand</div>
          <div class="card-body">
            <h5 class="card-title">€ 750</h5>
            <p class="card-text">Berekening: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          </div>
        </div>
      </div>
    </div>
    
    <hr style="margin-top: 2px; margin-bottom: 4px; color: white;">
    
    <h3 class="text-white font-weight-bold mt-2 mb-2">Betalingen 2024</h3>

    <!-- Recent transactions -->
    <div class="row justify-content-center align-items-center p-4" style="">
      <table class="table table-responsive table-striped">
        <thead>
          <tr class="text-white">
            <th scope="col">#</th>
            <th scope="col">Naam</th>
            <th scope="col">Lidmaatschap type</th>
            <th scope="col">Lidmaatschap kosten</th>
            <th scope="col">Datum betaling</th>
            <th scope="col">Betaling methode</th>
          </tr>
        </thead>
        <tbody >
          <tr class="text-white">
            <th scope="row" class="text-white">1</th>
            <td class="text-white">Kelvin de Reus</td>
            <td class="text-white">Lid</td>
            <td class="text-white">€ 55</td>
            <td class="text-white">15-01-2024</td>
            <td class="text-white">IDEAL</td>
          </tr>
        </tbody>
      </table>
    </div>
    
    <hr style="margin-top: 2px; margin-bottom: 4px; color: white;">
    
    <h3 class="text-white font-weight-bold mt-2 mb-2">Notificaties achterstand</h3>
    
    <!-- Alerts and notifications -->
    <div class="row justify-content-center align-items-center p-4" style="">
      <table class="table table-responsive table-striped">
        <thead>
          <tr class="text-white">
            <th scope="col">#</th>
            <th scope="col">Naam</th>
            <th scope="col">Lidmaatschap type</th>
            <th scope="col">Lidmaatschap kosten</th>
            <th scope="col">Dagen achter met betaling</th>
            <th scope="col">Herinnering</th>
          </tr>
        </thead>
        <tbody >
          <tr class="text-white">
            <th scope="row" class="text-white">1</th>
            <td class="text-white">Kelvin de Reus</td>
            <td class="text-white">Lid</td>
            <td class="text-white">€ 55</td>
            <td class="text-white">3</td>
            <td class="text-white">
              <button class="btn text-white" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%); padding-bottom: 0px; padding-top: 0px">Stuur</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  
  <!-- Going to livewire -->
  <!-- Income / expenses summary -->
    <!-- Total Contributions Received -->
    <!-- Contributions by Period -->
    <!-- Outstanding Payments -->
    <!-- Payment Sources -->
  
  
  <!-- Going to livewire -->
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