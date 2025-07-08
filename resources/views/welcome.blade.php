<x-layout>

    <!-- video come sfondo -->
    <div class="container-fluid m-0 p-0 vh-100">
        <div class="video-bg " id="videoContainer">
            <video autoplay muted loop playsinline>
                <source src="{{ asset('media/9218130-hd_1920_1080_30fps.mp4') }}" type="video/mp4" />
            </video>

            <!-- contenuto sopra il video -->
            <div class="content vetro" id="floatingBox">

                @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show mt-3 mx-3" role="alert">
                         {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
                    </div>
                @endif

                @if (session('errorMessage'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3 mx-3" role="alert">
                        {{ session('errorMessage') }}
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
                    </div>
                @endif


                <h1>{{ __('ui.herowelcome') }} </h1>
          

                <p class="cs text-bold">{{ __('ui.hero.description') }}</p>
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <a href="{{ route('article.create') }}">
                        <div class="btn btn-custom mb-3">{{ __('ui.hero.upload') }}</div>
                    </a>
                    <p>{{ __('ui.hero.or') }}</p>
                    <a href="{{ route('article.index') }}">
                        <div class="btn btn-custom">
                            {{ __('ui.hero.explore') }}
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid vh-50 pt-5 d-flex justify-content-center">
        <div class="row w-100 d-lg-flex justify-content-center mx-5">
            <div class="col-12 anim-on-scroll">
                <h2 class="fw-bold text-center display-4 my-3 border-bottom pb-3">{{ __('ui.latest.articles') }}</h2>
            </div>
            @forelse ($articles as $article)
                <div class="col-12 col-md-6 col-lg-3 px-3 my-3 d-flex justify-content-center anim-slide-in"
                    data-delay-index="{{ $loop->index }}">
                    <x-card :article="$article" />
                </div>
            @empty
                <div class="col-12 my-5">
                    <p class="fs-3 text-center ca">{{ __('ui.no_articles_found') }}</p>
                </div>
            @endforelse
        <x-modale-revisor/>
        </div>
    </div>

</x-layout>
