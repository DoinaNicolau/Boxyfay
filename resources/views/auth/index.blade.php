<x-layout>
    <div class="wrapper"></div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 justify-content-center text-center">
                <h1 class="display-1 mb-5">{{ Auth::user()->name }}</h1>
                <p class="fs-3">{{ __('ui.email') }} : {{ Auth::user()->email }}</p class="fs-3">
                <p>{{ __('ui.profile_created') }} {{ Auth::user()->created_at->diffForHumans() }}</p>
                <div class="d-flex justify-content-center mt-5 mb-3">
                    <a href="{{ route('user.edit', Auth::user()->id) }}" class="btn btn-custom me-2">
                        {{ __('ui.edit_profile') }}</a>
                    <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        class="btn btn-custom bg-danger">{{ __('ui.delete_profile') }}</a>
                </div>
            </div>
        </div>
        <div class="row mt-5 border-top mx-5">
            <div class="col-12 mt-5 text-center">
                <h2 class="pb-4">{{ __('ui.uploaded_articles') }}</h2>
            </div>
        </div>
        <div class="row mt-5 justify-content-center border-bottom pb-5 mx-5">
            @forelse ($articles as $article)
                <div class="col-12 col-md-6 col-lg-3 d-flex justify-content-center ">
                    <x-card :article="$article" />
                </div>
            @empty
                <div class="col-12 col-md-8 d-flex justify-content-center">
                    <p class="fs-3 text-center ca">{{ __('ui.no_articles_found') }}</p>
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
        <div class="row mt-5">
            <div class="col-12 text-center">
                <h2 class="pb-4">{{ __('ui.articles_pending_review') }}</h2>
            </div>
        </div>
        <div class="row mt-5 justify-content-center">
            @forelse ($pending_articles as $article)
                <div class="col-12 col-md-6 col-lg-3 d-flex justify-content-center ">
                    <x-card :article="$article" />
                </div>
            @empty
                <div class="col-12 col-md-8 d-flex justify-content-center">
                    <p class="fs-3 text-center ca">{{ __('ui.no_articles_found') }}</p>
                </div>
            @endforelse
            @if ($pending_articles->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    <div>
                        {{ $articles->links('vendor.pagination.livewire.bootstrap') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-cp ">
                <div class="modal-header bg-cp cs">
                    <h1 class="modal-title fw-bold fs-3" id="exampleModalLabel">!!! {{ __('ui.warning') }} !!!
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-cp fs-5 cs">
                    <p class="fw-bold"> {{ __('ui.delete_profile_warning') }}</p>
                </div>
                <div class="modal-footer bg-cp cs justify-content-between ">
                    <button type="button" class="btn btn-custom"
                        data-bs-dismiss="modal">{{ __('ui.stay_with_us') }}</button>
                    <form action="{{ route('user.delete', Auth::user()) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-custom bg-danger">{{ __('ui.delete_forever') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-modale-revisor />
</x-layout>
