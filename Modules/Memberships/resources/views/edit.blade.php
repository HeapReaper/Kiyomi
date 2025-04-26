@extends('panel::layouts.master')

@section('title', 'Lidmaatschap bewerk')

@section('content')
  <div class="container bg-dark bg-opacity-25 rounded shadow-lg mt-2 p-2">
    <h2 class="text-white">Bewerk lidmaatschap</h2>

    <form action="{{ route('memberships.update', $membership->id) }}" method="POST" >
      @csrf
      @method('PUT')
      <div class="form-group mb-3">
        <label for="name" class="text-white font-weight-bold"><strong>Naam</strong></label>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="name"
               placeholder="Bijvoorbeeld: Donateurs, junior lid" value="{{ $membership->name }}" required>
      </div>

      <div class="form-group mb-3">
        <label for="description" class="text-white font-weight-bold"><strong>Beschrijving</strong></label>
        <textarea class="form-control" id="description" name="description" aria-describedby="description"
                  required rows="3">{{ $membership->description }}
        </textarea>
      </div>

      <div class="form-group mb-3">
        <label for="price" class="text-white font-weight-bold"><strong>Prijs (€)</strong></label>
        <input type="number" step="1" class="form-control" id="price" name="price" aria-describedby="price"
               placeholder="" value="{{ $membership->price }}" required>
      </div>

      <div class="form-group mb-3">
        <label for="payment_frequency" class="text-white font-weight-bold"><strong>Betaal frequentie</strong></label>
        <select class="form-control" id="payment_frequency" name="payment_frequency" required>
          <option value=1 @selected($membership->payment_frequency == 1)>
            Per maand
          </option>
          <option value=2 @selected($membership->payment_frequency == 2)>
            Per jaar
          </option>
        </select>
      </div>

      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="active" name="active" value="1"
          @checked($membership->active)>
        <label class="form-check-label text-white" for="active"><strong>Actief</strong></label>
      </div>

      <div class="mb-2">
        <label for="checkbox" class="text-white"><strong>Gebruikersgroep</strong></label>
        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="junior_member" id="junior_member" name="roles[]"
              @checked($membership->hasCustomRole('junior_member'))>
            <label class="form-check-label text-white" for="junior_member">
              Junior lid
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="aspirant_member" id="aspirant_member" name="roles[]"
              @checked($membership->hasCustomRole('aspirant_member'))>
            <label class="form-check-label text-white" for="aspirant_member">
              Aspirant lid
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="member" id="member" name="roles[]"
              @checked($membership->hasCustomRole('member'))>
            <label class="form-check-label text-white" for="member">
              Lid
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="management" id="management" name="roles[]"
              @checked($membership->hasCustomRole('management'))
            >
            <label class="form-check-label text-white" for="management">
              Bestuur
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="donor" id="donor" name="roles[]"
              @checked($membership->hasCustomRole('donor'))>
            <label class="form-check-label text-white" for="donor">
              Donateur
            </label>
          </div>
        </div>

      </div>

      <x-buttons.save />
    </form>
  </div>
@endsection
