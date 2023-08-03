<?php

namespace App\Livewire;

use Livewire\Component;

class GooglePlacesAutocomplete extends Component
{
    public $search = "";
    public $predictions = [];

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

    private function getPlace($placeId)
    {
        $apiKey = config('services.google_maps.api_key');
        // TODO: make service layer
        $url = "https://maps.googleapis.com/maps/api/place/details/json?place_id=" . urlencode($placeId) 
            . "&key=" . $apiKey
            . "&sesstiontoken=" . session()->getId()
            . "&fields=formatted_address,name,geometry,type,vicinity,address_components,adr_address";

        $response = file_get_contents($url);
        $response = json_decode($response, true);

        if($response['status'] != "OK"){
            ray($response);
        }
        return $response['result'];
    }

    public function selectPrediction($placeId)
    {
        $this->reset('search', 'predictions');
        $prediction = $this->getPlace($placeId);
        $this->dispatch('place-selected', selectedPrediction: $prediction);
    }

    public function render()
    {
        return view('livewire.google-places-autocomplete');
    }
}
