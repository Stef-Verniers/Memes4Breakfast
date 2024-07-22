@include('layouts.header')

<main class="py-8 px-10 md:w-md md:m-auto items-center justify-center">
    <!-- Show upload button -->
    <div class="m-auto md:w-132 flex inline justify-between items-center">
        <x-nav-link :href="route('upload')" class="hover:border-green-600 text-lg border-2 border-slate-200 pt-2 pb-2 mb-6 w-full flex justify-center items-center">
            Upload your new meme
        </x-nav-link>
    </div>

    <!-- FILTER COMING SOON -->

    <!-- Show our memes -->
    @foreach ($memes as $meme)
        <section class="shadow-xl border-b-2 m-auto mb-12 md:w-132 xl:w-148 p-6">
            <div class="mt-4 mb-8 flex inline justify-between items-center">
                <h1 class="font-bold text-lg md:text-2xl">{{ $meme->caption }}</h1>
                <!-- CLICKABLE LIKE COUNTER -->
                <p class="">{{ $meme->likes }}</p>
            </div>
            <div class="my-4 flex justify-center">
                <img class="md:max-w-md" src="{{ asset('uploads/'. $meme->meme) }}" />
            </div>
            <div class="mt-8">
                <h2 class="font-bold text-green-600">{{ $meme->user->name }}</h2>
            </div>
            <!-- COMMENT SECTION COMING SOON -->
        </section>
    @endforeach
</main>