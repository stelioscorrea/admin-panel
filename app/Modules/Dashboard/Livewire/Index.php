<?php

namespace App\Modules\Dashboard\Livewire;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    protected string $view = 'modules.dashboard.index';

    public function render()
    {
        return view($this->view, [
            'totalUsers' => User::count(),
            'activeUsers' => User::where('is_active', true)->count(),
            'adminUsers' => User::where('role', 'admin')->count(),
            'inactiveUsers' => User::where('is_active', false)->count(),
        ])->layout('components.layouts.app');
    }
}
