<?php

namespace App\Http\Livewire\Backend\Marcadores;

use Livewire\Component;
use App\Models\backend\Marcador;
use Livewire\WithPagination;

class Marcadores extends Component
{
    use WithPagination;

    protected $pags = 5;
    protected $datas;

    public $orden = 'id';
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
    public $chkAll = false;
    public function render()
    {
        $this->datas = Marcador::where('id', '>=', 1)
            ->when($this->chkAll, function ($query) {
                return $query->where('activo', 1); //where('id', '>=', 1)
            })
            ->paginate($this->pags);
        // ->cursorPaginate($perPage = $this->pags, $columns = ['*'], $pageName = 'marcadores');
        return view('livewire.backend.marcadores.marcadores', ['datas' => $this->datas]);
    }

    public function save()
    {
        $this->validate();

        $user = Marcador::updateOrCreate([]);

        return back()->with('message', __('Mensaje'));
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

        // $this->updatedQuery();
    }
}
