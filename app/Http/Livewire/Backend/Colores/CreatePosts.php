<?php

namespace App\Http\Livewire\Backend\Colores;

use Livewire\Component;

class CreatePosts extends Component
{
    // variables de la aplicacion
    public $open = false;
    public $nombre, $hexa, $rgb;
    public function render()
    {
        return view('livewire.backend.colores.create-posts');
    }

    public function fncOpen()
    {
        $this->open = !$this->open;
    }
}
