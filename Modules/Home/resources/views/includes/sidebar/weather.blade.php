<div class="mt-5">
  <div class="sidebar-header">
    <div class="sidebar-title fw-bold">
      Het weer op de club
    </div>
  </div>

  <div class="mt-4 mb-3">
    @php
        $response = \Illuminate\Support\Facades\Http::get(
          'https://api.weatherapi.com/v1/current.json', [
                'key'  => env('WEATHER_API_KEY'),
                'q'    => 'Boekelo',
                'lang' => 'nl',
            ]);

        if (!$response->successful()) {
          echo '<p>Fout bij het ophalen van de gegevens</p>';
          return;
        }

        $weather = $response->json();

        $windDirectionDegrees = [
          'N'  => 0,
          'NE' => 45,
          'E'  => 90,
          'SE' => 135,
          'S'  => 180,
          'SW' => 225,
          'W'  => 270,
          'NW' => 315,
        ];
    @endphp

    <p>
      Locatie: {{ $weather['location']['name'] }}<br>
      Temperatuur: {{ $weather['current']['temp_c'] }}C<br>
      Wind: {{ $weather['current']['wind_kph'] }}km/u<br>
      Windstoten: {{ $weather['current']['gust_kph'] }}km/u<br>
      Windrichting: {{ $weather['current']['wind_dir'] }}<br>
    </p>

    <div class="position-relative d-inline-block" style="height: 100px;">
      <img src="/app_media/field-top.png" class="img rounded" style="height: 100px;">

      <div class="position-absolute top-50 start-50 translate-middle">
        <x-heroicon-o-arrow-long-up
          id="wind-arrow"
          style="
            width: 46px;
            transform: rotate({{ $windDirectionDegrees[$weather['current']['wind_dir']] ?? 0 }}deg);
            color: white;
            "
        />
      </div>
    </div>
  </div>
</div>
