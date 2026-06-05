<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Usuários</h4>
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i>Novo Usuário
        </a>
    </div>

    <x-breadcrumbs :items="[
        ['label' => 'Início', 'route' => 'dashboard'],
        ['label' => 'Usuários'],
    ]" />

    <div class="card">
        <div class="card-header">
            <div class="col-md-4">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    class="form-control"
                    placeholder="Buscar por nome ou e-mail..."
                >
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th wire:click="sortBy('name')" style="cursor:pointer">
                                Nome
                                @if($sortBy === 'name')
                                    <i class="bi bi-chevron-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th wire:click="sortBy('email')" style="cursor:pointer">
                                E-mail
                                @if($sortBy === 'email')
                                    <i class="bi bi-chevron-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th>Papel</th>
                            <th>Status</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr wire:key="{{ $user->id }}">
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge text-bg-{{ $user->role->value === 'admin' ? 'danger' : 'secondary' }}">
                                        {{ $user->role->label() }}
                                    </span>
                                </td>
                                <td>
                                    @if($user->is_active)
                                        <span class="badge text-bg-success">Ativo</span>
                                    @else
                                        <span class="badge text-bg-secondary">Inativo</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button
                                        wire:click="requestToggleActive({{ $user->id }})"
                                        class="btn btn-sm {{ $user->is_active ? 'btn-outline-warning' : 'btn-outline-success' }}"
                                        title="{{ $user->is_active ? 'Inativar' : 'Ativar' }}"
                                    >
                                        <i class="bi bi-{{ $user->is_active ? 'pause-circle' : 'play-circle' }}"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    Nenhum usuário encontrado.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($users->hasPages())
            <div class="card-footer">
                {{ $users->links() }}
            </div>
        @endif
    </div>

    <livewire:components.confirm-modal />
</div>
