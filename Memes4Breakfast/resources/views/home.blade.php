@include('layouts.header')

{{-- <x-post caption="testing123" /> --}}
<main class="px-10 md:w-2/3 md:m-auto items-center justify-center">
    @foreach ($memes as $meme)
        <section class="shadow-xl border-b-2 m-auto mb-12 w-1/2 p-6">
            <div class="my-4 flex inline justify-between items-center">
                <h1 class="font-bold text-2xl">{{ $meme->caption }}</h1>
                <p class="">{{ $meme->likes }}</p>
            </div>
            <div>
                <img src={{ $meme->meme }}/>
            </div>
            <div>
                <h2>{{ $meme->user_id }}</h2>
            </div>
        </section>
    @endforeach
</main>