<x-layout>

    {{-- HEADER REVISORE --}}
    <div class="dashboard-revisore-container mt-5">
        <header class="revisore-header vetro-castom anim-on-scroll p-4 p-md-5 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <div class="revisore-info text-center text-md-start">
                <h1 class="ts h2">Benvenuto, {{ auth()->user()->name }}!</h1>
                <p class="mb-0"><strong>Ruolo:</strong> Revisore</p>
            </div>
            <div class="revisore-stats p-3">
                <span class="badge-revisore">
                    {{ \App\Models\Article::toBeRevisedCount() }} articoli da revisionare
                </span>
            </div>
        </header>
    </div>

    <main class="container-fluid px-md-4">

        {{-- MESSAGGIO DI SUCCESSO --}}
        @if (session('message'))
            <div class="alert alert-success anim-on-scroll anim-delay-1 text-center mt-4">
                <p class="fs-5 my-auto cp">{{ session('message') }}</p>
            </div>
        @endif

        {{-- SEZIONE PRINCIPALE CON ARTICOLO DA REVISIONARE --}}
        <section class="sezione-principale anim-on-scroll anim-delay-2 py-5">
            @if ($article_to_check)
                {{-- Griglia principale che contiene immagini e dettagli --}}
                <div class="row g-4 g-lg-5">

                    {{-- COLONNA IMMAGINI (si mostra solo se ci sono immagini) --}}
                    @if ($article_to_check->images->isNotEmpty())
                        <div class="col-12 col-lg-7">
                            @if ($article_to_check->updated_at > $article_to_check->created_at)
                                <div class="bg-warning bg-opacity-75 rounded-4 mb-4 p-3 text-center text-dark">
                                    <h2 class="h4">Articolo Modificato</h2>
                                    <p class="fw-semibold mb-0">Rivedere le modifiche dopo l'approvazione iniziale.</p>
                                </div>
                            @else
                                <h2 class="mb-4 text-center ts h3">Immagini e Analisi</h2>
                            @endif

                            {{-- Griglia per le singole immagini --}}
                            <div class="row g-3">
                                @foreach ($article_to_check->images as $key => $image)
                                    <div class="col-12 col-md-6">
                                        <div class="card">
                                            <div class="card-inner">
                                                <div class="card-front">
                                                    <img src="{{ $image->getUrl(600, 600) }}" class="img-card" alt="Immagine {{ $key + 1 }}">
                                                </div>
                                                <div class="card-back">
                                                    <div class="image-review-data p-3">
                                                        <h5 class="mb-3">Risultati Analisi</h5>
                                                        <div class="rating-entry"><div class="rating-box {{ $image->adult }}"></div> Adult</div>
                                                        <div class="rating-entry"><div class="rating-box {{ $image->violence }}"></div> Violence</div>
                                                        <div class="rating-entry"><div class="rating-box {{ $image->spoof }}"></div> Spoof</div>
                                                        <div class="rating-entry"><div class="rating-box {{ $image->racy }}"></div> Racy</div>
                                                        <div class="rating-entry"><div class="rating-box {{ $image->medical }}"></div> Medical</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- COLONNA DETTAGLI ARTICOLO (sempre visibile) --}}
                    <div class="col-12 @if($article_to_check->images->isNotEmpty()) col-md-6 col-lg-5 @else col-md-10 col-lg-8 mx-auto @endif">
                        <div class="box-revisor d-flex flex-column p-4">
                        
                            @if ($article_to_check->images->isEmpty())
                                <div class="alert alert-danger text-center">
                                    <h2 class="h4 mb-0">Attenzione: Articolo senza immagini!</h2>
                                </div>
                            @endif

                            <header class="revisore-card-header mt-3">
                                @if ($article_to_check->updated_at > $article_to_check->created_at && $article_to_check->images->isEmpty())
                                    <span class="badge bg-warning text-dark p-2 mb-3 d-block">MODIFICATO</span>
                                @endif
                                <h3 class="text-break">{{ $article_to_check->title }}</h3>
                                <div class="fs-5 mt-3">
                                    <div><span class="ca fw-bold">Autore:</span> <strong>{{ $article_to_check->user->name }}</strong></div>
                                    <div><span class="ca fw-bold">Categoria:</span> <strong>{{ $article_to_check->category->name }}</strong></div>
                                </div>
                            </header>

                            <div class="mt-4 flex-grow-1">
                                <p class="fw-bold ca fs-4">Descrizione:</p>
                                <p class="fs-5 text-c">{{ $article_to_check->description }}</p>
                                <p class="fs-4 prezzo fw-bold ca mt-4">Prezzo:</p>
                                <p class="fs-3">{{ number_format($article_to_check->price, 2, ',', '.') }} €</p>
                            </div>

                            <div class="d-flex flex-column flex-sm-row justify-content-center gap-3 mt-auto pt-4">
                                <form action="{{ route('accept', $article_to_check) }}" method="POST" class="d-grid">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn-custom">Accetta Articolo</button>
                                </form>
                                <form action="{{ route('reject', $article_to_check) }}" method="POST" class="d-grid">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn-custom-danger">Rifiuta Articolo</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                {{-- MESSAGGIO QUANDO NON CI SONO ARTICOLI DA REVISIONARE --}}
                <div class="no-articles-box mx-auto text-center p-4">
                    <h2 class="h1">Ottimo Lavoro!</h2>
                    <p class="my-3 fs-5">Non ci sono nuovi articoli da revisionare. Goditi il momento! 🎉</p>
                    <a href="{{ route('homepage') }}" class="btn btn-custom btn-accept mt-3 ts cs">
                        <span class="fw-bold my-auto fs-4">Torna alla Homepage</span>
                    </a>
                </div>
            @endif
        </section>

        {{-- SEZIONE CRONOLOGIA REVISIONI --}}
        <section class="sezione-cronologia py-5 anim-delay-3">
            <h2 class="ts h1 text-center">Cronologia Revisioni</h2>

            @if ($revised_articles->isNotEmpty())
                <div class="container mt-4">
                    <div class="row g-4">
                        @foreach ($revised_articles as $article)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="history-card box-article" data-bs-toggle="modal" data-bs-target="#modal-articolo-{{ $article->id }}">
                                    <h4 class="h5">{{ Str::limit($article->title, 55) }}</h4>
                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        <span class="stato-badge {{ $article->is_accepted ? 'stato-accettato' : 'stato-rifiutato' }}">
                                            {{ $article->is_accepted ? 'Accettato' : 'Rifiutato' }}
                                        </span>
                                        <span class="icona-apri"><i class="fa-solid fa-eye ca"></i></span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                @if ($revised_articles->hasPages())
                    <div class="d-flex justify-content-center paginazione-wrapper mt-5">
                        {{ $revised_articles->links('vendor.pagination.bootstrap-5') }}
                    </div>
                @endif
            @else
                <p class="text-center fs-5 mt-4">Non hai ancora revisionato nessun articolo.</p>
            @endif
        </section> 

        {{-- MODALI PER LA CRONOLOGIA --}}
        @foreach ($revised_articles as $article)
            <div class="modal fade" id="modal-articolo-{{ $article->id }}" tabindex="-1" aria-labelledby="modalLabel-{{ $article->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-md-down">
                    <div class="modal-content vetro-castom">
                        <div class="modal-header">
                            <h5 class="modal-title ts" id="modalLabel-{{ $article->id }}">{{ $article->title }}</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @if ($article->images->isNotEmpty())
                                <div class="row g-3 mb-4">
                                    @foreach ($article->images as $image)
                                        <div class="col-12 col-sm-6">
                                            <img src="{{ $image->getUrl(600, 600) }}" alt="Immagine articolo" class="img-fluid rounded modal-thumbnail">
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center p-4 border rounded-3 mb-3">
                                    <i class="bi bi-image-alt fs-1"></i>
                                    <p class="mb-0">Nessuna immagine fornita</p>
                                </div>
                            @endif
                            <hr class="my-4">
                            <p><strong>Autore:</strong> {{ $article->user->name }}</p>
                            <p><strong>Categoria:</strong> {{ $article->category->name }}</p>
                            <p class="prezzo"><strong>Prezzo:</strong> € {{ number_format($article->price, 2, ',', '.') }}</p>
                            <p class="mt-3"><strong>Descrizione:</strong><br>{{ $article->description }}</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <span class="stato-badge {{ $article->is_accepted ? 'stato-accettato' : 'stato-rifiutato' }}">
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

    </main>

</x-layout>