<?php

namespace App\Http\Livewire\Backend\Marcadores;

use Livewire\Component;
use App\Models\backend\Marcador;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Marcadores extends Component
{
    use WithPagination;

    protected $pags = 7;

    // variables de base de datos
    // public $activo = '';
    public $query = ''; // usado en blade
    public $q = null; // muestra la consulta

    public $marcador = [];

    public $confirmMarcadorAdd;
    // caja de dialogo Ok, Cancel
    public $confirmMarcadorDelete = false;
    protected $queryString = [
        'chkActivo' => ['except' => false],
        'query' => ['except' => ''],
        'sortField' => ['except' => 'id'],
        'sortDir' => ['except' => true],
    ];
    protected $rules = [
        'marcador.nombre' => ['required|string|min:4'],
        'marcador.hexa' => ['required|string|min:7|max:7|unique:marcadores,id'],
        'marcador.activo' => ['boolean'],
    ];
    protected $datos;
    public $sortField = 'id';
    public $sortDir = 'desc';
    public $display = [
        'title' => 'Marcadores',
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
        [
            'name' => 'id',
            'input' => ['type' => 'text', 'label' => 'Id', 'display' => false, 'disabled' => true],
            'table' => ['titre' => 'id', 'display' => true, 'disabled' => true]
        ],
        //1
        [
            'name' => 'nombre',
            'input' => ['type' => 'text', 'label' => 'Nombre', 'display' => true, 'disabled' => false],
            'table' => ['titre' => 'Nombre', 'display' => true, 'disabled' => false]
        ],
        //2
        [
            'name' => 'hexa',
            'input' => ['type' => 'text', 'label' => 'Hexa', 'display' => true, 'disabled' => false],
            'table' => ['titre' => 'Hexa', 'display' => true, 'disabled' => false]
        ],
        //3
        [
            'name' => 'rgb',
            'input' => ['type' => 'text', 'label' => 'Rgb', 'display' => false, 'disabled' => true], 'table' => ['titre' => 'Rgb', 'display' => false, 'disabled' => true]
        ],
        //4
        [
            'name' => 'metadata',
            'input' => ['type' => 'json', 'label' => 'meta', 'display' => false, 'disabled' => true],
            'table' => ['titre' => 'meta', 'display' => false, 'disabled' => true]
        ],
        //5
        [
            'name' => 'activo',
            'input' => ['type' => 'checkbox', 'label' => 'activo', 'display' => true, 'disabled' => false],
            'table' => ['titre' => 'Activo', 'display' => true, 'disabled' => false]
        ],
        //
    ];
    // variables publicas
    public $chkActivo = false;

    public function render()
    {
        $this->updatedQuery();
        // dd($this->datos);
        return view('livewire.backend.marcadores.marcadores', [
            'datos' => $this->datos,
        ]);
    }

    public function save()
    {
        $this->validate($this->rules);
        // dd($this->marcador, $this->rules);

        // $reemplaza = Marcador::updateOrCreate([
        Marcador::Create([
            'nombre' => $this->marcador['nombre'],
            'hexa' => $this->marcador['hexa'],
            'activo' => $this->marcador['activo'] ?? 0,
        ]);

        return back()->with('message', __('Mensaje'));
    }

    public function delete(Marcador $marcador)
    {
        $marcador->delete();
        $this->confirmMarcadorDelete = false;
    }
    public function fncOrden($sortField)
    {
        // dd($sortField);
        if ($this->sortField == $sortField) {
            $this->sortDir = $this->sortDir == 'desc' ? 'asc' : 'desc';
        } else {
            $this->sortField = $sortField;
            $this->sortDir = 'asc';
        }

        $this->updatedQuery();
    }
    public function updatingchkActivo()
    {
        $this->resetPage();
    }
    public function updatedQuery()
    {
        // dd(gettype($this->query), $this->query);
        //     $this->query = implode($this->query);
        // }
        $this->datos = Marcador::where('id', '>', 0)
            ->when($this->query, function ($query) {
                return $query->where(function ($query) {
                    $search = '%' . $this->query . '%';
                    $query->where('id', 'like', $search)
                        ->orWhere('nombre', 'like', $search)
                        ->orWhere('hexa', 'like', $search);
                });
            })

            ->when($this->chkActivo, function ($query) {
                return $query->active();
            })

            ->orderBy($this->sortField, $this->sortDir);

        // guarda la consulta
        // if (DEBUG) {
        $this->q = $this->datos->toSql();
        // }
        // dump($this->datos);

        $this->datos = $this->datos->paginate($this->pags);
    }
    public function confirmMarcadorDelete($id)
    {
        $this->confirmMarcadorDelete = $id;
    }
    public function confirmMarcadorAdd()
    {
        $this->reset(['marcador']);
        $this->confirmMarcadorAdd = true;
    }
}
