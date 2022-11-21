<?php

namespace App\Http\Livewire\Backend\Colores;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

use App\Models\Backend\Marcador;

class CreatePosts extends Component
{
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
        // 'email' => 'sometimes|required|email',//the email field will only be validated if it is present in the $data array.

        // use Illuminate\Support\Facades\Validator;
        // use Illuminate\Validation\Rules\File;

        // Validator::validate($input, [
        //     'attachment' => [
        //         'required',
        //         File::types(['mp3', 'wav'])
        //             ->min(1024)
        //             ->max(12 * 1024),
        //     ],
        // ]);

        // use Illuminate\Support\Facades\Validator;
        // use Illuminate\Validation\Rules\File;

        // Validator::validate($input, [
        //     'photo' => [
        //         'required',
        //         File::image()
        //             ->min(1024)
        //             ->max(12 * 1024)
        //             ->dimensions(Rule::dimensions()->maxWidth(1000)->maxHeight(500)),
        //     ],
        // ]);
    ];
    // función para validar cada vez que se tipea algo en un campo de
    // entrada, trabaja directamente con $rules. En el campo no debe tener
    // la opcion wire:model.(defer)
    // public function updated($propertyName)
    // {
    //     $this->validatedOnly($propertyName);
    // }

    public function mount()
    {
        $this->idImagen = rand();
    }
    public function render()
    {
        return view('livewire.backend.colores.create-posts');
    }

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

        Marcador::updateOrCreate([
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
