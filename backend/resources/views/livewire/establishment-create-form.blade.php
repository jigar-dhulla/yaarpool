
<div>
    <div class="container mx-auto">
        <form method="POST" wire:submit="create">
            @csrf
            <div>
                <livewire:google-map />
            </div>
            <div>
                <livewire:google-places-autocomplete />
                @if(isset($name)) Selected Establishment: {{ $name }} @endif
            </div>
            {{-- <div class="mt-8">
                <label class="block mb-2 text-xl">Type </label>
                <input wire:model.lazy="type" rows="3" cols="20" class="w-full rounded" />
                @error('type')
                <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div> --}}
            <button type="submit" class="px-4 py-2 mt-4 text-white bg-blue-600 rounded">
                Submit
            </button>
        </form>
    </div>
    <div class="flex flex-col mt-8">
        <div class="py-2">
            <div
                class="min-w-full border-b border-gray-200 shadow">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-gray-500 border-b border-gray-200 bg-gray-50">
                                Id
                            </th>
                            <th class="px-6 py-3 text-left text-gray-500 border-b border-gray-200 bg-gray-50">
                                Title
                            </th>
                            <th class="px-6 py-3 text-left text-gray-500 border-b border-gray-200 bg-gray-50">
                                Type
                            </th>
                            <th class="px-6 py-3 text-left text-gray-500 border-b border-gray-200 bg-gray-50">
                                Delete
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white">
                        @foreach($establishments as $establishment)
                        <tr>
                            <td class="px-6 py-4 border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm text-gray-900">
                                            {{ $establishment->id }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 border-b border-gray-200">
                                <div class="text-sm text-gray-900">
                                    {{ $establishment->name }}
                                </div>
                            </td>

                            <td class="px-6 py-4 border-b border-gray-200">
                                <div class="text-sm text-gray-900">
                                    {{ $establishment->type }}
                                </div>
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-500 border-b border-gray-200">
                                <button wire:click="destroy({{ $establishment->id }})"
                                    class="px-4 py-2 text-white bg-red-600">
                                    Delete
                                </button>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>