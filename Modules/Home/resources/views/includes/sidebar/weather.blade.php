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
            'N'   => 180,
            'NNE' => 202.5,
            'NE'  => 225,
            'ENE' => 247.5,
            'E'   => 270,
            'ESE' => 292.5,
            'SE'  => 315,
            'SSE' => 337.5,
            'S'   => 0,
            'SSW' => 22.5,
            'SW'  => 45,
            'WSW' => 67.5,
            'W'   => 90,
            'WNW' => 112.5,
            'NW'  => 135,
            'NNW' => 157.5,
        ];
    @endphp

    <div class="row">
      <div class="col">
        <p>
          Locatie: {{ $weather['location']['name'] }}<br>
          Temperatuur: {{ $weather['current']['temp_c'] }}C<br>
          Wind: {{ $weather['current']['wind_kph'] }}km/u<br>
          Windstoten: {{ $weather['current']['gust_kph'] }}km/u<br>
          Windrichting: {{ $weather['current']['wind_dir'] }}<br>
        </p>
      </div>

      <div class="col d-flex justify-content-center ">
        <img src="{{ $weather['current']['condition']['icon'] }}" style="width: 90px; height: 90px">
      </div>
    </div>

    <div class="position-relative d-inline-block" style="height: 100px;">
      <img src="/app_media/field-top-full.png" class="img rounded" style="height: 100px;">

      <div class="position-absolute top-50 start-50 translate-middle">
        <x-heroicon-o-arrow-long-up
          id="wind-arrow"
          style="
            width: 50px;
            transform: rotate({{ $windDirectionDegrees[$weather['current']['wind_dir']] ?? 0 }}deg);
            color: white;
            "
        />
      </div>
    </div>
  </div>
</div>
