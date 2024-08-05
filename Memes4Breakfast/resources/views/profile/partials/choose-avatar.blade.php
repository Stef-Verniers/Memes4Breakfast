<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Choose your avatar') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("You can choose one of the default avatars or you can purchase premium avatars with experience points. The 5 most experienced users obtain exclusive avatars which can't be bought or sold.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.choose') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-3 justify-items-center gap-y-6">
            {{-- TODO: SEPERATE AVATARS --}}
            @foreach ($avatars as $avatar)
            <div>
                <img src="{{ asset($avatar->path) }}" class="w-24 lg:w-28" />
                <x-input-label class="text-center text-slate-500 mt-2 text-xs">{{ __($avatar->name) }}</x-input-label>
            </div>
            @endforeach
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
