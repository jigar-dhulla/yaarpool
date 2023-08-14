<?php

namespace App\Livewire;

use App\Models\Establishment;
use App\Models\Location;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class EstablishmentCreateForm extends Component
{
    public $name;
    public $type;
    public $selectedEstablishment;

    protected $rules = [
        'name' => 'required|max:255',
        'type' => 'required|max:255',
    ];
    
    #[On('place-selected')] 
    public function setSelectedEstablishment($selectedPrediction)
    {
        if(empty($selectedPrediction)){
            ray("Establishment not selected");
        }

        $this->selectedEstablishment    = $selectedPrediction;
        $this->name                     = $selectedPrediction['name'];
        $this->type                     = $selectedPrediction['types'][(count($selectedPrediction['types']) - 1)];
    }

    public function create()
    {
        /** @var User $user */
        $user = Auth::user();
        $this->validate();
        /** @var Establishment $establishment */
        $establishment = Establishment::create([
            'name' => $this->name,
            'type' => $this->type,
        ]);
        $user->establishments()->attach($establishment, [
            'role_id' => Role::whereName(Role::ROLE_ADMIN)->first()->id
        ]);
        $location = $this->selectedEstablishment['geometry']['location'] ?? null;
        /** @var Location $location */
        $location = $establishment->locations()->create([
            'coordinates' => DB::raw("POINT({$location['lat']}, {$location['lng']})"),
        ]);
        $location->addresses()->create([
            'name' => $this->selectedEstablishment['name'],
            'street' => $this->extractFromAddressComponents($this->selectedEstablishment['address_components'], "route"),
            'city' => $this->extractFromAddressComponents($this->selectedEstablishment['address_components'], "locality"),
            'state' => $this->extractFromAddressComponents($this->selectedEstablishment['address_components'], "administrative_area_level_1"),
            'postal_code' => $this->extractFromAddressComponents($this->selectedEstablishment['address_components'], "postal_code"),
            'country' => $this->extractFromAddressComponents($this->selectedEstablishment['address_components'], "country"),
        ]);
    }

    private function extractFromAddressComponents(array $addressComponents, string $type): string
    {
        $trimmedComponent = array_filter($addressComponents, function (array $component) use ($type) {
            return $component['types'][0] === $type;
        });
        return array_values($trimmedComponent)[0]['long_name'] ?? "<UNKNOWN>";
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
        ]);
    }
}
