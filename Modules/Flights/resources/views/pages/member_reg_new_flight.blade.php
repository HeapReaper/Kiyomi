@extends('home::layouts.master')

@section('title', 'Vlucht aanmelden')

@section('content')
  <form class="" id="plane_submittion" action="{{ route('flights.store') }}" method="POST" onsubmit="setName()">
    @csrf
      <!-- TOP TEXT AND IMAGE -->
      <h2 class="text-dark text-center pt-2 fw-bold"">Registratie aanvang modelvliegen TRMC</h2>
        <img src="/app_media/field_and_members.jpg" class="img-fluid p-2" style="border-radius: 1.25rem;">

      <div class="form-group m-2">
        <h5 class="text-dark">Naam modelvlieger:</h5>
        <input class="form-control" type="text" name="name" id="name" placeholder="Volledige naam" value="{{ old('name') }}" onload="getName()">
        <small id="nameHelp" class="form-text text-dark">Na de 1e keer succesvol invullen wordt je naam automatisch ingevuld.</small>
      </div>

      <!-- DATE -->
      <div class="form-group mt-2 p-2">
        <h5 class="text-dark">Datum:</h5>
        <input type="date" id="date" name="date" class="form-control" value="{{ old('date') }}" required>

        <button type="button" class="btn text-white mt-2 fw-bold button-subtle-animation" style="background-color: #d80414;">
          Vandaag
        </button>
      </div>

      <hr class="mt-3 mb-3">

      <!-- TIME -->
      <div class="row">
        <div class="col">
          <!-- START TIME -->
          <div class="form-group p-2">
            <h5 class="text-dark">Start tijd:</h5>
            <input type="time" id="start_time" name="start_time" class="form-control" value="{{ old('start_time') }}" required>

            <button type="button" class="btn text-white mt-2 fw-bold button-subtle-animation" style="background-color: #d80414;" onclick="changeStartTime()">
              Start vlucht
            </button>
          </div>
        </div>

        <div class="col">
          <!-- END TIME -->
          <div class="form-group p-2">
            <h5 class="text-dark">Eind tijd:</h5>
            <input type="time" id="end_time" name="end_time" class="form-control" value="{{ old('end_time') }}" required>

            <button type="button" class="btn text-white mt-2 fw-bold button-subtle-animation" style="background-color: #d80414;" onclick="changeEndTime()">
              Einde vlucht
            </button>
          </div>
        </div>

      </div>

      <hr class="mt-3 mb-3">

      <div class="row">
        <div class="col">
          <!-- MODEL TYPE -->
          <div class="form-group mt-2 p-2">
            <h5 class="text-dark">Model type:</h5>
            <select class="form-control" id="model_type" name="model_type" required>
              <option disabled selected>Selecteer</option>
              <option value=1 {{ old('model_type') == 1 ? 'selected' : '' }}>Motor vliegtuig</option>
              <option value=2 {{ old('model_type') == 2 ? 'selected' : '' }}>Zweef vliegtuig (zonder motor)</option>
              <option value=5 {{ old('model_type') == 5 ? 'selected' : '' }}>Motor zweefvliegtuig</option>
              <option value=3 {{ old('model_type') == 3 ? 'selected' : '' }}>Helikopter</option>
              <option value=4 {{ old('model_type') == 4 ? 'selected' : '' }}>Drone</option>
            </select>
          </div>
        </div>

        <div class="col">
          <!-- POWER TYPE -->
          <div class="form-group mt-2 p-2">
            <h5 class="text-dark">Model vermogen:</h5>
            <select class="form-control" id="power_type" name="power_type" required>
              <option disabled selected>Selecteer</option>
              <option value=4 {{ old('power_type') == 4 ? 'selected' : '' }}>0W</option>
              <option value=1 {{ old('power_type') == 1 ? 'selected' : '' }}>< 300W</option>
              <option value=2 {{ old('power_type') == 2 ? 'selected' : '' }}>300W-1200W</option>
              <option value=3 {{ old('power_type') == 3 ? 'selected' : '' }}>1200W-3000W</option>
            </select>
          </div>
        </div>
      </div>

    <hr class="mt-3 mb-3">

    <!-- reCAPTCHA -->
    <div class="form-group mt-2 p-2" id="rechapcha" name="rechapcha" hidden>
      <h5 class="text-dark">Anti bot vraag:</h5>
      <input type="text" class="form-control" id="rechapcha_custom" name="rechapcha_custom" placeholder="Wat is 2 + 2?" value="{{ old('rechapcha_custom') }}" required>
    </div>

    <!-- SEND FORM BUTTON -->
    <button type="submit" class="btn mt-2 m-2 text-white fw-bold button-subtle-animation" style="background-color: #d80414;">Verzenden</button>
  </form>

    @if (session()->has('success'))
      <script>
        localStorage.setItem('validatedUser', '4');
      </script>
    @endif

    <script>
      function getCurrentTimeInNetherlands() {
        const now = new Date();
        const amsterdamTimeZone = 'Europe/Amsterdam';
        const amsterdamTime = new Date(now.toLocaleString('en-US', { timeZone: amsterdamTimeZone }));

        const options = {
          hour: 'numeric',
          minute: 'numeric',
          hour12: false,
        };

        const formattedTime = amsterdamTime.toLocaleString('nl-NL', options);

        return formattedTime;
      }

      document.onload = changeCurrentDateOnDateInput();

      function changeCurrentDateOnDateInput() {
        const now = new Date()
        document.getElementById('date').value = now.getFullYear() + '-' + (now.getMonth() + 1) + '-' + now.getDate();
      }

      document.addEventListener('DOMContentLoaded', async () => {
        document.getElementById('date').value = (new Date()).toISOString().split('T')[0];

        if(typeof Storage === 'undefined') return;

        const user = localStorage.getItem('name_id');
        if(user) {
          document.getElementById('name').value = user;
        }
      });

      function changeStartTime() {
        document.getElementById('start_time').value = getCurrentTimeInNetherlands();
      }

      function changeEndTime() {
        document.getElementById('end_time').value = getCurrentTimeInNetherlands();
      }

      function setName(e) {
          localStorage.setItem('name', document.getElementById('name').value);
      }

      document.addEventListener('DOMContentLoaded', async () => {
        document.getElementById('name').value = localStorage.getItem('name');

        if (localStorage.getItem('name')) {
            document.getElementById('nameHelp').hidden = true;
        }

        if (localStorage.getItem('validatedUser')) {
          document.getElementById('rechapcha_custom').value = Number(localStorage.getItem('validatedUser'));
          document.getElementById('rechapcha').hidden = true;
        } else {
          document.getElementById('rechapcha').hidden = false;
        }
      });

      document.addEventListener('DOMContentLoaded', function () {
          const modelTypeSelect = document.getElementById('model_type');
          const powerTypeSelect = document.getElementById('power_type');
          const zeroWOption = powerTypeSelect.querySelector('option[value="4"]');

          modelTypeSelect.addEventListener('change', function () {
            if (modelTypeSelect.value === '2') {
                zeroWOption.hidden = false;
            } else {
                zeroWOption.hidden = true;
            }
          });
      });
    </script>
@stop
