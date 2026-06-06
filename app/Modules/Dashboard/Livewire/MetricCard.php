<?php

namespace App\Modules\Dashboard\Livewire;

use Livewire\Component;

class MetricCard extends Component
{
    protected string $view = 'modules.dashboard.metric-card';

    public string $title = '';

    public int|string $value = 0;

    public string $icon = 'bi-bar-chart';

    public string $color = 'primary';

    public function render()
    {
        return view($this->view);
    }
}
