<div>
  <!DOCTYPE html>
  <html lang="nl">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <!-- Page title -->
      <title>Inloggen</title>
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
      <!-- tab icon -->
      <link rel="icon" href="/media/images/TRMC_LOGO_PNG.ico" type="image/x-icon">
    </head>
    <body>
      <main>
        <div class="m-2">
          <div class="container mt-5 bg-dark bg-opacity-25 rounded shadow-lg p-2" style="max-width: 400px">
            <img src="/app_media/faticon.ico" class="rounded mx-auto d-block" alt="" style="width: 150px;">
            <h2 class="text-white text-center pt-3">Inloggen</h2>

            <form wire:submit.prevent="submit" class="col-auto pt-4 pb-4 mw-50">
              @error('credentials') <span class="text-danger">{{ $message }}</span> @enderror
              @csrf
              <label for="email" class="text-white"><strong>Email</strong></label>
              <input type="text" class="form-control mt-2" id="email" name="email" wire:model="email" aria-describedby="email" placeholder="">
              @error('email') <span class="text-danger">{{ $message }}</span> @enderror

              <label for="password" class="text-white"><strong>Wachtwoord</strong></label>
              <input type="password" class="form-control mb-2" id="password" name="password" wire:model="password" placeholder="">
              @error('password') <span class="text-danger">{{ $message }}</span> @enderror

              <button type="submit" class="btn text-white mt-2" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%)">Inloggen</button>
            </form>
          </div>
        </div>
      </main>

      <style>
        body, html {
          background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%);
          width: 100%;
          height: 100%;
          position: absolute;
        }

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
      </style>

      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
  </html>
</div>
