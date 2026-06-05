<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.dashboard.index', [
            'totalUsers' => User::count(),
            'activeUsers' => User::where('is_active', true)->count(),
            'adminUsers' => User::where('role', 'admin')->count(),
            'inactiveUsers' => User::where('is_active', false)->count(),
        ])->layout('components.layouts.app');
    }
}
