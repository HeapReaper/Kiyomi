@extends('panel::layouts.master')

@section('title', 'Tests')

@section('content')
  <div class="container">

    <div class="mt-2 mb-2 bg-dark bg-opacity-25 m-3 p-3 rounded">
      <h3 class="text-white">Email</h3>
      <form action="/test-email" method="POST">
        @csrf
        <div class="mb-3">
          <label for="email_test" class="form-label text-white">
            Verstuur een test email naar jezelf
          </label>
          <div class="input-group">
            <input type="email" class="form-control" name="email_test" id="email_test" aria-describedby="email_test" placeholder="Verstuur een test email">
            <button type="submit" class="btn text-white" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%)">Test</button>
          </div>
        </div>

        <hr>

        <p class="text-white">Huidige ENV instellingen voor e-mail:</p>
        <ul class="text-white">
          <li><strong>MAIL_MAILER:</strong> {{ env('MAIL_MAILER', 'niet ingesteld') }}</li>
          <li><strong>MAIL_HOST:</strong> {{ env('MAIL_HOST', 'niet ingesteld') }}</li>
          <li><strong>MAIL_PORT:</strong> {{ env('MAIL_PORT', 'niet ingesteld') }}</li>
          <li><strong>MAIL_USERNAME:</strong> {{ env('MAIL_USERNAME', 'niet ingesteld') }}</li>
          <li><strong>MAIL_FROM_ADDRESS:</strong> {{ env('MAIL_FROM_ADDRESS', 'niet ingesteld') }}</li>
        </ul>
      </form>
    </div>

    <div class="mt-2 mb-2 bg-dark bg-opacity-25 m-3 p-3 rounded">
      <h3 class="text-white">Email</h3>
      <form action="/test-email" method="POST">
        @csrf
        <div class="mb-3">
          <label for="email_test" class="form-label text-white">
            Verstuur een test email naar jezelf
          </label>
          <div class="input-group">
            <input type="email" class="form-control" name="email_test" id="email_test" aria-describedby="email_test" placeholder="Verstuur een test email">
            <button type="submit" class="btn text-white" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%)">Test</button>
          </div>
        </div>

        <hr>

        <p class="text-white">Huidige ENV instellingen voor e-mail:</p>
        <ul class="text-white">
          <li><strong>MAIL_MAILER:</strong> {{ env('MAIL_MAILER', 'niet ingesteld') }}</li>
          <li><strong>MAIL_HOST:</strong> {{ env('MAIL_HOST', 'niet ingesteld') }}</li>
          <li><strong>MAIL_PORT:</strong> {{ env('MAIL_PORT', 'niet ingesteld') }}</li>
          <li><strong>MAIL_USERNAME:</strong> {{ env('MAIL_USERNAME', 'niet ingesteld') }}</li>
          <li><strong>MAIL_FROM_ADDRESS:</strong> {{ env('MAIL_FROM_ADDRESS', 'niet ingesteld') }}</li>
        </ul>
      </form>
    </div>    
  </div>
@endsection