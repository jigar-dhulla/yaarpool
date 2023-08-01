<?php

namespace App\Livewire;

use Livewire\Component;

class GooglePlacesAutocomplete extends Component
{
    public $search;
    public $predictions;

    public function mount()
    {
        $this->search = "";
        $this->predictions = [];
    }

    public function updatedSearch()
    {
        $this->predictions = $this->getAutocompletePredictions($this->search);
    }

    private function getAutocompletePredictions($search)
    {
        $apiKey = config('services.google_maps.api_key');
        // TODO: make service layer
        $url = "https://maps.googleapis.com/maps/api/place/autocomplete/json?input=" . urlencode($search) . "&key=" . $apiKey;

        $response = file_get_contents($url);
        $predictions = json_decode($response, true);
        
        return $predictions['predictions'] ?? [];
    }

    public function selectPrediction($placeId)
    {
        $predictions = collect($this->predictions)->keyBy('place_id');
        $this->search = $predictions[$placeId]["description"];
        $this->predictions = [];
        $this->dispatch('place-selected', selectedPrediction: $predictions[$placeId])
            ->to(EstablishmentCreateForm::class);
    }

    public function render()
    {
        return view('livewire.google-places-autocomplete');
    }
}
