<?php

namespace App\Http\Livewire\Color;

use Livewire\Component;

class MuestraColores extends Component
{
    public $titulo;

    public function mount()
    {
        //
    }

    public function render()
    {
        return view('livewire.color.muestra-colores');
    }
}
