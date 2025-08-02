<?php

namespace App\Livewire\Error;

use Livewire\Component;

class ServerError extends Component
{
    public function render()
    {
        return view('livewire.error.server-error')
            ->layout('components.layouts.blank');
    }
}
