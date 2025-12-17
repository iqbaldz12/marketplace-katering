<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg border-0" style="width: 420px;">
            <div class="card-body p-4">

                {{-- Logo Laravel --}}
                <div class="text-center mb-4">
                    <img src="https://laravel.com/img/logomark.min.svg" alt="Laravel" width="70">
                    <h4 class="mt-3 fw-bold text-danger">Login</h4>
                </div>

                {{-- Error --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Success --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan email"
                            value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password"
                            required>
                    </div>

                    <button type="submit" class="btn btn-danger w-100">
                        Login
                    </button>
                </form>
                <div class="text-center">
                    <span class="text-muted">Belum punya akun?</span>
                    <a href="{{ route('register') }}" class="fw-semibold text-decoration-none text-danger">
                        Daftar sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
