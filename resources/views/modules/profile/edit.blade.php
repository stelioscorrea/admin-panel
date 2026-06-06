<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Meu Perfil</h4>
    </div>

    <x-breadcrumbs :items="[
        ['label' => 'Início', 'route' => 'dashboard'],
        ['label' => 'Meu Perfil'],
    ]" />

    <div class="row">
        {{-- Dados Pessoais --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Dados Pessoais</h5>
                </div>
                <div class="card-body">
                    <form wire:submit="saveProfile">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome <span class="text-danger">*</span></label>
                            <input
                                id="name"
                                type="text"
                                wire:model="name"
                                class="form-control @error('name') is-invalid @enderror"
                            >
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail <span class="text-danger">*</span></label>
                            <input
                                id="email"
                                type="email"
                                wire:model="email"
                                class="form-control @error('email') is-invalid @enderror"
                            >
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            <span wire:loading wire:target="saveProfile" class="spinner-border spinner-border-sm me-1"></span>
                            Salvar Dados
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Alterar Senha --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Alterar Senha</h5>
                </div>
                <div class="card-body">
                    <form wire:submit="savePassword">
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Senha Atual <span class="text-danger">*</span></label>
                            <input
                                id="current_password"
                                type="password"
                                wire:model="current_password"
                                class="form-control @error('current_password') is-invalid @enderror"
                                placeholder="••••••••"
                            >
                            @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Nova Senha <span class="text-danger">*</span></label>
                            <input
                                id="new_password"
                                type="password"
                                wire:model="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Mínimo 8 caracteres"
                            >
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Nova Senha <span class="text-danger">*</span></label>
                            <input
                                id="password_confirmation"
                                type="password"
                                wire:model="password_confirmation"
                                class="form-control"
                                placeholder="Repita a nova senha"
                            >
                        </div>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            <span wire:loading wire:target="savePassword" class="spinner-border spinner-border-sm me-1"></span>
                            Alterar Senha
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
