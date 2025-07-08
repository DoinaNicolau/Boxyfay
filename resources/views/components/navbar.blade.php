<!-- NAVBAR ESTERNA COMUNE -->
<nav class="navbar navbar-expand-lg fixed-top px-3" data-bs-theme="dark">
    <div class="container-fluid">

        <!-- LOGO + BRAND NAME (UNITI) -->
        <a class="navbar-brand cs d-flex align-items-center" href="{{ route('homepage') }}">
            <svg width="32" height="32" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" class="me-2">
                <g stroke="currentColor" stroke-width="5" fill="none" stroke-linejoin="round" stroke-linecap="round">
                    <path d="M50 15 L85 32.5 L85 67.5 L50 85 L15 67.5 L15 32.5 Z" />
                    <path d="M15 32.5 L50 50 L85 32.5" />
                    <path d="M50 50 L50 85" />
                </g>
                <polygon points="15,32.5 50,50 50,15 15,32.5" fill="#73bd61" stroke="#73bd61" stroke-width="5"
                    stroke-linejoin="round" />
            </svg>
            <span class="fw-bold">Boxyfay</span>
        </a>

        <!-- TOGGLER -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon toggler-custom"></span>
        </button>

        <!-- CONTENUTO COLLASSABILE -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- GRUPPO 1: NAVIGATION LINKS (CENTRATO AUTOMATICAMENTE) -->

            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 align-items-center gap-3">

                <!-- Primo elemento della lista -->
                <li class="nav-item">
                    <a class="nav-link cs text-underline-fx " href="{{ route('homepage') }}">{{ __('ui.Home') }}</a>
                </li>

                <!-- Secondo elemento della lista -->
                <li class="nav-item">
                    <a class="nav-link text-underline-fx " href="{{ route('article.create') }}"> <span
                            class="hover-text">{{ __('ui.Crea un articolo') }}</span></a>
                </li>

                <!-- Terzo elemento della lista (il dropdown) -->

                <!-- 1. Dropdown per Desktop (visibile solo su schermi grandi) -->
                <div class="dropdown d-none d-lg-block">
                    <a data-bs-toggle="dropdown" class="nav-link cs text-underline-fx"
                        href="#">{{ __('ui.Categorie') }}</a>
                    <ul class="dropdown-menu dropdown-menu-center p-2 bg-cp">
                        <li>
                            <a href="{{ route('article.index') }}"
                                class="nav-link cs dropdown-item text-underline-fx">{{ __('ui.Tutti gli articoli') }}</a>
                        </li>
                        @foreach ($categories as $category)
                            <li>
                                <a class="nav-link cs dropdown-item text-underline-fx"
                                    href="{{ route('article.bycategory', $category) }}">{{ __("ui.$category->name") }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- 2. Collapse Trigger per Mobile (visibile solo su schermi piccoli) -->
                <li class="nav-item d-lg-none">
                    <a class="nav-link cs text-underline-fx" data-bs-toggle="collapse" href="#menuCategorieMobile"
                        role="button" aria-expanded="false" aria-controls="menuCategorieMobile">
                        {{ __('ui.Categorie') }}
                    </a>
                </li>
                <div>
                    <li class="nav-item">

                        <div>
                            <form class="m-auto" role="search" method="GET" action="{{ route('search.article') }}"
                                data-loader data-loader-message="Ricerca..." data-loader-type="search">
                                <div class="input-group">
                                    <input type="search" name="query" class="bg-cp form-control"
                                        placeholder="{{ __('ui.search') }}" aria-label="search">
                                    <button type="submit" class="input-group-text btn-custom"
                                        id="basic-addon2">{{ __('ui.search') }}</button>
                                </div>
                            </form>
                        </div>

                    </li>
                </div>

            </ul> <!-- Fine del gruppo di navigazione centrale -->

            <!-- CONTENUTO DEL COLLAPSE MOBILE -->

            <div class="collapse d-lg-none" id="menuCategorieMobile">
                <div class="container">
                    <div class="card-body mobile-category-menu bg-cp p-3  mx-auto rounded-3 mt-2">
                        <ul class="list-unstyled text-center">
                            <li class="mb-2">
                                <a href="{{ route('article.index') }}" class="nav-link cs text-underline-fx">
                                    {{ __('ui.Tutti gli articoli') }}
                                </a>
                            </li>
                            @foreach ($categories as $category)
                                <li class="mb-2">
                                    <a class="nav-link cs text-underline-fx"
                                        href="{{ route('article.bycategory', $category) }}">
                                        {{ __("ui.$category->name") }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- GRUPPO 2: ICONE (RIMANE SULLA DESTRA) -->
            <div class="d-none d-lg-flex align-items-center justify-content-between gap-4 mt-3 mt-lg-0">
                <!-- LINGUE -->
                <div class="nav-item dropdown">
                    <a class="nav-link p-0 text-underline-fx" href="#" id="languageDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-globe fs-5"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mobile-dropdown-left text-center bg-cp p-2"
                        aria-labelledby="languageDropdown">
                        <li class="border-bottom"><x-_locale lang="it" /></li>
                        <li class="border-bottom"><x-_locale lang="en" /></li>
                        <li class="border-bottom"><x-_locale lang="ja" /></li>
                        <li class="border-bottom"><x-_locale lang="es" /></li>
                    </ul>
                </div>

                <div class="d-none d-lg-flex align-items-center justify-content-between gap-4 mt-3 mt-lg-0">
                    <!-- Link per vedere il carrello -->
                    <a href="{{ route('cart.show') }}" class="text-underline-fx">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </div>

                <!-- UTENTE -->
                <div class="nav-item dropdown">
                    <a class="nav-link p-0 text-underline-fx" href="#" id="userDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user fs-5 icon"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mobile-dropdown-right text-start bg-cp p-2"
                        aria-labelledby="userDropdown">
                        @guest
                            <li><a class="dropdown-item nav-link cs"
                                    href="{{ route('login') }}">{{ __('ui.login') }}</a></li>
                            <li><a class="dropdown-item nav-link cs"
                                    href="{{ route('register') }}">{{ __('ui.register') }}</a></li>
                        @endguest

                        @auth
                            <li class="mb-2 text-center cs">{{ Auth::user()->name }}</li>
                            <li><a class="dropdown-item nav-link cs border-top text-center"
                                    href="{{ route('user.index') }}">{{ __('ui.Profilo') }}</a></li>
                            @if (Auth::user()->is_revisor)
                                <li><a class="dropdown-item nav-link cs text-center"
                                        href="{{ route('revisor.index') }}">{{ __('ui.Area revisore') }}</a></li>
                            @endif
                            <li>
                                <a class="dropdown-item nav-link cs text-center" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('ui.Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf</form>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>

            <!-- 2.2 VERSIONE MOBILE -->

            <div class="d-lg-none mt-4 pt-3 border-top border-secondary" id="mobile-icon-menu-parent">
                <div class="d-flex justify-content-between align-items-start px-3">
                    <!-- Gruppo Lingue -->
                    <div>
                        <a class="nav-link" data-bs-toggle="collapse" href="#collapseLingueMobile" role="button"
                            aria-expanded="false" aria-controls="collapseLingueMobile"><i
                                class="fa-solid fa-globe fs-5"></i></a>
                        <div class="collapse" id="collapseLingueMobile" data-bs-parent="#mobile-icon-menu-parent">
                            <ul class="list-unstyled mt-2">
                                <li><a class="nav-link cs ps-0" href="#"><x-_locale lang="it" /></a></li>
                                <li><a class="nav-link cs ps-0" href="#"><x-_locale lang="en" /></a></li>
                                <li><a class="nav-link cs ps-0" href="#"><x-_locale lang="ja" /></a></li>
                                <li><a class="nav-link cs ps-0" href="#"><x-_locale lang="es" /></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Gruppo Carrello -->

                    <!-- Link per vedere il carrello -->
                    <a href="{{ route('cart.show') }}" class="text-underline-fx">
                        <i class="fas fa-shopping-cart"></i>
                    </a>


                    <!-- Gruppo Utente -->
                    <div class="text-end">
                        <a class="nav-link d-inline-block" data-bs-toggle="collapse" href="#collapseUtenteMobile"
                            role="button" aria-expanded="false" aria-controls="collapseUtenteMobile"><i
                                class="fa-solid fa-user fs-5 icon"></i></a>
                        <div class="collapse" id="collapseUtenteMobile" data-bs-parent="#mobile-icon-menu-parent">
                            <ul class="list-unstyled mt-2">
                                @guest
                                    <li><a class="nav-link cs pe-0" href="{{ route('login') }}">{{ __('ui.login') }}</a>
                                    </li>
                                    <li><a class="nav-link cs pe-0"
                                            href="{{ route('register') }}">{{ __('ui.register') }}</a></li>
                                @endguest
                                @auth
                                    <li class="pe-0 mb-2 cs text-white-50">{{ Auth::user()->name }}</li>
                                    <li><a class="nav-link cs pe-0"
                                            href="{{ route('user.index') }}">{{ __('ui.Profilo') }}</a></li>
                                    @if (Auth::user()->is_revisor)
                                        <li><a class="nav-link cs pe-0"
                                                href="{{ route('revisor.index') }}">{{ __('ui.Area revisore') }}</a></li>
                                    @endif
                                    <li><a class="nav-link cs pe-0" href="#"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('ui.Logout') }}</a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- /collapse navbar-collapse -->
    </div>
</nav>
