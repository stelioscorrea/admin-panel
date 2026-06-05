<x-layouts.auth>
    <div class="card">
        <div class="card-body login-card-body">
            <div class="text-center mb-4">
                <h1 class="h4 fw-bold">{{ config('app.name', 'Admin Panel') }}</h1>
                <p class="text-muted">Faça login para continuar</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="seu@email.com"
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="••••••••"
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input
                            id="remember"
                            type="checkbox"
                            name="remember"
                            class="form-check-input"
                            {{ old('remember') ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="remember">Lembrar de mim</label>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        Entrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.auth>
