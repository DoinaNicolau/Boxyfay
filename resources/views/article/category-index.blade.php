<x-layout>
    <div class="wrapper"></div>
    <div class="container">
        <div class="row  ">
            <div class="col-12 d-flex justify-content-center">
                <h1 class="text-center">
                    {{ __("ui.$category->name") }}
                </h1>
            </div>
        </div>
        <div class="row d-flex justify-content-center mx-sm-0 px-sm-0 mt-5">
            @forelse ($articles as $article)
                <div class="col-12 px-sm-0 mx-sm-0 col-md-12 col-lg-3 d-flex justify-content-center ">
                    <x-card :article="$article" />
                </div>
            @empty
                <div class="col-12 col-md-8 d-flex justify-content-center">
                    <p class="fs-3 text-center ca">{{ __('ui.no_articles_found') }}</p>
                </div>
                <div class="col-12 d-flex justify-content-center mt-5">
                    <a class="btn btn-custom" href="{{ route('article.create') }}">{{ __('ui.upload_article') }}</a>
                </div>
                <div class="video-bg-wave">
                    <video autoplay muted loop playsinline>
                        <source src="{{ asset('media/glass-wave.mp4') }}" type="video/mp4">
                    </video>
                </div>
            @endforelse
            @if ($articles->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    <div>
                        {{ $articles->links('vendor.pagination.livewire.bootstrap') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
    <x-modale-revisor />
</x-layout>
