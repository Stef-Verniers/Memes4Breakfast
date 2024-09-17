@include('layouts.header')

<main class="py-8 px-10 md:w-md md:m-auto items-center justify-center">
    <!-- Show upload button -->
    <div class="m-auto md:w-132 flex inline justify-between items-center">
        <x-nav-link :href="route('upload')" class="hover:border-green-600 text-lg border-2 border-slate-200 pt-2 pb-2 mb-6 w-full flex justify-center items-center">
            Upload your new meme
        </x-nav-link>
    </div>

    <!-- FILTER COMING SOON -->

    <!-- Show message if there are no memes at all -->
    @if ($memes->count() == 0)
        <section class="m-auto mb-12 md:w-132 xl:w-148 p-6 text-center">
            <h1 class="mt-24 font-bold text-lg md:text-2xl">There are no memes to show...</h1>
            <p class="mt-4 color-slate-200 text-sm">Come back later or be the first to upload one</p>
        </section>
    @endif

    <!-- Show our memes -->
    @foreach ($memes as $meme)
        <section class="shadow-xl border-b-2 m-auto mb-12 md:w-124 xl:w-148">
            <div class="flex flex-col">
                <div class="flex inline items-center bg-gray-100 p-2">
                    {{-- <img src="{{ asset('/' . Auth::user()->avatar->path) }}"  class="w-8 rounded-full mr-2" /> --}}
                    <h2 class="font-bold text-green-600">{{ $meme->user->username }}</h2>
                </div>
                <h1 class="font-bold text-lg md:text-3xl my-4 ml-4">{{ $meme->caption }}</h1>
            </div>
            <div class="w-128 flex justify-center">
                <img class="md:max-w-full w-full" src="{{ asset('uploads/'. $meme->meme) }}" />
            </div>
            <!-- CLICKABLE LIKE COUNTER -->
            <div class="flex inline ml-4 like-path liked">
                <svg version="1.1" id="Laag_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    viewBox="0 0 65.6 59.9" style="enable-background:new 0 0 65.6 59.9;" xml:space="preserve">
                    <style type="text/css">
                        .st0{fill:#FFFFFF;}
                        .st1{fill:#1D1D1B;}
                    </style>
                    <g>
                        <path class="st0" d="M32.8,58.9c-0.5,0-1-0.3-1.6-0.8C20.4,48.8,9.4,38.5,3,24.9C0.6,19.6,0.3,14.2,2.4,9.8c1.8-4,5.4-6.9,10.1-8.2
                            c0.9-0.2,1.8-0.4,2.5-0.5c0.3,0,0.5-0.1,0.7-0.1c5.3,0.2,9.5,2.1,12.7,6c0.3,0.4,0.6,0.8,1,1.3c1.1,1.5,2,2.8,3.5,2.8
                            c1.3,0,2.1-1.2,3.1-2.5c0.3-0.4,0.7-0.9,1-1.3c3.7-4.2,8-6.4,12.4-6.4c2.7,0,5.5,0.8,8.1,2.5c7,4.4,9.1,12.3,5.4,20.6
                            c-6.1,13.9-17,24.1-28.5,34.1C33.8,58.7,33.3,58.9,32.8,58.9z"/>
                        <path class="st1" d="M49.3,2L49.3,2c2.5,0,5.1,0.8,7.5,2.3c6.5,4.1,8.5,11.5,5,19.3c-6,13.7-16.8,23.8-28.2,33.8
                            c-0.2,0.2-0.6,0.4-0.8,0.4c-0.2,0-0.6-0.2-1-0.5C21.2,48.1,10.3,37.9,3.9,24.5c-2.4-5-2.6-10.1-0.7-14.2C5,6.5,8.4,3.8,12.8,2.6
                            c0.8-0.2,1.7-0.4,2.4-0.5c0.2,0,0.4-0.1,0.6-0.1c5.1,0.2,8.8,2,11.8,5.7c0.3,0.4,0.6,0.8,0.9,1.2c1.2,1.6,2.3,3.3,4.3,3.3l0.1,0
                            l0,0c1.7,0,2.7-1.4,3.9-2.9c0.3-0.4,0.7-0.9,1-1.2C41.2,4.1,45.2,2,49.3,2 M49.3,0c-4.6,0-9.2,2.2-13.2,6.7
                            c-1.3,1.5-2.4,3.4-3.4,3.5c0,0,0,0,0,0c-1.2,0-2.3-2.2-3.6-3.8c-3.3-4-7.7-6.2-13.5-6.4c-0.8,0.1-2.1,0.3-3.4,0.6
                            C1.5,3.6-3,14.3,2.1,25.3C8.5,39,19.3,49.1,30.5,58.9c0.8,0.7,1.5,1,2.3,1c0.7,0,1.4-0.3,2.2-0.9c11.4-10,22.5-20.3,28.8-34.5
                            c3.9-8.9,1.5-17.2-5.8-21.8C55.1,0.9,52.2,0,49.3,0L49.3,0z"/>
                    </g>
                </svg>
                <p class="text-slate-600 my-4">{{ $meme->likes }} likes</p>
            </div>

            <!-- COMMENT SECTION COMING SOON -->
        </section>
    @endforeach
</main>