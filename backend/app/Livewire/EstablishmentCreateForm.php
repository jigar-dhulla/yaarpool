<?php

namespace App\Livewire;

use App\Models\Establishment;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EstablishmentCreateForm extends Component
{
    public $userLocationLat = 17.00;
    public $userLocationLng = 81.031;
    public $name;
    public $type;

    protected $rules = [
        'name' => 'required',
        'type' => 'required',
    ];

    public function create()
    {
        /** @var User $user */
        $user = Auth::user();
        $this->validate();
        $establishment = Establishment::create([
            'name' => $this->name,
            'type' => $this->type,
        ]);
        $user->establishments()->attach($establishment, [
            'role_id' => Role::whereName(Role::ROLE_ADMIN)->first()->id
        ]);
        $this->reset();
    }

    public function destroy($id)
    {
        Establishment::destroy($id);
    }

    public function render()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('livewire.establishment-create-form', [
            'establishments' => $user->establishments,
            'apiKey' => config('services.google_maps.api_key'),
        ]);
    }
}
