<?php

namespace App\Http\Livewire\Backend\Colores;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
// use Illuminate\Support\Facades\DB;
use App\Models\backend\Color;

class ShowPosts extends Component
{
    // use Search;
    use WithPagination;
    private $tabla = 'colors';
    public $isActive = true;

    public $query = '';
    public $data = [];
    public $_id, $nombre, $slug, $hexa, $rgb;
    public $sort = 'id';
    public $direction = 'desc';
    // public $url; // atrapa valores pasados por la url
    // NO FUNCIONA
    // escucha eventos hijo para renderizar la informacion
    protected $listeners = ['renderParent' => 'render'];
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
        // $this->data = Color::all();
        $this->data = Color::orderBy($this->sort, $this->direction)->get();
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
        if (gettype($this->query) == 'array') {
            $search = '%' . implode($this->query) . '%';
        } else {
            $search = '%' . $this->query . '%';
        }
        $len = Str::length($search);
        if ($len > 4) {
            $this->data = Color::where('nombre', 'like', $search)
                ->orWhere('hexa', 'like', $search)
                ->orderBy($this->sort, $this->direction)
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
    public function order($sort)
    {
        // dump($sort);
        if ($this->sort == $sort) {
            $this->direction = $this->direction == 'desc' ? 'asc' : 'desc';
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }

        $this->updatedQuery();
    }

    public function CheckboxAll()
    {
        //
    }
    public function CheckboxSelected()
    {
        //
    }
}
