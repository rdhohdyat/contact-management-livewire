<?php

namespace App\Livewire\Error;

use Livewire\Component;

class NotFound extends Component
{
    public function render()
    {
        return view('livewire.error.not-found')
            ->layout('components.layouts.blank');
    }
}
