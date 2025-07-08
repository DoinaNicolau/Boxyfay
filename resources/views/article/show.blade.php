<x-layout>
    <div class="wrapper"></div>

    <div class="container-fluid px-lg-5 mt-5">
        <div class="row">
            <div class="col-12">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <h1 class="text-center display-4 pb-4">{{ $article->title }}</h1>
            </div>
        </div>
        @if (session('success'))
            <div class="container"> <!-- Padding per non finire sotto la navbar fissa -->
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <!-- Ecco il nostro link! -->
                    <a href="{{ route('cart.show') }}" class="alert-link ms-3 ca ">Vedi il carrello</a>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        {{-- UNICO ROW PER LE 3 COLONNE PRINCIPALI --}}
        <div class="row justify-content-center">

            {{-- Controlliamo se l'articolo ha immagini --}}
            @if ($article->images->isNotEmpty())

                <!-- COLONNA 1: MINIATURE (Visibile solo su schermi grandi) -->

                <div class="col-lg-1 d-none d-lg-flex flex-column align-items-center gap-3">

                    @foreach ($article->images as $image)
                        <img src="{{ $image->getUrl(600, 600) }}"
                            class="img-thumbnail img-miniatura immagine-miniatura">
                    @endforeach
                </div>

                <!-- COLONNA 2: IMMAGINE PRINCIPALE -->
                <div class="col-12 col-md-8 col-lg-6 text-center">

                    <img id="mainImage" src="{{ $article->images->first()->getUrl(600, 600) }}"
                        alt="{{ $article->title }}" class="img-fluid rounded immagine-principale">

                    <!-- MINIATURE SOTTO (Visibili solo su schermi piccoli e medi) -->
                    <div class="d-flex d-lg-none justify-content-center gap-2 mt-3">

                        @foreach ($article->images as $image)
                            <img src="{{ $image->getUrl(600, 600) }}"
                                class="img-thumbnail img-miniatura immagine-miniatura"
                                style="width: 80px; height: 80px; object-fit: cover;">
                        @endforeach
                    </div>
                </div>
            @else
                <div class="col-12 col-md-8 col-lg-7 text-center">
                    <img src="{{ asset('media/446b84ea63918e815bee76614b8eae04.jpg') }}"
                        alt="Nessuna immagine disponibile" class="img-fluid rounded immagine-principale">
                </div>

            @endif
            <!-- COLONNA 3: DETTAGLI PRODOTTO -->
            <div class="col-12 col-lg-4 mt-4 mt-lg-0">
                <div class="box-article-show d-flex flex-column text-show h-100">
                    <h2 class="cs border-bottom pb-3">{{ __('ui.details') }}</h2>

                    <p><strong>{{ __('ui.uploaded_on') }}</strong> {{ $article->created_at->format('d/m/Y') }}</p>
                    <p><strong>{{ __('ui.uploaded_by') }}</strong> {{ $article->user->name }}</p>

                    <p class="mt-3">
                        <strong>{{ __('ui.description') }}</strong><br><span>{{ $article->description }}</span>
                    </p>

                    <p class="mt-3"><strong>{{ __('ui.categoria') }}</strong> <a class="ts cs text-decoration-none"
                            href="{{ route('article.bycategory', $article->category) }}">{{ __('ui.' . $article->category->translation_key) }}</a>
                    </p>

                    <h3 class="mt-auto pt-3"><strong>{{ __('ui.prezzo') }}</strong> <span class="ca fs-2">€
                            {{ $article->price }}</span></h3>

                    {{-- per l'utente --}}
                    @auth
                        @if (Auth::user()->id === $article->user_id)
                            <div class="d-flex gap-2 mt-4">
                                <!-- BOTTONI -->
                                <button type="button" class="btn btn-custom" data-bs-toggle="modal"
                                    data-bs-target="#editArticleModal{{ $article->id }}">
                                    {{ __('ui.edit') }}
                                </button>
                                <button type="button" class="btn btn-custom-danger" data-bs-toggle="modal"
                                    data-bs-target="#confirmDeleteModal{{ $article->id }}">
                                    {{__('ui.delete') }}
                                </button>
                            </div>


                            {{-- MODALE DI MODIFICA ARTICOLO --}}

                            <div class="modal fade" id="editArticleModal{{ $article->id }}" tabindex="-1"
                                aria-labelledby="editArticleModalLabel{{ $article->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    {{-- Applico la classe box-article per lo stile e bg-cp per lo sfondo --}}
                                    <div class="modal-content box-article bg-cp">
                                        <div class="modal-header border-bottom border-ca">
                                            <h5 class="modal-title" id="editArticleModalLabel{{ $article->id }}">{{__('ui.edit')}}</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                aria-label="Chiudi"></button>
                                        </div>

                                        {{-- Il form ora avvolge solo il body e il footer --}}
                                        <form method="POST" action="{{ route('articles.update', $article->id) }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="title{{ $article->id }}" class="form-label">{{__('ui.title')}}</label>
                                                    <input type="text" name="title" id="title{{ $article->id }}"
                                                        class="form-control" value="{{ $article->title }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="price{{ $article->id }}" class="form-label">{{ __('ui.prezzo') }}</label>
                                                    <input type="number" name="price" id="price{{ $article->id }}"
                                                        step="0.01" class="form-control" value="{{ $article->price }}"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description{{ $article->id }}"
                                                        class="form-label">{{ __('ui.description') }}</label>
                                                    <textarea name="description" id="description{{ $article->id }}" class="form-control" rows="4" required>{{ $article->description }}</textarea>
                                                </div>
                                            </div>

                                            <div class="modal-footer border-top-0">
                                                <button type="button" class="btn btn-custom-danger"
                                                    data-bs-dismiss="modal">{{__('ui.cancel')}}</button>
                                                <button type="submit" class="btn btn-custom">{{__('ui.save_changes')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            {{-- MODALE DI CONFERMA CANCELLAZIONE --}}

                            <div class="modal fade" id="confirmDeleteModal{{ $article->id }}" tabindex="-1"
                                aria-labelledby="confirmDeleteLabel{{ $article->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content box-article bg-cp">
                                        <div class="modal-header border-bottom border-ca">
                                            <h5 class="modal-title" id="confirmDeleteLabel{{ $article->id }}">{{__('ui.confirm_deletion')}}</h5>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal" aria-label="Chiudi"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{__('ui.confirm_article_deletion')}}
                                            <strong>"{{ $article->title }}"</strong>?
                                        </div>
                                        <div class="modal-footer border-top-0">
                                            <button type="button" class="btn btn-secondary-custom"
                                                data-bs-dismiss="modal">{{__('ui.cancel')}}</button>
                                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-custom-danger">{{__('ui.delete')}}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endauth

                    {{-- Qui puoi rimettere il form del carrello e i pulsanti di modifica/cancella --}} 
                    <form action="{{ route('cart.add', $article) }}" method="POST" class="mt-auto">
                        @csrf
                        
                        <div class="mb-2">
                            <label for="quantity-{{ $article->id }}" class="form-label">Quantità</label>
                            <!-- L'input ha name="quantity", che il controller si aspetta -->
                            <input type="number" name="quantity" id="quantity-{{ $article->id }}" value="1" min="1" class="form-control" style="max-width: 80px;">
                        </div>
                        
                        <button type="submit" class="btn btn-custom w-100">
                            <i class="fas fa-shopping-cart"></i> Aggiungi al Carrello
                        </button>
                         <a href="{{ route('article.index') }}" class="btn btn-custom w-100 mt-2 py-2 mb-2">
                                <i class="fas fa-store me-2"></i> continua a navigare
                        </a>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MODALE INGRANDIMENTO IMMAGINE (fuori dalla griglia) -->
    <div id="imageModal" class="modal-img" onclick="closeModal()">
        <span class="modal-close" onclick="event.stopPropagation(); closeModal()">×</span>
        <img class="Immagine ingrandita" id="modalImage">
    </div>
   

    <!-- MODELLO INGRANDIMENTO -->
    <div id="imageModal" class="modal-img">
        <span class="modal-close">&times;</span>
        <img class="Immagine ingrandita" id="modalImage">
    </div>

    <x-modale-revisor/>

</x-layout>
