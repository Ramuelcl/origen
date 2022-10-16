<?php

namespace App\Http\Livewire\Backend\Colores;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

use App\Models\Backend\Color;

class ShowPosts extends Component
{
    use WithPagination;
    public $status = 'ingresar';

    public $display = [
        'created' => 'usuario creado...',
        'edited' => 'usuario editado...',
        'deleted' => 'usuario borrado...',
        'new' => 'Crear',
        'save' => 'Guardar',
        'actions' => 'Acciones',
        'delete' => 'Eliminar',
        'edit' => 'Editar',
    ];
    public $fields = [
        //0
        ['name' => 'id', 'input' => ['type' => 'text', 'label' => '', 'display' => false, 'disabled' => true], 'table' => ['titre' => '#', 'display' => true, 'disabled' => true]],
        //1
        ['name' => 'nombre', 'input' => ['type' => 'text', 'label' => 'Nombre', 'display' => true, 'disabled' => false], 'table' => ['titre' => 'Nombre', 'display' => true, 'disabled' => false]],
        //2
        ['name' => 'hexa', 'input' => ['type' => 'text', 'label' => 'Hexa', 'display' => true, 'disabled' => false], 'table' => ['titre' => 'Hexa', 'display' => true, 'disabled' => false]],
        //3
        ['name' => 'rgb', 'input' => ['type' => 'text', 'label' => 'Rgb', 'display' => true, 'disabled' => true], 'table' => ['titre' => 'Rgb', 'display' => false, 'disabled' => true]],
        //4
        ['name' => 'metadata', 'input' => ['type' => 'json', 'label' => 'meta', 'display' => false, 'disabled' => true], 'table' => ['titre' => 'meta', 'display' => false, 'disabled' => true]],
        //
    ];

    public string $email = '';
    // public ?string $email = null; // Optional field
    public $datos = [];
    private $tabla = 'colors';
    public $esActivo = true;

    public $orden = 'id';
    public $direccion = 'desc';

    public $query = '';

    protected $rules = [
        'email' => 'required|email',
    ];

    public function mount($email = '')
    {
        $this->datos = Color::orderBy($this->orden, $this->direccion)->get();
    }

    public function render()
    {
        $this->updatedQuery();

        // $this->datos = Color::all();
        $this->datos = Color::where('nombre', 'like', '%' . $this->search . '%')->get();
        return view('livewire.backend.colores.show-posts', ['datos' => $this->datos]); //->layout('layouts.dashboard')
    }
    public function updatedQuery()
    {
        // dd(gettype($this->query), $this->query);
        //     $this->query = implode($this->query);
        // }
        if (gettype($this->query) == 'array') {
            $search = '%' . implode($this->query) . '%';
        } else {
            $search = '%' . $this->query . '%';
        }
        $len = Str::length($search);
        if ($len > 4) {
            $this->datos = Color::where('nombre', 'like', $search)
                ->orWhere('hexa', 'like', $search)
                ->orderBy($this->orden, $this->direccion)
                ->get();
        } else {
            $this->mount();
        }
        // dump($this->datos);
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        $user = User::updateOrCreate(
            [
                'email' => $email,
            ],
            [
                'phone' => $phone,
                'city' => $city,
            ],
        );

        return back()->with('message', __('Mensaje'));
    }
}
