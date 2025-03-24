<?php

namespace App\Livewire;

use Livewire\Component;

class CreateMuebles extends Component
{
    public $tipo = 'App\Models\Fabricado';

    public function render()
    {
        return view('livewire.create-muebles');
    }
}
