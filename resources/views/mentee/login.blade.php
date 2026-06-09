<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Login Flodemi</title>
  <link rel="icon" type="image/png" href="{{ asset('images/f.png') }}">
  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <!-- FONT -->
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>

  <div class="container-fluid vh-100">
    <div class="row h-100">

      <!-- LEFT FIXED -->
      <div class="col-md-6 d-none d-md-flex bg-login left-fixed">
        <div class="left-content text-center">
          <h1 class="left-title">Selamat Datang</h1>
          <p class="left-subtitle">Silakan masuk ke akun Anda</p>
        </div>
      </div>

      <!-- RIGHT -->
      <div class="col-md-6 d-flex justify-content-center ms-md-auto">

        <div class="position-relative form-wrapper">

          <!-- LOGO -->
          <div class="logo-box">
            <img src="{{ asset('assets/logoo.png') }}" alt="Flodemi">
          </div>

          <!-- CARD -->
          <div class="card login-card shadow-sm">
            <div class="card-body">

              <!-- FORM INNER -->
              <form class="form-inner" action="{{ route('login.post') }}" method="POST">

                @csrf

                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Masukkan email" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                  <label class="form-label">Password</label>

                  <div class="password-wrapper">
                    <input type="password" name="password" id="loginPassword" class="form-control password-input" placeholder="Masukkan password">
                    <span class="password-icon" id="loginToggle" title="Show/Hide Password">
                      <i class="bi bi-eye"></i>
                    </span>
                  </div>

                  <small class="text-muted">Harus memiliki minimal 8 karakter</small>
                </div>

                <!-- <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" id="agree">
                  <label class="form-check-label" for="agree">
                    Saya setuju dengan
                    <a href="#" class="text-purple">Syarat</a> dan
                    <a href="#" class="text-purple">Ketentuan</a>
                  </label>
                </div> -->

                @if($errors->any())
                <div class="alert alert-danger py-2 px-3 small mb-3 border-0" style="background-color: #f8d7da; color: #842029; border-radius: 8px;">
                  {{ $errors->first() }}
                </div>
                @endif

                <button type="submit" class="btn btn-purple">Masuk</button>

                <p class="text-center mt-3 small">
                  Belum punya akun? <a href="{{ route('register') }}" class="text-purple">Daftar</a>
                </p>

              </form>

            </div>
          </div>

          <p class="text-center small mt-3">
            Dengan masuk, Anda menyetujui
            <a href="#" class="text-purple">Syarat</a> dan
            <a href="#" class="text-purple">Kebijakan Privasi</a> kami
          </p>

        </div>
      </div>

    </div>
  </div>

  <script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.password-icon').forEach(function (toggle) {
      toggle.addEventListener('click', function () {
        const wrapper = this.closest('.password-wrapper');
        const input = wrapper.querySelector('.password-input');
        const icon = this.querySelector('i');

        if (input.type === 'password') {
          input.type = 'text';
          icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
          input.type = 'password';
          icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
      });
    });
  });
</script>

</body>

</html>