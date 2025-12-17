<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-8 col-lg-6">

            <div class="card shadow border-0">
                <div class="card-body p-4">

                    {{-- Logo --}}
                    <div class="text-center mb-4">
                        <img src="https://laravel.com/img/logomark.min.svg" width="70" alt="Laravel">
                        <h4 class="mt-3 fw-bold text-danger">Register</h4>
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

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control"
                                       value="{{ old('name') }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                       value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation"
                                       class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Daftar Sebagai</label>
                            <select name="role" id="role" class="form-select" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="merchant" {{ old('role')=='merchant' ? 'selected' : '' }}>
                                    Merchant
                                </option>
                                <option value="customer" {{ old('role')=='customer' ? 'selected' : '' }}>
                                    Customer
                                </option>
                            </select>
                        </div>

                        {{-- Merchant Only --}}
                        <div class="mb-3" id="companyField" style="display:none;">
                            <label class="form-label">Nama Perusahaan</label>
                            <input type="text" name="company_name" class="form-control"
                                   value="{{ old('company_name') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="address" class="form-control" rows="2" required>{{ old('address') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Kontak</label>
                            <input type="text" name="contact" class="form-control"
                                   value="{{ old('contact') }}" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-danger">
                                Register
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <span class="text-muted">Sudah punya akun?</span>
                        <a href="{{ route('login') }}" class="text-danger fw-semibold text-decoration-none">
                            Login
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    const roleSelect = document.getElementById('role');
    const companyField = document.getElementById('companyField');

    function toggleCompanyField() {
        if (roleSelect.value === 'merchant') {
            companyField.style.display = 'block';
        } else {
            companyField.style.display = 'none';
        }
    }

    toggleCompanyField();
    roleSelect.addEventListener('change', toggleCompanyField);
</script>

</body>
</html>
