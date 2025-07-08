<x-layout>
    {{-- Aggiungo le classi per lo stile custom --}}
    <div class="container" style="padding-top: 10rem; min-height: 80vh;">
        
        @if (session('success'))
            {{-- Utilizzo l'alert custom che abbiamo definito prima --}}
            <div class="row justify-content-center mb-4">
                <div class="col-12">
                    <div class="custom-alert-success" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle fa-2x me-3 ca"></i>
                            <div>
                                <h5 class="alert-heading ft">Successo!</h5>
                                <p class="mb-0">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <h1 class="mb-4 text-center display-4 ts">Il Tuo Carrello</h1>
        
        @php
            // La tua logica PHP originale per calcolare il totale
            $cart = session()->get('cart', []);
            $total = 0;
            if (!empty($cart)) {
                foreach ($cart as $item) {
                    $total += $item['price'] * $item['quantity'];
                }
            }
        @endphp

        @if(empty($cart))
            {{-- Box personalizzato per il carrello vuoto --}}
            <div class="no-articles-box text-center py-5">
                <i class="fas fa-shopping-cart fa-4x mb-4"></i>
                <h3 class="ft">Il tuo carrello è vuoto</h3>
                <p class="lead cs">Sembra che tu non abbia ancora aggiunto nessun articolo.</p>
                <a href="{{ route('article.index') }}" class="btn btn-custom mt-3">
                    <i class="fas fa-store me-2"></i> Torna agli articoli
                </a>
            </div>
        @else
            <div class="row g-4">
                <!-- Colonna degli articoli -->
                <div class="col-lg-8">
                    
                    @foreach($cart as $id => $item)

                        {{-- Utilizzo la classe .box-article per lo stile --}}
                        <div class="box-article mb-3 p-3">
                            <div class="d-flex align-items-center">
                                
                                {{-- LOGICA CORRETTA PER L'IMMAGINE --}}
                                {{-- Controlliamo la chiave 'image_path' che salvi nel controller --}}
                                @if(isset($item['image_path']) && $item['image_path'])
                                    {{-- Usiamo l'helper asset() per generare il link corretto --}}
                                    <img src="{{ Storage::url($item['image_path']) }}" 
                                         width="300" height="300" 
                                         class="me-3 rounded img-miniatura" 
                                         alt="{{ $item['name'] }}"
                                         style="object-fit: cover;">
                                @else
                                    {{-- Immagine segnaposto se non c'è --}}
                                    <img src="{{ asset('media/placeholder.jpg') }}" 
                                         width="100" height="100"
                                         class="me-3 rounded" alt="Immagine non disponibile">
                                @endif
                                
                                <div class="flex-grow-1">
                                    <h5 class="card-title ft">{{ $item['name'] }}</h5>
                                    <p class="card-text mb-1">
                                        Quantità: <span class="fw-bold">{{ $item['quantity'] }}</span>
                                    </p>
                                    <p class="card-text">
                                        Prezzo: <span class="fw-bold ca">€{{ number_format($item['price'], 2, ',', '.') }}</span>
                                    </p>
                                </div>
                                
                                {{-- Bottone Rimuovi con stile custom --}}
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="article_id" value="{{ $id }}">
                                    <button type="submit" class="btn btn-custom-danger btn-sm" title="Rimuovi articolo">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Colonna del riepilogo -->
                <div class="col-lg-4">
                    {{-- Utilizzo la classe .box-article-show per il riepilogo --}}
                    <div class="box-article-show sticky-top" style="top: 10rem;">
                        <h4 class="card-title ft border-bottom pb-2">Riepilogo Ordine</h4>
                        
                        <div class="d-flex justify-content-between align-items-center my-3">
                            <span class="fs-5">Totale Provvisorio:</span>
                            <strong class="fs-4 ca">€{{ number_format($total, 2, ',', '.') }}</strong>
                        </div>
                        <hr class="border-ca">
                    
                            <a href="{{ route('article.index') }}" class="btn btn-custom w-100 py-2 mb-2">
                                <i class="fas fa-store me-2"></i> continua a navigare
                            </a>
                      
                        {{-- Bottoni di azione con il tuo stile --}}
                        @auth
                            <form action="{{ route('cart.checkout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-custom w-100 py-2">
                                    <i class="fas fa-credit-card me-2"></i> Paga Ora (Simulazione)
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-custom w-100 py-2">
                                <i class="fas fa-sign-in-alt me-2"></i> Accedi per acquistare
                            </a>
                        @endauth
                        
                        <!-- Bottone per svuotare il carrello -->
                        <form action="{{ route('cart.clear') }}" method="POST" class="mt-2">
                            @csrf
                            <button type="submit" class="btn btn-custom-danger w-100">
                                <i class="fas fa-trash-alt me-2"></i> Svuota carrello
                            </button>
                        </form>

 
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="ecommerce-icons"></div>
</x-layout>