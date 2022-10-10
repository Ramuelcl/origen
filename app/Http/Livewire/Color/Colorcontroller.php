<?php

namespace App\Http\Livewire\Color;

use Livewire\Component;

class Colorcontroller extends Component
{
    public string $email = '';
    // public ?string $email = null; // Optional field

    protected $rules = [
        'email' => 'required|email',
    ];

    public function render()
    {
        return view('livewire.color.colorcontroller');
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        $user = User::updateOrCreate([
          'email' => $email
            ],
            [
                'phone' => $phone,
                'city'  => $city
            ]);

        return back()->with('message', __('Mensaje'));

    }
}
