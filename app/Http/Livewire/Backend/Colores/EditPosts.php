<?php

namespace App\Http\Livewire\Backend\Colores;

use Livewire\Component;

use Livewire\WithFileUploads;
use Illuminate\Support\Str;

use App\Models\backend\Color;

class EditPosts extends Component
{
    public $color;

    public function mount(Color $color)
    {
        $this->color = $color;
        $this->idImagen = rand();
    }

    public function render()
    {
        return view('livewire.backend.colores.edit-posts');
    }

    use WithFileUploads;
    // variables de la aplicacion
    public $open = false;
    // variables de campo del formulario
    public $nombre, $babosa, $hexa, $rgb, $metadata, $imagen;

    // status: true=formulario crear; false=formulario editar
    public $status = null;

    public $idImagen;

    // validaciones
    protected $rules = [
        'nombre' => 'required|min:3|unique:colors,nombre,id',
        'hexa' => 'required|min:7|max:7|unique:colors,hexa,id',
        'rgb' => '',
        'imagen' => 'required|image|max:2048|mimes:jpeg,png,jpg,gif,svg',
    ];
    public function fncOpen()
    {
        $this->open = !$this->open;
    }

    public function fncSave()
    {
        $rgb = \fncHexa_Rgb($this->hexa);
        $metadata = json_encode([$this->nombre, $this->hexa, $rgb]);

        $this->validate();

        $imagen = $this->imagen->store('images/avatars/');

        Color::updateOrCreate([
            'nombre' => $this->nombre,
            'babosa' => Str::slug($this->nombre),
            'hexa' => $this->hexa,
            'rgb' => $rgb,
            'metadata' => $metadata,
            'imagen' => $imagen,
        ]);

        $this->emitTo('show-posts', 'render');
        // $this->emit('alert', 'Colores', "($this->nombre) Se ha creado con éxito ", 'success');
        $this->resetFilters();
        return back()->with('success', "($this->nombre) Se ha creado con éxito");
    }
    public function resetFilters()
    {
        // variables del programa
        $this->reset(['open']);
        $this->idImagen = rand();
        // variables de los datos
        $this->reset(['nombre', 'babosa', 'hexa', 'rgb', 'metadata', 'imagen']);
        // $this->reset('data');
        // Will only reset the data property.

        // $this->reset(['query', 'isActive']);
        // Will reset both the query AND the isActive property.
    }
}
