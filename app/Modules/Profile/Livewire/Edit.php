<?php

namespace App\Modules\Profile\Livewire;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Edit extends Component
{
    protected string $view = 'modules.profile.edit';

    public string $name = '';

    public string $email = '';

    public string $current_password = '';

    public string $password = '';

    public string $password_confirmation = '';

    public function mount(): void
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
    }

    public function saveProfile(): void
    {
        $user = auth()->user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', "unique:users,email,{$user->id}"],
        ], [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'O e-mail já está em uso.',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $this->dispatch('notify', message: 'Perfil atualizado com sucesso.', type: 'success');
    }

    public function savePassword(): void
    {
        $this->validate([
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'current_password.required' => 'A senha atual é obrigatória.',
            'password.required' => 'A nova senha é obrigatória.',
            'password.min' => 'A nova senha deve ter pelo menos 8 caracteres.',
            'password.confirmed' => 'A confirmação de senha não confere.',
        ]);

        if (! Hash::check($this->current_password, auth()->user()->password)) {
            $this->addError('current_password', 'A senha atual está incorreta.');

            return;
        }

        auth()->user()->update(['password' => $this->password]);

        $this->current_password = '';
        $this->password = '';
        $this->password_confirmation = '';

        $this->dispatch('notify', message: 'Senha alterada com sucesso.', type: 'success');
    }

    public function render()
    {
        return view($this->view)
            ->layout('components.layouts.app');
    }
}
