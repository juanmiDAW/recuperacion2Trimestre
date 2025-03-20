<?php

namespace App\Livewire;

use App\Models\Mueble;
use Livewire\Component;

class ListadoMuebles extends Component
{
    public function render()
    {
        return view('livewire.listado-muebles', ['muebles'=>Mueble::all()]);
    }
}
