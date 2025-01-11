@extends('panel::layouts.master')

@section('title', 'Instellingen')

@section('content')
  <div class="container" style="max-width: 30%;">
    <form action="{{ route('settings.store') }}" class="bg-dark bg-opacity-25 m-3 p-3 rounded" method="POST">
      @csrf

      <div class="mt-2 mb-2">
        <h3 class="text-white">Email</h3>
        <label for="email_new_members" class="form-label text-white">Email adres voor nieuwe leden melding</label>
        <input type="email" class="form-control" name="email_new_members" id="email_new_members" aria-describedby="email_new_members" value="{{ \App\Helpers\Settings::get('email_new_members') }}">
      </div>
      
      <hr style="color: white;">
      
      <div class="mt-2 mb-2">
        <h3 class="text-white">Leden login</h3>
        <label for="email_new_members" class="form-label text-white">Wie mag inloggen op deze website?</label>
        @foreach($roles as $role)
          @if ($role->name !== 'super admin')
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value=1 id="role_{{ $role->name }}_allowed_sign_in" name="role_{{ $role->name }}_allowed_sign_in"
              @if (\App\Helpers\Settings::get('role_' . $role->name . '_allowed_sign_in') == 1)
                checked
              @endif
              >
              <label class="form-check-label text-white" for="role_{{ $role->name }}_allowed_sign_in">
                {{ $role->name }}
              </label>
            </div>
          @endif
        @endforeach
      </div>

      <button type="submit" class="btn text-white" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%)">
        Opslaan
      </button>
    </form>
  </div>
  
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
  
@endsection