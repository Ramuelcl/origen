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
    public $q; // muestra la consulta

    protected $datas;

    public $campo = 'id';
    public $direccion = 'desc';
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
            'name' => 'chechaUno',
            'input' => ['type' => 'checkbox', 'label' => '', 'display' => false, 'disabled' => true],
            'table' => ['titre' => '', 'display' => false, 'disabled' => true]
        ],
        //1
        ['name' => 'id', 'input' => ['type' => 'text', 'label' => '', 'display' => false, 'disabled' => true], 'table' => ['titre' => 'id', 'display' => true, 'disabled' => true]],
        //2
        [
            'name' => 'nombre',
            'input' => ['type' => 'text', 'label' => 'Nombre', 'display' => true, 'disabled' => false],
            'table' => ['titre' => 'Nombre', 'display' => true, 'disabled' => false]
        ],
        //3
        [
            'name' => 'hexa',
            'input' => ['type' => 'text', 'label' => 'Hexa', 'display' => true, 'disabled' => false],
            'table' => ['titre' => 'Hexa', 'display' => true, 'disabled' => false]
        ],
        //4
        [
            'name' => 'rgb',
            'input' => ['type' => 'text', 'label' => 'Rgb', 'display' => true, 'disabled' => true], 'table' => ['titre' => 'Rgb', 'display' => false, 'disabled' => true]
        ],
        //5
        [
            'name' => 'metadata',
            'input' => ['type' => 'json', 'label' => 'meta', 'display' => false, 'disabled' => true],
            'table' => ['titre' => 'meta', 'display' => false, 'disabled' => true]
        ],
        //6
        [
            'name' => 'activo',
            'input' => ['type' => 'boolean', 'label' => 'activo', 'display' => true, 'disabled' => false],
            'table' => ['titre' => 'Activo', 'display' => true, 'disabled' => false]
        ],
        //
    ];
    // variables publicas
    public $chkActivo = false;

    public function render()
    {
        $this->updatedQuery();
        // dd($this->datas);
        return view('livewire.backend.marcadores.marcadores', [
            'datas' => $this->datas,
        ]);
    }

    public function save()
    {
        $this->validate();

        $user = Marcador::updateOrCreate([]);

        return back()->with('message', __('Mensaje'));
    }
    public function fncOrden($campo)
    {
        dump($campo);
        if ($this->campo == $campo) {
            $this->direccion = $this->direccion == 'desc' ? 'asc' : 'desc';
        } else {
            $this->campo = $campo;
            $this->direccion = 'asc';
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
        $this->datas = Marcador::where('id', '>', 0)
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

            ->orderBy($this->campo, $this->direccion);

        // dump($this->datas);

        $this->datas = $this->datas->paginate($this->pags);
    }
}
