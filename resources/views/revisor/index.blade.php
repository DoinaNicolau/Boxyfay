<x-layout>



    {{-- nuova dashboard  --}}


       <!-- HEADER REVISORE CON EFFETTO VETRO -->
    <div class="dashboard-revisore-container mt-5">
        <header class="revisore-header vetro-castom anim-on-scroll p-4 p-md-5 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
          
            <div class="revisore-info text-center text-md-start">
                <h1 class="ts h2">Benvenuto, {{ auth()->user()->name }}!</h1> 
                <p><strong>Ruolo:</strong> Revisore</p>
            </div>

            <div class="revisore-stats p-3">
                <span class="badge-revisore">
                    {{ \App\Models\Article::toBeRevisedCount() }} articoli da revisionare
                </span>
            </div>
        </header>
    </div>





    {{-- Fine del .dashboard-revisore-container --}}

    <main>

         <!-- MESSAGGIO DI SUCCESSO -->
        @if (session('message'))
            <div class="alert alert-success anim-on-scroll anim-delay-1 text-center">
                <p class="fs-5 my-auto cp">{{ session('message') }}</p>
            </div>
        @endif

        {{-- SEZIONE PRINCIPALE CON ARTICOLO DA REVISIONARE --}}
        <section class="sezione-principale anim-on-scroll anim-delay-2 pt-5">
            @if ($article_to_check)
                <div class="revisore-card py-5 container-fluid">

                <div class="row g-4 justify-content-center">
                    {{-- Separatore visivo per distinguere i dettagli dall'analisi immagini --}}

                    <hr class="mx-4" style="border-color: var(--vetro-border);">

                    {{-- NUOVA GRIGLIA DI ANALISI IMMAGINI --}}
                    @if ($article_to_check->images->isNotEmpty())
                    <div class="col-12 col-lg-7">
                        @if ($article_to_check->updated_at > $article_to_check->created_at)
                            <div class="bg-w rounded-5 mb-4 p-3 text-center">
                                        <h1 class="cp">Articoli Modificati</h1>
                                        <p class="fs-5 cp fw-semibold">Questo articolo è stato modificato dopo la sua
                                            approvazione
                                            iniziale. Si prega di rivedere le modifiche.</p>
                            </div>
                            
                        @else
                            <h4 class="mb-3 text-center display-4 ts">Articoli da revisionare</h4>
                        @endif


                        <div class="container-fluid d-lg-flex justify-content-evenly">
                            <div class="row g-3 mt-5  mx-0   ">
                                @foreach ($article_to_check->images as $key => $image)
                                    {{-- Ogni immagine è una colonna nella griglia --}}
                                    <div class="col-lg-6 col-12">
                                        <div class="card">
                                            <div class="card-inner">
                                                <div class="card-front">


                                                    <img src="{{ $image->getUrl(600, 600) }}" class=" img-card "
                                                        alt="Immagine {{ $key + 1 }}">

                                                </div>
                                                <div class="card-back">
                                                    {{-- Colonna con i dati dell'analisi --}}
                                                    <div class="col-12 mt-3">
                                                        <div class="image-review-data">
                                                            <h5 class="mb-3">Risultati Analisi</h5>
                                                            <div class="rating-entry ">
                                                                <div class="rating-box {{ $image->adult }}">
                                                                </div> Adult
                                                            </div>
                                                            <div class="rating-entry ">
                                                                <div class="rating-box {{ $image->violence }}">
                                                                </div>
                                                                Violence
                                                            </div>
                                                            <div class="rating-entry ">
                                                                <div class="rating-box {{ $image->spoof }}">
                                                                </div> Spoof
                                                            </div>
                                                            <div class="rating-entry ">
                                                                <div class="rating-box {{ $image->racy }}">
                                                                </div> Racy
                                                            </div>
                                                            <div class="rating-entry ">
                                                                <div class="rating-box {{ $image->medical }}">
                                                                </div>
                                                                Medical
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                            <div class="row g-3 mt-5 justify-content-center mx-0 box-revisor">
                                <div class="col-lg-8 col-12 d-lg-flex flex-column align-items-center">
                                    {{-- HEADER DELLA CARD --}}
                                    <header class="revisore-card-header ">
                                        @if ($article_to_check->updated_at > $article_to_check->created_at)
                                            <span
                                                class="badge bg-warning d-flex justify-content-center mx-auto text-dark p-3">MODIFICATO</span>
                                        @endif
                                        <h3 class="text-start text-break">{{ $article_to_check->title }}</h3>
                                        <div
                                            class=" d-flex flex-column align-items-center justify-content-center fs-4 ft  mt-3">
                                            <div>
                                                <span class="ca fw-bold text-center">Autore:</span>
                                                <strong>{{ $article_to_check->user->name }}</strong>
                                            </div>
                                            <div>
                                                <span class="ca fw-bold text-center">Categoria:</span>
                                                <strong>{{ $article_to_check->category->name }}</strong>
                                            </div>
                                        </div>




                                    </header>

                                    {{-- 2. DETTAGLI PRINCIPALI --}}
                                    <div class="col-12 text-start">
                                        <p class=" text-center fs-5 mt-2 ">
                                            <span class="fw-bold ca fs-4 lh-base ">Descrizione articolo:</span>
                                        <p class="fs-3 text-center text-c">{{ $article_to_check->description }}
                                        </p>
                                        </p>
                                        <p class="text-center fs-4 prezzo fw-bold ca">Prezzo:</p>
                                        <p class="text-center fs-3">
                                            {{ number_format($article_to_check->price, 2, ',', '.') }}€</p>

                                    </div>
                                    <div class=" d-flex justify-content-center  mt-5 pb-5">
                                        <form action="{{ route('accept', $article_to_check) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn-custom mx-3">Accetta Articolo</button>
                                        </form>
                                        <form action="{{ route('reject', $article_to_check) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn-custom-danger">Rifiuta
                                                Articolo</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Blocco di fallback se non ci sono immagini, ora fuori dalla card principale --}}
                        <div class="row g-3 mt-5 justify-content-center mx-0 box-article">
                            <div class="alert bg-danger">
                                <div class="col-12">
                                    <h2 class="text-center">!!!Attenzione: questo articolo non ha immagini associate!!!
                                    </h2>
                                </div>
                            </div>
                            <div class="col-lg-8 col-12 d-lg-flex flex-column align-items-center">
                                {{-- HEADER DELLA CARD --}}
                                <header class="revisore-card-header ">
                                    @if ($article_to_check->updated_at > $article_to_check->created_at)
                                        <span
                                            class="badge bg-warning d-flex justify-content-center mx-auto text-dark p-3">MODIFICATO</span>
                                    @endif
                                    <h3 class="text-center">{{ $article_to_check->title }}</h3>
                                    <div
                                        class=" d-flex flex-column align-items-center justify-content-center fs-4 ft  mt-3">
                                        <div>
                                            <span class="ca fw-bold text-center">Autore:</span>
                                            <strong>{{ $article_to_check->user->name }}</strong>
                                        </div>
                                        <div>
                                            <span class="ca fw-bold text-center">Categoria:</span>
                                            <strong>{{ $article_to_check->category->name }}</strong>
                                        </div>
                                    </div>




                                </header>

                                <div class="col-12">
                                    <p class=" text-center fs-5 mt-2">
                                        <span class="fw-bold ca fs-4 lh-base ">Descrizione articolo:</span>
                                    <p class="fs-3 text-center ">{{ $article_to_check->description }}</p>
                                    </p>
                                    <p class="text-center fs-4 prezzo fw-bold ca">Prezzo:</p>
                                    <p class="text-center fs-3">
                                        {{ number_format($article_to_check->price, 2, ',', '.') }}€</p>

                                </div>
                                <div class=" d-flex justify-content-center  mt-5 pb-5">
                                    <form action="{{ route('accept', $article_to_check) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn-custom mx-3">Accetta Articolo</button>
                                    </form>
                                    <form action="{{ route('reject', $article_to_check) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn-custom-danger">Rifiuta
                                            Articolo</button>
                                    </form>

                                </div>
                    @endif


                </div>
            @else
                {{-- SE NESSUN ARTICOLO DA REVISIONARE --}}
                <div class="no-articles-box mx-auto display-4 text-center ">
                    <h2 class="display-4 ">Ottimo Lavoro!</h2>
                    <p class="my-3 ">Non ci sono nuovi articoli in coda da revisionare. Goditi il momento! 🎉
                    </p>
                    <a href="{{ route('homepage') }}" class="btn btn-custom btn-accept mt-3 display-6 ts cs">
                        <p class="fw-bold my-auto fs-3">Torna
                            alla
                            Homepage</p>
                    </a>
                </div>
            @endif
        </section>

        <!-- SEZIONE CRONOLOGIA REVISIONI (AGGIORNATA) -->
        <section class="sezione-cronologia pb-5 anim-delay-3">
            <h2 class="ts display-4">Cronologia Revisioni</h2>

            @if ($revised_articles->isNotEmpty())
                <div class="container mt-5">
                    <div class="row w-100 ">
                        @foreach ($revised_articles as $article)
                            <div class="col-lg-4 col-12 flex-column mt-5">
                                {{-- La card rimane il trigger per la modale di Bootstrap --}}
                                <div class="history-card box-article" data-bs-toggle="modal"
                                    data-bs-target="#modal-articolo-{{ $article->id }}">

                                    {{-- Titolo dell'articolo --}}
                                    <h4>{{ $article->title }}</h4>

                                    {{-- NUOVO: Contenitore per badge e icona, spinto in basso --}}
                                    <div class="d-flex justify-content-between align-items-center mt-auto">

                                        {{-- Badge di stato (come prima) --}}
                                        <span
                                            class="stato-badge {{ $article->is_accepted ? 'stato-accettato' : 'stato-rifiutato' }}">
                                            {{ $article->is_accepted ? 'Accettato' : 'Rifiutato' }}
                                        </span>

                                        {{-- ICONA DELL'OCCHIO RIPRISTINATA --}}
                                        <span class="icona-apri">
                                            <i class="fa-solid fa-eye ca"></i>
                                        </span>

                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>

                @if ($revised_articles->hasPages())
                    <div class="d-flex justify-content-center paginazione-wrapper mt-5">
                        {{ $revised_articles->links('vendor.pagination.livewire.bootstrap') }}
                    </div>
                @endif
            @else
                <p class="text-center">Non hai ancora revisionato nessun articolo.</p>
            @endif
            <!-- MODALI NASCOSTE (ATTIVE) -->
            @foreach ($revised_articles as $article)
                <div class="modal fade" id="modal-articolo-{{ $article->id }}" tabindex="-1"
                    aria-labelledby="modalLabel-{{ $article->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-fullscreen-custom">
                        <div class="modal-content vetro-castom"> {{-- Ho aggiunto vetro-castom per lo stile --}}
                            <div class="modal-header">
                                <h5 class="modal-title ts" id="modalLabel-{{ $article->id }}">{{ $article->title }}
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                {{-- GRIGLIA IMMAGINI NELLA MODALE --}}
                                @if ($article->images->isNotEmpty())
                                    <div class="row g-3 mb-4">
                                        @foreach ($article->images as $image)
                                            <div class="col-12 col-md-6">
                                                <img src="{{ $image->getUrl(600, 600) }}" alt="Immagine articolo"
                                                    class="img-fluid rounded modal-thumbnail">
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="nessuna-immagine-box">
                                        <i class="bi bi-image-alt fs-1"></i>
                                        <p>Nessuna immagine fornita</p>
                                    </div>
                                @endif

                                <hr class="my-4">

                                {{-- DETTAGLI NELLA MODALE --}}

                                <p><strong>Autore:</strong> {{ $article->user->name }}</p>
                                <p><strong>Categoria:</strong> {{ $article->category->name }}</p>
                                <p class="prezzo"><strong>Prezzo:</strong> €
                                    {{ number_format($article->price, 2, ',', '.') }}</p>
                                <p class="mt-3"><strong>Descrizione:</strong><br>{{ $article->description }}</p>

                            </div>
                            <div class="modal-footer justify-content-between">
                                <span
                                    class="stato-badge {{ $article->is_accepted ? 'stato-accettato' : 'stato-rifiutato' }}">
                                    Stato: {{ $article->is_accepted ? 'Accettato' : 'Rifiutato' }}
                                </span>
                                <form action="{{ route('change', $article) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn-modifica">Cambia stato</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            </div>
        </section>
    </main>



</x-layout>
