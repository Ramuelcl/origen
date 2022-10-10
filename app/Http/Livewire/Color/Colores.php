<?php

namespace App\Http\Livewire\Color;

use Livewire\Component;

class Colores extends Component
{
    public $titulo;

    public function mount()
    {
        //
    }

    public function index()
    {
        return view('livewire.color.muestra-colores');
    }

    public function render()
    {
        return view('livewire.color.muestra-colores');
    }
}
