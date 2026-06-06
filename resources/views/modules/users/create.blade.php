<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Novo Usuário</h4>
    </div>

    <x-breadcrumbs :items="[
        ['label' => 'Início', 'route' => 'dashboard'],
        ['label' => 'Usuários', 'route' => 'users.index'],
        ['label' => 'Novo Usuário'],
    ]" />

    <div class="card">
        <div class="card-body">
            <form wire:submit="save">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome <span class="text-danger">*</span></label>
                            <input
                                id="name"
                                type="text"
                                wire:model="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Nome completo"
                            >
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail <span class="text-danger">*</span></label>
                            <input
                                id="email"
                                type="email"
                                wire:model="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="email@exemplo.com"
                            >
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="role" class="form-label">Papel <span class="text-danger">*</span></label>
                            <select id="role" wire:model="role" class="form-select @error('role') is-invalid @enderror">
                                @foreach($roles as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password" class="form-label">Senha <span class="text-danger">*</span></label>
                            <input
                                id="password"
                                type="password"
                                wire:model="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Mínimo 8 caracteres"
                            >
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Senha <span class="text-danger">*</span></label>
                            <input
                                id="password_confirmation"
                                type="password"
                                wire:model="password_confirmation"
                                class="form-control"
                                placeholder="Repita a senha"
                            >
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading wire:target="save" class="spinner-border spinner-border-sm me-1"></span>
                        Salvar
                    </button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
