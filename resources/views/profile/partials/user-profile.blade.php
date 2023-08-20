<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.information.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="bio" :value="__('Bio')" />
            <x-text-input id="bio" name="bio" type="text" class="mt-1 block w-full" :value="old('bio', $user->profile?->bio)" required autofocus autocomplete="bio" />
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <div>
            <x-input-label for="occupation" :value="__('Occupation')" />
            <x-text-input id="occupation" name="occupation" type="text" class="mt-1 block w-full" :value="old('occupation', $user->profile?->occupation)" required autofocus autocomplete="occupation" />
            <x-input-error class="mt-2" :messages="$errors->get('occupation')" />
        </div>

        <div>
            <x-input-label for="start_time" :value="__('Start Time')" />
            <x-text-input id="start_time" name="start_time" type="time" class="mt-1 block w-full" required autofocus autocomplete="start_time"
                :value="old('start_time', substr($user->profile?->start_time, 0, 5))"
            />
            <x-input-error class="mt-2" :messages="$errors->get('start_time')" />
        </div>

        <div>
            <x-input-label for="end_time" :value="__('End Time')" />
            <x-text-input id="end_time" name="end_time" type="time" class="mt-1 block w-full" required autofocus autocomplete="end_time" 
                :value="old('end_time', substr($user->profile?->end_time, 0, 5))" 
            />
            <x-input-error class="mt-2" :messages="$errors->get('end_time')" />
        </div>

        <div>
            <x-input-label for="has_vehicle" :value="__('Has Vehicle')" />
            <x-text-input id="has_vehicle" name="has_vehicle" type="checkbox" class="mt-1 block" :checked="old('has_vehicle', $user->profile?->has_vehicle)" autofocus autocomplete="has_vehicle" />
            <x-input-error class="mt-2" :messages="$errors->get('has_vehicle')" />
        </div>

        <div>
            <x-input-label for="four_wheeler" :value="__('Is vehicle four wheeler?')" />
            <x-text-input id="four_wheeler" name="four_wheeler" type="checkbox" class="mt-1 block" :checked="old('four_wheeler', $user->profile?->four_wheeler)" autofocus autocomplete="four_wheeler" />
            <x-input-error class="mt-2" :messages="$errors->get('four_wheeler')" />
        </div>

        <div>
            <x-input-label for="twitter_url" :value="__('Twitter URL')" />
            <x-text-input id="twitter_url" name="twitter_url" type="text" class="mt-1 block w-full" :value="old('twitter_url', $user->profile?->twitter_url)" autofocus autocomplete="twitter_url" />
            <x-input-error class="mt-2" :messages="$errors->get('twitter_url')" />
        </div>

        <div>
            <x-input-label for="linkedin_url" :value="__('LinkedIn URL')" />
            <x-text-input id="linkedin_url" name="linkedin_url" type="text" class="mt-1 block w-full" :value="old('linkedin_url', $user->profile?->linkedin_url)" autofocus autocomplete="linkedin_url" />
            <x-input-error class="mt-2" :messages="$errors->get('linkedin_url')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-information-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
