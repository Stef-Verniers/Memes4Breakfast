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