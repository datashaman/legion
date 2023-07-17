<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Avatar') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your avatar.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-2 gap-4">
            <div class="form-control">
                <x-input-label for="bio" :value="__('Bio')" />
                <x-text-input id="bio" name="bio" type="text" class="mt-1 block w-full" :value="old('bio', $user->bio)" required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('bio')" />
            </div>
            <div class="form-control">
                <x-input-label for="bio" :value="__('Bio')" />
                <x-text-input id="bio" name="bio" type="text" class="mt-1 block w-full" :value="old('bio', $user->bio)" required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('bio')" />
            </div>
        </div>
    </form>
</section>
