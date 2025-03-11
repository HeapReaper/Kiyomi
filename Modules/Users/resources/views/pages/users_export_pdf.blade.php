<!doctype html>
<html lang="nl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body class="ms-2 me-2 mt-2">
    <img class="img-fluid mt-4 ms-4 mb-4" src="{{ url('/') }}/app_media/trmc.png" style="width: 120px;" />
    <h1 class="fw-bold">
      Twentse Radio Modelvliegtuig club
    </h1>

    <h3>
      Leden export
    </h3>
    <p>
      Lid rollen in deze export:<br>
      - Test<br>
      - Test
    <hr>

    <table class="table">
      <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Naam</th>
        <th scope="col">Geboortedatum</th>
        <th scope="col">Adres</th>
        <th scope="col">Postcode</th>
        <th scope="col">Woonplaats</th>
        <th scope="col">Telefoon</th>
        <th scope="col">Email</th>
        <th scope="col">RDW</th>
        <th scope="col">KNVvL</th>
        <th scope="col">Rol</th>
        <th scope="col">Instructeur</th>
        <th scope="col">Brevetten</th>
        <th scope="col">Drone certificaten</th>
      </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
          <tr>
            <th scope="row">1</th>
            <td>Kelvin de Reus</td>
            <td>11-05-2001</td>
            <td>Tramstraat 3</td>
            <td>7141EE</td>
            <td>Groenlo</td>
            <td>0618014626</td>
            <td>kelvin@aerobytes.nl</td>
            <td>test</td>
            <td>test</td>
            <td>Lid</td>
            <td>Nee</td>
            <td>Motorvliegtuig</td>
            <td>Geen</td>
          </tr>
        @endforeach

      </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
