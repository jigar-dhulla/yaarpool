<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class GoogleMap extends Component
{
    public $lat = 18.532;
    public $lng = 73.944;
    
    #[On('place-selected')] 
    public function changeMarker($selectedPrediction)
    {
        if(empty($selectedPrediction)){
            ray("Cannot update Map. Establishment not selected.");
        }
        
        $this->lat = $selectedPrediction['geometry']['location']['lat'];
        $this->lng = $selectedPrediction['geometry']['location']['lng'];
    }

    public function render()
    {
        return view('livewire.google-map', [
            'api_key' => config('services.google_maps.api_key'),
        ]);
    }
}
