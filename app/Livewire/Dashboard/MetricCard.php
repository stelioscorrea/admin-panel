<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class MetricCard extends Component
{
    public string $title = '';

    public int|string $value = 0;

    public string $icon = 'bi-bar-chart';

    public string $color = 'primary';

    public function render()
    {
        return view('livewire.dashboard.metric-card');
    }
}
