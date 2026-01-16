@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="welcome-card login-card">
                <!-- Logo dan Judul -->
                <div class="text-center mb-4">
                    <img src="logo/logo512.png" alt="Logo Inspektorat" width="75" class="rounded mb-3">
                    <h3 class="text-primary">Masuk ke Inspagenda</h3>
                    <p class="text-muted">Silakan masuk menggunakan akun Anda</p>
                </div>

                <!-- Form Login -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input id="email" type="email" 
                               class="form-control form-control-lg @error('email') is-invalid @enderror" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autocomplete="email" 
                               autofocus
                               placeholder="contoh@gmail.com">
                        
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <div class="position-relative">
                            <input id="password" 
                                   type="password" 
                                   class="form-control form-control-lg pe-5" 
                                   name="password" 
                                   required 
                                   placeholder="••••••••">
                            
                            <!-- Tombol Toggle Password -->
                            <button type="button" 
                                    class="btn btn-link text-secondary p-0"
                                    style="
                                        position: absolute;
                                        right: 12px;
                                        top: 50%;
                                        transform: translateY(-50%);
                                        z-index: 5;
                                        width: 24px;
                                        height: 24px;
                                    "
                                    onclick="togglePasswordVisibility()">
                                <i class="fas fa-eye" id="passwordToggleIcon" style="font-size: 1.2rem"></i>
                            </button>
                        </div>
                    </div>
                    

                    <!-- Remember Me & Lupa Password -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Ingat Saya
                            </label>
                        </div>
                        
                    </div>

                    <!-- Tombol Login -->
                    <button type="submit" class="btn btn-primary btn-option w-100 py-2">
                        <i class="fas fa-sign-in-alt me-2"></i> Masuk
                    </button>   
                </form>
            </div>
        </div>
    </div>
</div>

@endsection