<x-layout>

    <div class="wrapper"></div>
    <div class="container p-5  bg-article">
        <div class="row mx-auto justify-content-center mb-5">
            <div class="col-12 mb-5">
                <h1 class="text-center">{{ __('ui.search_result') }}: <span class="ca">{{ $query }}</span></h1>
            </div>
            @forelse ($articles as $article)
                <div class="col-12 col-md-6 col-lg-3 d-lg-flex justify-content-center mx-3">
                    <x-card :article="$article" />
                </div>
            @empty
                <div class="row ">
                    <div class="col-12 my-5">
                        <h3 class="text-center ca">{{ __('ui.no_articles_found') }}</h3>
                    </div>

                    <div class="col-12 col-md-6 d-flex justify-content-center my-5">
                        <a class="btn-custom  text-decoration-none"
                            href="{{ route('article.create') }}">{{ __('ui.upload_article') }}</a>
                    </div>
                    <div class="col-12 col-md-6 d-flex justify-content-center my-5">
                        <a class="btn-custom  text-decoration-none"
                            href="{{ route('article.index') }}">{{ __('ui.see_all_articles') }}</a>
                    </div>
                </div>

                <div class="video-bg-wave">
                    <video autoplay muted loop playsinline>
                        <source src="{{ asset('media/glass-wave.mp4') }}" type="video/mp4">
                    </video>
                </div>
            @endforelse
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div>
            {{ $articles->links('vendor.pagination.livewire.bootstrap') }}
        </div>
    </div>
    <x-modale-revisor />
</x-layout>
