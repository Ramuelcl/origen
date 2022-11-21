<?php

namespace App\Http\Livewire\Backend\Colores;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
// use Illuminate\Support\Facades\DB;
use App\Models\backend\Marcador;

class ShowPosts extends Component
{
    // use Search;
    use WithPagination;
    private $tabla = 'marcadores';
    public $isActive = true;

    public $query = '';
    public $data = [];
    public $checaTodo = false,
        $checaUno = false,
        $_id = 0,
        $nombre,
        $babosa,
        $hexa,
        $rgb;
    public $orden = 'id';
    public $direccion = 'desc';
    // public $url; // atrapa valores pasados por la url
    // NO FUNCIONA

    // escucha eventos hijo para renderizar la informacion
    // protected $listeners = ['renderParent' => 'render'];
    // cuando es el mismo nombre se puede llamar así
    protected $listeners = ['render'];

    public $status = 'ingresar';

    public $display = [
        'created' => 'creado...',
        'edited' => 'editado...',
        'deleted' => 'borrado...',
        'new' => 'Crear',
        'save' => 'Guardar',
        'actions' => 'Acciones',
        'delete' => 'Eliminar',
        'edit' => 'Editar',
        'buscar' => 'Buscar...',
    ];
    public $fields = [
        //0
        ['name' => 'chechaUno', 'input' => ['type' => 'checkbox', 'label' => '', 'display' => false, 'disabled' => true], 'table' => ['titre' => '#', 'display' => true, 'disabled' => true]],
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

    public function mount($url = null)
    {
        // $this->url = $url;
        // $this->data = Marcador::all();
        $this->data = Marcador::orderBy($this->orden, $this->direccion)->get();
    }

    public function render()
    {
        $this->updatedQuery();
        return view('livewire.backend.colores.show-posts', ['data' => $this->data]);
        // para usar otra plantilla
        // ->layout('x-layouts.base');
    }
    public function updatedQuery()
    {
        // dd(gettype($this->query), $this->query);
        //     $this->query = implode($this->query);
        // }
        $largoMinimo = 4;
        if (gettype($this->query) == 'array') {
            $search = implode($this->query);
        } else {
            $search = $this->query;
        }
        $len = Str::length($search);
        $paso = intval($search);
        // print $paso;
        if ($paso > 0) {
            $largoMinimo = 2;
        }
        if ($len > $largoMinimo) {
            $search = '%' . $search . '%';
            $this->data = Marcador::where('id', 'like', $search)
                ->orWhere('nombre', 'like', $search)
                ->orWhere('hexa', 'like', $search)
                ->orderBy($this->orden, $this->direccion)
                ->get();
        } else {
            $this->mount();
        }
        // dump($this->data);
    }
    public function ActiveSearch()
    {
        $this->isActive = !$this->isActive;
    }
    public function resetFilters()
    {
        // $this->reset('data');
        // Will only reset the data property.

        $this->reset(['query', 'isActive']);
        // Will reset both the query AND the isActive property.
    }
    public function fncOrden($orden)
    {
        // dump($orden);
        if ($this->orden == $orden) {
            $this->direccion = $this->direccion == 'desc' ? 'asc' : 'desc';
        } else {
            $this->orden = $orden;
            $this->direccion = 'asc';
        }

        $this->updatedQuery();
    }

    public function fncChecaTodo()
    {
        $this->checa = $this->checaTodo;
        foreach ($this->data as $key => $value) {
            $this->data['checaUno'] = $this->checaTodo;
        }
    }
    public function fncChecaUno($id)
    {
        //
    }
}
