<div class="container-fluid justify-content-center ">

    {{-- FILTRI --}}
    <div class="  ">
        <div class="row mb-4 justify-content-center ">
            <h3 class="text-center mb-4 ">Categorie</h3>
            <div class=" col-md-6 d-lg-flex flex-wrap justify-content-center  ">
                @foreach ($categories as $category)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" wire:model.lazy="selectedCategories"
                            value="{{ $category->id }}" id="cat{{ $category->id }}">
                        <label class="form-check-label me-5" for="cat{{ $category->id }}">
                            {{ $category->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-12 mt-4">
                <h3 class="text-center mt-2">Prezzo</h3>
            </div>
            <div class="row justify-content-center  mx-auto">
                <div class="col-lg-4 col-12 text-center fs-5">
                    <label for="minPrice">Min</label>
                    <input type="number" id="minPrice" wire:model.lazy="minPrice" class="form-control">
                </div>
                <div class="col-lg-4 col-12 text-center fs-5 ">
                    <label for="maxPrice">Max</label>
                    <input type="number" id="maxPrice" wire:model.lazy="maxPrice" class="form-control">
                </div>
            </div>

        </div>
    </div>

    {{-- CARD ARTICOLI --}}
    <div class="row mt-5">
        @forelse ($articles as $article)
            <div class="col-12 col-md-6 col-lg-4 my-4 d-flex justify-content-center">
                <x-card :article="$article" />
            </div>
        @empty
            <div class="col-12 text-center d-flex flex-column justify-content-center align-items-center mt-4">
                <p class="fs-1 cs">Siamo siao spiacenti</p>
                <p class=" fs-2 cs">Non sono disponibili articoli per questa categoria</p>
                <p class=" fs-2 cs">Seleziona un altra categoria</p>
                <p class=" fs-2 cs">Oppure</p>
                <a class="mt-3" href="{{ route('article.index') }}"> <button class="btn btn-custom fs-4"> Torna alla
                        lista degli
                        articoli</button></a>
            </div>
        @endforelse
    </div>
    <div class="row">
        <div class="col-12 ">
            {{ $articles->links('vendor.pagination.livewire.bootstrap') }}
        </div>
    </div>
</div>
