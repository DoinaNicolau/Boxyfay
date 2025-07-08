<x-layout>
    <div class="wrapper"></div>

    <h1 class="text-center">{{ __('ui.Tutti gli articoli') }}</h1>
    <div class="container-fluid d-lg-flex mt-5 justify-content-center">
        <div class="row ">
            <div class="col-12">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="container-fluid ">
        <div class="row justify-content-center mx-5">
            <livewire:product-filter />
        </div>
    </div>
    <x-modale-revisor />
    {{-- <div class="ecommerce-icons"></div> --}}
</x-layout>
