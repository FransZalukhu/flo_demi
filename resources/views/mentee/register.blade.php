<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Register Flodemi</title>
  <link rel="icon" type="image/png" href="{{ asset('images/f.png') }}">

  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <!-- FONT -->
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="{{asset('css/register.css') }}">
</head>

<body>

  <div class="container-fluid vh-100">
    <div class="row h-100">

      <!-- LEFT FIXED -->
      <div class="col-md-6 d-none d-md-flex bg-login left-fixed">
        <div class="left-content text-center">
          <h1 class="left-title">Selamat Datang</h1>
          <p class="left-subtitle">Silakan daftar akun Anda</p>
        </div>
      </div>

      <!-- RIGHT -->
      <div class="col-md-6 d-flex justify-content-center ms-md-auto">

        <div class="position-relative form-wrapper">

          <!-- LOGO -->
          <div class="logo-box">
            <a href="{{ route('home') }}">
              <img src="{{ asset('assets/logoo.png') }}" alt="Flodemi">
            </a>
          </div>

          <!-- CARD -->
          <div class="card login-card shadow-sm">
            <div class="card-body">

              <!-- FORM INNER -->
              <form class="form-inner" action="{{ route('register.post') }}" method="POST">

                @csrf

                <div class="mb-3">
                  <label class="form-label">Nama</label>
                  <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Masukkan nama" value="{{ old('username') }}" required>

                  @error('username')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email" value="{{ old('email') }}" required>

                  @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label class="form-label">Password</label>

                  <div class="password-wrapper">
                    <input type="password" name="password" id="registerPassword" class="form-control password-input @error('password') is-invalid @enderror" placeholder="Masukkan password" required>
                    <span class="password-icon" id="registerToggle" title="Show/Hide Password">
                      <i class="bi bi-eye"></i>
                    </span>
                  </div>

                  @error('password')
                  <div class="text-danger small mt-1">
                    {{ $message }}
                  </div>
                  @else
                  <small class="text-muted">Harus memiliki minimal 8 karakter</small>
                  @enderror
                </div>

                <div class="form-check mb-3">
                  <input class="form-check-input @error('agree') is-invalid @enderror" type="checkbox" id="agree" name="agree" required>
                  <label class="form-check-label" for="agree">
                    Saya setuju dengan
                    <a href="#" class="text-purple">Syarat</a> dan
                    <a href="#" class="text-purple">Ketentuan</a>
                  </label>
                </div>

                <button type="submit" class="btn btn-purple">Daftar</button>

                <p class="text-center mt-3 small">
                  Sudah punya akun? <a href="{{ route('login') }}" class="text-purple">Masuk</a>
                </p>

              </form>

            </div>
          </div>

          <p class="text-center small mt-3">
            Dengan daftar, Anda menyetujui
            <a href="#" class="text-purple">Syarat</a> dan
            <a href="#" class="text-purple">Kebijakan Privasi</a> kami
          </p>

        </div>
      </div>

    </div>
  </div>

  <script>
    // Password Toggle Functionality
    document.addEventListener('DOMContentLoaded', function() {
      const passwordInput = document.getElementById('registerPassword');
      const toggleIcon = document.getElementById('registerToggle');
      const icon = toggleIcon.querySelector('i');

      if (toggleIcon && passwordInput) {
        toggleIcon.addEventListener('click', function() {
          if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
            toggleIcon.title = 'Hide Password';
          } else {
            passwordInput.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
            toggleIcon.title = 'Show Password';
          }
        });
      }
    });
  </script>

</body>

</html>