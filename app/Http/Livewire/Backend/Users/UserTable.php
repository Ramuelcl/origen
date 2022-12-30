<?php

namespace App\Http\Livewire\Backend\Users;

use App\Models\User;
//
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
//
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserTable extends Component
{
    use
        WithPagination,
        WithFileUploads;

    public $strRegs = 5;
    public $Search;
    public $clear;
    public $onlyActive = false;
    public $mode = null;
    public $filePath = 'images/avatars';

    protected $users;
    public $sortField = 'id', $sortDir = 'Desc';
    protected $queryString = [
        'onlyActive' => ['except' => false],
        'Search' => ['except' => ''],
        'sortField' => ['except' => 'id'],
        'sortDir' => ['except' => 'Desc'],
    ];
    protected $rules = [
        'name' => ['required', 'string', 'min:4'],
        'profile_photo_path' => ['image', 'max:1024'],
    ];
    public $rules2;
    protected $rulesMsg =
    [
        'name.required' => 'Name is required',
        'name.min' => 'Name must have 4 chars',
        'name.string' => 'Name must have chars valids',
        'email.required' => 'eMail is required',
        'email.email' => 'format eMail is myname@resource.com',
        'email.min' => 'eMail must have 7 chars',
        'email.unique' => 'eMail is not unique, exist',
        'profile_photo_path.image' => 'the file must image',
        'profile_photo_path.max' => 'max image must have 1024',
        'password.required' => 'password is required',
        'password.regex' => 'password must contain at least one special character as "@$!%*#?&", one number, one lowercase, one uppercase.',
        'password_confirm.same' => 'password are not the same',
    ];

    // control de modales
    public $ModalAddEdit = false;
    public $ModalDelete = false;
    public $title;

    public $name;
    public $email;
    public $is_active;
    public $profile_photo_path;
    public $old_photo_path;
    public $password;
    public $password_confirm;

    public function render()
    {
        $this->updatedQuery();
        // dd($this->users);
        return view('livewire.backend.users.user-table', [
            'users' => $this->users,
        ]);
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:6',
            'email' => ['required', 'email', 'not_in:' . auth()->user()->email],
        ];
    }

    public function updatedQuery()
    {
        $this->users = User::where('id', '>', 0)
            ->when($this->Search, function ($query) {
                $srch = '%' . $this->Search . '%';
                return $query->where('id', 'like', $srch)
                    ->orWhere('name', 'like', $srch)
                    ->orWhere('email', 'like', $srch);
            })

            ->when($this->onlyActive, function ($query) {
                return $query->active($query);
            })

            ->orderBy($this->sortField, $this->sortDir);

        // guarda la consulta
        // if (DEBUG) {
        // $this->q = $this->users->toSql();
        // }
        // dd($this->users);

        $this->users = $this->users->paginate($this->strRegs);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function clear()
    {
        $this->resetPage();
        $this->reset(['strRegs', 'Search', 'onlyActive', 'sortField', 'sortDir', 'mode']);
    }


    public function fncOrden($sortField = 'id')
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

    public function fncAdd()
    {
        $this->mode = true; // crear registro

        $this->rules2 = [
            'email' => ['required', 'email', 'min:7', 'unique:users,email'],
            'password' => [
                'required', 'string', 'min:6',
                'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'
            ],
            'password_confirm' => ['required', 'same:password'],
        ];

        $this->resetErrorBag();
        $this->reset(['id', 'name', 'email', 'profile_photo_path', 'password', 'password_confirm']);
        $this->title = 'Add register';
        $this->is_active = true;
        $this->ModalAddEdit = true;
    }

    public function fncEdit($id = 0)
    {
        $this->mode = false; // editar registro
        $this->resetErrorBag();
        $this->title = 'Edit register';
        $this->user = User::find($id);
        $this->rules2 = [
            'email' => ['required', 'email', 'min:7', 'unique:users,email,' . $this->user->id],
        ];
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->old_photo_path = $this->profile_photo_path = $this->user->profile_photo_path;
        $this->password = '';
        $this->password_confirm = '';
        $this->is_active = $this->user->is_active;

        $this->ModalAddEdit = true;
    }
    // public function updated($propertyName): void
    // {
    //     $this->validateOnly($propertyName);
    // }

    public function fncDelete($id = 0)
    {
        $this->title = 'Delete register';

        $this->ModalDelete = $id;
    }

    public function fncDeleting()
    {
        if ($this->ModalDelete > 2) {
            $this->user = User::find($this->ModalDelete);
            Storage::delete($this->user->profile_photo_path);
            $this->user->delete();
        }
        $this->ModalDelete = false;
    }

    public function save()
    {

        $rules = array_merge($this->rules, $this->rules2);

        $validado = $this->validate($rules, $this->rulesMsg);

        // dd([$validado, $rules, $this]);
        $emailExiste = User::where('email', '=', $this->email)->first();
        if ($emailExiste && $this->user->id !== $emailExiste->id) { // crear
            dd($emailExiste);
        }
        //     User::Create(
        //         [
        //             'name' => $this->name,
        //             'email' => $this->email,
        //             'password' => Hash::make($this->password),
        //             'is_active'  => $this->is_active,
        //         ]
        //     );
        // } else { // editar
        //     $save = false;
        //     if ($this->user->name !== $this->name) {
        //         $this->user->name = $this->name;
        //         $save = true;
        //     }
        //     if ($this->user->is_active !== $this->is_active) {
        //         $this->user->is_active  = $this->is_active;
        //         $save = true;
        //     }
        //     if ($save)
        //         $this->user->save();
        // }
        $image = $this->profile_photo_path->Store($this->filePath);
        // dd($image);
        $user = User::updateOrCreate(
            [
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ],
            [
                'name' => $this->name,
                'is_active'  => $this->is_active,
                'profile_photo_path' => $image,
            ]
        );
        // dd($user);

        $this->ModalAddEdit = false;
        $this->mode = null; // crear/editar registro

        return back()->with('message', __('Mensaje'));
    }
}
