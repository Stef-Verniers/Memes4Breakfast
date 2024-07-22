@include('layouts.header')

<main class="py-10 px-10 md:w-132 md:m-auto md:p-0 md:mt-8 items-center justify-center">
    <x-nav-link :href="route('home')" class="mb-8">
        Go back
    </x-nav-link>

    <h1 class="text-4xl font-bold">Upload your meme</h1>
    <p class="mt-2 mb-16">
        You are freely to upload any meme you would like to share with us.
        Keep in mind that we don't tolerate reposts..
        <br>
        <br>
        Happy meming!
    </p>

    <form action="{{ route('create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <x-text-input name="caption" class="w-full outline-none focus:ring-0 focus:border-green-600">
            Give your meme a caption
        </x-text-input>
        <input 
          class="border-2 border-dotted p-8 mt-12 w-full"
          type="file"
          name="meme"
        >
        </input>
        <x-primary-button class="mt-8">
            Upload this meme
        </x-primary-button>
    </form>
</main>