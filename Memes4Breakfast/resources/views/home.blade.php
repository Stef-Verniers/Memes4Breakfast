@include('layouts.header')

{{-- <x-post caption="testing123" /> --}}
<main class="py-8 px-10 md:w-2/3 md:m-auto items-center justify-center">
    <div class="m-auto md:w-132 xl:w-148 flex inline justify-between items-center">
        <x-nav-link :href="route('upload')">
            <x-primary-button class="">Upload new meme</x-primary-button>
        </x-nav-link>
    </div>
    @foreach ($memes as $meme)
        <section class="shadow-xl border-b-2 m-auto mb-12 md:w-132 xl:w-148 p-6">
            <div class="mt-4 mb-8 flex inline justify-between items-center">
                <h1 class="font-bold text-lg md:text-2xl">{{ $meme->caption }}</h1>
                <p class="">{{ $meme->likes }}</p>
            </div>
            <div class="my-4 flex justify-center">
                <img class="md:max-w-md" src="{{ asset('uploads/'. $meme->meme) }}" />
            </div>
            <div class="mt-8">
                <h2 class="font-bold text-green-600">{{ $meme->user->name }}</h2>
            </div>
        </section>
    @endforeach
</main>