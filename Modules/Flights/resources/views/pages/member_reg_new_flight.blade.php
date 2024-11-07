@extends('home::layouts.master')

@section('title', 'Vlucht aanmelden')

<main>
  @section('content')
    <div class="container mt-4 mb-4">
      <form class="col-lg-6 offset-lg-3 p-4 bg-dark rounded bg-opacity-25 shadow-xl" id="plane_submittion" action="{{ route('flights.store') }}" method="POST">
        @csrf
        <div class="justify-content-center">
          <!-- TOP TEXT AND IMAGE -->
          <h2 class="text-white text-center pt-2 pb-2">Registratie aanvang modelvliegen TRMC</h2>
          <img src="/app_media/field_and_members.jpg" class="img-fluid rounded mt-3 mb-3">

          <div class="form-group">
            <h5 class="text-white font-weight-bold">Naam modelvlieger:</h5>
            <select class="form-select" aria-label="Default select example" name="name">
              <option disabled selected>Selecteer een naam</option>
              @foreach ($users as $user)
                <option value={{ $user->id }}>{{ $user->name }}</option>
              @endforeach
            </select>
          </div>

          <!-- DATE -->
          <div class="form-group mt-2">
            <h5 class="text-white font-weight-bold">Datum:</h5>
            <input type="date" id="date" name="date" class="form-control" value="{{ old('date') }}" required>
          </div>

          <hr class="mt-3 mb-3">

          <!-- TIME -->
          <div class="row">
            <div class="col">
              <!-- START TIME -->
              <div class="form-group">
                <h5 class="text-white font-weight-bold">Start tijd:</h5>
                <input type="time" id="start_time" name="start_time" class="form-control" value="{{ old('start_time') }}" required>
              </div>
            </div>

            <div class="col">
              <!-- END TIME -->
              <div class="form-group">
                <h5 class="text-white font-weight-bold">Eind tijd:</h5>
                <input type="time" id="end_time" name="end_time" class="form-control" value="{{ old('end_time') }}" required>
              </div>
            </div>
          </div>

          <hr class="mt-3 mb-3">

          <div class="row">
            <div class="col">
              <!-- MODEL TYPE -->
              <div class="form-group mt-2">
                <h5 class="text-white font-weight-bold">Model type:</h5>
                <select class="form-control" id="model_type" name="model_type">
                  <option disabled selected>Selecteer</option>
                  <option value=1>Motor vliegtuig</option>
                  <option value=2>Zweef vliegtuig (zonder motor)</option>
                  <option value=5>Motor zweefvliegtuig</option>
                  <option value=3>Helikopter</option>
                  <option value=4>Drone</option>
                </select>
              </div>
            </div>

            <div class="col">
              <!-- POWER TYPE -->
              <div class="form-group mt-2">
                <h5 class="text-white font-weight-bold">Model vermogen:</h5>
                <select class="form-control" id="power_type" name="power_type">
                  <option disabled selected>Selecteer</option>
                  <option value=4>0W</option>
                  <option value=1>< 300W</option>
                  <option value=2>300W-1200W</option>
                  <option value=3>1200W-3000W</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <hr class="mt-3 mb-3">

        <!-- reCAPTCHA -->
        <div class="form-group mt-2">
          <h5 class="text-white font-weight-bold">Anti bot vraag:</h5>
          <input type="text" class="form-control" id="rechapcha_custom" name="rechapcha_custom" placeholder="Wat is 2 + 2?" value="{{ old('rechapcha_custom') }}" required>
        </div>

        <!-- SEND FORM BUTTON -->
        <button type="submit" class="btn font-weight-bold mt-3 text-white" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%)">Verzenden</button>
      </form>
      </div>

      <!-- HELP ICON -->
      <!--
      <a class="help_icon text-white mr-3 " data-toggle="modal" data-target="#helpModal" >
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
              <h4>Uitleg voor het invullen van het formulier:</h4>
              <p>Het formulier is gemaakt om je te helpen om een vlucht te plannen. Het formulier bevat een aantal vragen die je moet beantwoorden om een vlucht te plannen. De vragen zijn als volgt:</p>
              <p>1. Wat is uw naam? (Vul uw voor en achternaam in)</p>
              <p>2. Wat is uw vliegdatum? (De datum waarop u gaat vliegen)</p>
              <p>3. Wat is uw vliegtijd? (De tijd waarop u gaat vliegen)</p>
              <p>4. Met welke modellen gaat u vliegen? (meerdere zijn mogelijk. Vul voor ieder model de klassen in lipo aantal in.)</p>

              <p class="text-danger">Let er goed op dat alles goed is ingevuld! De rode letters geven aan wat nog ingevuld moet worden</p>

              <!-- -->
              <span aria-hidden="true"></span>
              <h4>Errors en contact:</h4>
              <p>Lukt het aanmelden nog niet of komt er een error? Neem dan contact met ons op via Email: <a href="mailto:webmaster@trmc.nl">webmaster@trmc.nl</a></p>

            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluit</button>
            </div>
          </div>
        </div>
      </div>
		</main>

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

    <script>
      document.addEventListener('DOMContentLoaded', async () => {
        // Do nothing if browser doesn't support local storage
        if(typeof Storage === 'undefined') return;

        // Check if user has a name_id in local storage
        const user = localStorage.getItem('name_id');
        // If not, do nothing
        if(!user) return;

        document.getElementById('name').value = user;
      });
    </script>
@stop