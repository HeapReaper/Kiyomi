<!doctype html>
<html lang="nl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body class="ms-2 me-2 mt-2">
    <!--
    <img class="img-fluid mt-4 ms-4 mb-4" src="{{ asset('app_media/trmc.png') }}" style="width: 120px;" />
    -->
    <h1 class="fw-bold">
      Twentse Radio Modelvliegtuig club
    </h1>

    <h3>
      Leden export
    </h3>
    <p>
      Lid rollen in deze export:<br>
      @foreach($included_roles as $role)
        {{ $role }}<br>
      @endforeach
    <hr>

    <table class="table table-striped table-bordered" style="width: 100%;">
      <thead>
        <tr>
          <th style="width: 5%;">ID</th>
          <th style="width: 10%;">Naam</th>
          <th style="width: 8%;">Geboortedatum</th>
          <th style="width: 12%;">Adres</th>
          <th style="width: 8%;">Postcode</th>
          <th style="width: 12%;">Woonplaats</th>
          <th style="width: 8%;">Telefoon</th>
          <th style="width: 12%;">Email</th>
          <th style="width: 5%;">RDW</th>
          <th style="width: 5%;">KNVvL</th>
          <th style="width: 5%;">Rol</th>
          <th style="width: 5%;">Instructeur</th>
          <th style="width: 8%;">Brevetten</th>
          <th style="width: 8%;">Drone certificaten</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
          <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->birthdate }}</td>
            <td>{{ $user->address }}</td>
            <td>{{ $user->zip_code }}</td>
            <td>{{ $user->city }}</td>
            <td>{{ $user->mobile_phone }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->rdw_number }}</td>
            <td>{{ $user->knvvl }}</td>
            <td>
              @if ($user->hasRole('junior_member')) Jeugd lid @endif
              @if ($user->hasRole('aspirant_member')) Aspirant lid @endif
              @if ($user->hasRole('member')) Lid @endif
              @if ($user->hasRole('management')) Bestuur @endif
              @if ($user->hasRole('donor')) Donateur @endif
              @if ($user->hasRole('not_paid')) Niet betaald @endif
            </td>
            <td>{{ $user->instruct === 0 ? 'Nee' : 'Ja' }}</td>
            <td>
              @if ($user->has_plane_brevet === 1) Motorvliegtuig<br> @endif
              @if ($user->has_helicopter_brevet === 1) Helikopter<br> @endif
              @if ($user->has_glider_brevet === 1) Zweefvliegtuig @endif
            </td>
            <td>
              @if ($user->has_drone_a1 === 1) A1<br> @endif
              @if ($user->has_drone_a2 === 1) A2<br> @endif
              @if ($user->has_drone_a3 === 1) A3 @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>

  <style>
      table td, table th {
          font-size: 8pt;
          padding: 4px;
      }
      table td {
          word-wrap: break-word;
      }
  </style>
</html>
