<div>
    <div class="mt-8">
        <label class="block mb-2 text-xl">Search Establishment </label>
        <input type="text" wire:model.live.debounce.500ms="search" placeholder="Enter location..." rows="3" cols="20" class="w-full rounded">
    </div>

    @if (count($predictions) > 0)
        <ul class="list-group">
            @foreach ($predictions as $prediction)
                <li wire:click="selectPrediction('{{ $prediction['place_id'] }}')" class="list-group-item list-group-item-action">
                    {{ $prediction['description'] }}
                </li>
            @endforeach
        </ul>
    @endif
</div>
