@extends('home::layouts.master')

@section('title', 'Vlucht aanmelden')

<main>
  @section('content')
    <div class="m-2">
      <div class="container mt-2 p-2">
        <form class="col-lg-6 offset-lg-3 bg-dark rounded bg-opacity-25 shadow-xl" id="plane_submittion" action="{{ route('flights.store') }}" method="POST" onsubmit="setName()">
          @csrf
          <div class="justify-content-center">
            <!-- TOP TEXT AND IMAGE -->
            <h2 class="text-white text-center pt-2 ">Registratie aanvang modelvliegen TRMC</h2>
              <img src="/app_media/field_and_members.jpg" class="img-fluid p-2" style="border-radius: 1.25rem;">

            <div class="form-group m-2">
              <h5 class="text-white font-weight-bold">Naam modelvlieger:</h5>
              <input class="form-control" type="text" name="name" id="name" placeholder="Volledige naam" value="{{ old('name') }}" onload="getName()">
              <small id="nameHelp" class="form-text text-white">Na de 1e keer succesvol invullen wordt je naam automatisch ingevuld.</small>
            </div>

            <!-- DATE -->
            <div class="form-group mt-2 p-2">
              <h5 class="text-white font-weight-bold">Datum:</h5>
              <input type="date" id="date" name="date" class="form-control" value="{{ old('date') }}" required>

              <button type="button" class="btn text-white mt-2" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%);">
                Vandaag
              </button>
            </div>

            <hr class="mt-3 mb-3">

            <!-- TIME -->
            <div class="row">
              <div class="col">
                <!-- START TIME -->
                <div class="form-group p-2">
                  <h5 class="text-white font-weight-bold">Start tijd:</h5>
                  <input type="time" id="start_time" name="start_time" class="form-control" value="{{ old('start_time') }}" required>

                  <button type="button" class="btn text-white mt-2" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%);" onclick="changeStartTime()">
                    Start vlucht
                  </button>
                </div>
              </div>

              <div class="col">
                <!-- END TIME -->
                <div class="form-group p-2">
                  <h5 class="text-white font-weight-bold">Eind tijd:</h5>
                  <input type="time" id="end_time" name="end_time" class="form-control" value="{{ old('end_time') }}" required>

                  <button type="button" class="btn text-white mt-2" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%);" onclick="changeEndTime()">
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
                  <h5 class="text-white font-weight-bold">Model type:</h5>
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
                  <h5 class="text-white font-weight-bold">Model vermogen:</h5>
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
          </div>

          <hr class="mt-3 mb-3">

          <!-- reCAPTCHA -->
          <div class="form-group mt-2 p-2" id="rechapcha" name="rechapcha" hidden>
            <h5 class="text-white font-weight-bold">Anti bot vraag:</h5>
            <input type="text" class="form-control" id="rechapcha_custom" name="rechapcha_custom" placeholder="Wat is 2 + 2?" value="{{ old('rechapcha_custom') }}" required>
          </div>

          <!-- SEND FORM BUTTON -->
          <button type="submit" class="btn font-weight-bold mt-3 m-2 text-white" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%)">Verzenden</button>
        </form>
      </div>
    </div>
</main>

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

    .form-check-input:checked {
        background-color: green;
        border-color: #2b5c93;
    }
  </style>
      <style>
        input[type="checkbox"] {
          width: 1.2rem;
          height: 1.2rem;
          border-radius: 50%;
        }

        hr {
          padding-top: 1px;
          padding-bottom: 1px;
          background-color: #ffffff;
          margin-top: 5px;
          margin-bottom: 5px;
        }
      </style>

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
  </div>
@stop
