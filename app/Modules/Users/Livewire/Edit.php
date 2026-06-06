<?php

namespace App\Modules\Users\Livewire;

use App\Enums\UserRole;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    protected string $view = 'modules.users.edit';

    public User $user;

    public string $name = '';

    public string $email = '';

    public string $role = 'user';

    public string $password = '';

    public string $password_confirmation = '';

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role->value;
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', "unique:users,email,{$this->user->id}"],
            'role' => ['required', 'in:admin,user'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }

    protected function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'O e-mail já está em uso.',
            'role.required' => 'O papel é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'password.confirmed' => 'A confirmação de senha não confere.',
        ];
    }

    public function save(): void
    {
        $validated = $this->validate();

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => UserRole::from($validated['role']),
        ];

        if (! empty($validated['password'])) {
            $data['password'] = $validated['password'];
        }

        $this->user->update($data);

        session()->flash('success', 'Usuário atualizado com sucesso.');
        $this->redirect(route('users.index'), navigate: true);
    }

    public function render()
    {
        return view($this->view, [
            'roles' => collect(UserRole::cases())->mapWithKeys(fn ($r) => [$r->value => $r->label()]),
        ])->layout('components.layouts.app');
    }
}
