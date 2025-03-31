<div class="mt-4">
  <div class="login-header">
    <div class="login-title fw-bold">
      Inloggen
    </div>
  </div>

  <form class="mt-4">
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label text-black">Email</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Email..." aria-describedby="">
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Wachtwoord</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Wachtwoord...">
    </div>

    <button type="submit" class="btn fw-bold" style="background-color: #d80414; color: white; width: 100px;">Log in</button>

  </form>

  <style>
    .login-header {
      padding: 10px;
      position: relative;
    }

    .login-title {
      background-color: #d80414;
      color: white;
      padding: 8px 30px;
      position: absolute;
      top: 0;
      left: 0;
      clip-path: polygon(0 0, 80% 0, 100% 100%, 0 100%); /** angle shape **/
    }
  </style>
</div>
