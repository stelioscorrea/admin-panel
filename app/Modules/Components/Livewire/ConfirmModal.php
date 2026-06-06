<?php

namespace App\Modules\Components\Livewire;

use Livewire\Component;

class ConfirmModal extends Component
{
    protected string $view = 'modules.components.confirm-modal';

    public bool $show = false;

    public string $title = 'Confirmar ação';

    public string $message = 'Tem certeza que deseja continuar?';

    public string $confirmEvent = '';

    public array $confirmParams = [];

    protected $listeners = ['openConfirmModal'];

    public function openConfirmModal(string $title, string $message, string $confirmEvent, array $confirmParams = []): void
    {
        $this->title = $title;
        $this->message = $message;
        $this->confirmEvent = $confirmEvent;
        $this->confirmParams = $confirmParams;
        $this->show = true;
    }

    public function confirm(): void
    {
        $this->dispatch($this->confirmEvent, ...$this->confirmParams);
        $this->close();
    }

    public function close(): void
    {
        $this->show = false;
        $this->title = 'Confirmar ação';
        $this->message = 'Tem certeza que deseja continuar?';
        $this->confirmEvent = '';
        $this->confirmParams = [];
    }

    public function render()
    {
        return view($this->view);
    }
}
