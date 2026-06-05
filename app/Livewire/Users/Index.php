<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public string $sortBy = 'name';

    public string $sortDir = 'asc';

    public int $perPage = 15;

    protected $listeners = ['toggleActiveConfirmed'];

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $column): void
    {
        if ($this->sortBy === $column) {
            $this->sortDir = $this->sortDir === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDir = 'asc';
        }
    }

    public function requestToggleActive(int $userId): void
    {
        $user = User::findOrFail($userId);

        if ($user->id === auth()->id()) {
            $this->dispatch('notify', message: 'Você não pode desativar sua própria conta.', type: 'error');

            return;
        }

        $action = $user->is_active ? 'inativar' : 'ativar';
        $this->dispatch('openConfirmModal',
            title: 'Confirmar '.$action,
            message: "Tem certeza que deseja {$action} o usuário \"{$user->name}\"?",
            confirmEvent: 'toggleActiveConfirmed',
            confirmParams: [$userId],
        );
    }

    public function toggleActiveConfirmed(int $userId): void
    {
        $user = User::findOrFail($userId);

        if ($user->id === auth()->id()) {
            $this->dispatch('notify', message: 'Você não pode desativar sua própria conta.', type: 'error');

            return;
        }

        $user->update(['is_active' => ! $user->is_active]);

        $status = $user->is_active ? 'ativado' : 'inativado';
        $this->dispatch('notify', message: "Usuário {$status} com sucesso.", type: 'success');
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, fn ($q) => $q->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%");
            }))
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.users.index', ['users' => $users])
            ->layout('components.layouts.app');
    }
}
