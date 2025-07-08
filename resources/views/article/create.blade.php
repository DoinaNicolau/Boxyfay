<x-layout>
    <div class="container-fluid d-flex justify-content-center min-vh-100 align-items-center py-5 ">
        <div class="row w-75 mt-3 justify-content-center">
            <div class="col-12 col-md-10 col-lg-10">
                <livewire:article-form />
            </div>
        </div>
    </div>

    <div class="video-bg-wave">
        <video autoplay muted loop playsinline>
            <source src="{{ asset('media/glass-wave.mp4') }}" type="video/mp4">
        </video>
    </div>
    <x-modale-revisor/>
</x-layout>
