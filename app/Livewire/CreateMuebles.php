<?php

namespace App\Livewire;

use Livewire\Component;

class CreateMuebles extends Component
{
    public $tipo;

    public function render()
    {
        $this->tipo = 'App\Models\Fabricado';
        return view('livewire.create-muebles');
    }
}
