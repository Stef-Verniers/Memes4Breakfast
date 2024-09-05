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

        @method('PATCH')
        @csrf
        
        <div id="{{ $user->avatar_id }}" type="hidden" class="currentAvatar"></div>

        {{-- Default avatars --}}
        <h3 class="text-left text-slate-600 text-md">{{ __('Default avatars')}}</h3>
        <x-input-label class="text-left text-slate-600 text-md">Default avatars anyone can use</x-input-label>
        <div class="grid grid-cols-3 justify-items-center gap-y-6" id="defaults">
            @foreach ($defaults as $avatar)
            <div id={{ $avatar->id }} class="p-2 avatar hover:shadow-xl hover:cursor-pointer">
                <img src="{{ asset($avatar->path) }}" class="w-24 lg:w-28" />
                <x-input-label class="text-center text-slate-500 mt-2 text-xs">{{ __($avatar->name) }}</x-input-label>
            </div>
            @endforeach
        </div>

        <h3 class="text-left text-slate-600 text-md">{{ __('Premium avatars')}}</h3>
        <x-input-label class="text-left text-slate-600 text-md">By creating memes, you achieve credit. Use that credit to unlock premium avatars</x-input-label>
        <div class="grid grid-cols-3 justify-items-center gap-y-6" id="premiums">
            {{-- Premium Avatars --}}
            @foreach ($premiums as $avatar)
            @if ($user->score < $avatar->price)
                <div id={{ $avatar->id }} class="p-2 avatar hover:shadow-xl hover:cursor-pointer disabled">
                    <img src="{{ asset($avatar->path) }}" class="w-24 lg:w-28" />
                    <x-input-label class="text-center text-slate-500 mt-2 text-xs">{{ __($avatar->name) }}</x-input-label>
                </div> 
            @else
            <div id={{ $avatar->id }} class="p-2 avatar hover:shadow-xl hover:cursor-pointer">
                <img src="{{ asset($avatar->path) }}" class="w-24 lg:w-28" />
                <x-input-label class="text-center text-slate-500 mt-2 text-xs">{{ __($avatar->name) }}</x-input-label>
            </div>
            @endif
            @endforeach
        </div>

        <input type="hidden" id="newAvatar" name="avatarId" value={{ $avatar->id }}>

        <div class="flex items-center gap-4">
            <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
