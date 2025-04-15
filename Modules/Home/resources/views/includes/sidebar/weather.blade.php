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
          echo 'fluff';
          return;
        }

        $weather = $response->json();
    @endphp
    <p>
      Locatie: {{ $weather['location']['name'] }}<br>
      Temperatuur: {{ $weather['current']['temp_c'] }}C<br>
      Wind: {{ $weather['current']['wind_kph'] }}km/u<br>
      Windstoten: {{ $weather['current']['gust_kph'] }}km/u<br>
      Windrichting: {{ $weather['current']['wind_dir'] }}<br>
      Laatste update: {{ \Carbon\Carbon::parse($weather['current']['last_updated'])->format('d-m-Y H:m:s') }}
    </p>
    <img src="https:{{ $weather['current']['condition']['icon'] }}">
    <p></p>
  </div>
</div>
