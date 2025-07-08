<footer class="mt-5 border-top  py-4">

    <div class="container-fluid">
        <div class="row justify-content-evenly text-center">

             <!-- COLONNA 1: Servizio Clienti -->
            <div class="col-12 col-md-4 mb-4 mb-md-0"> 
                <h3 class="mb-3">{{ __('ui.customer_service') }}</h3>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-decoration-none footer-link cs">{{ __('ui.shipping_returns') }}</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none footer-link cs">{{ __('ui.contact') }}</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none footer-link cs">{{ __('ui.faq') }}</a></li>
                    <li><a href="#" class="text-decoration-none footer-link cs">{{ __('ui.terms') }}</a></li>
                </ul>
            </div>

            <!-- COLONNA 2: Social Media -->
            <div class="col-12 col-md-4 mb-4 mb-md-0">
                <h3 class="mb-5">{{__('ui.stay_connected')}}</h3> <!-- Ti consiglio di usare un titolo qui per coerenza -->
                <div class="d-flex justify-content-center gap-4">
                    <a href="#" aria-label="Facebook" class="hover:text-blue-600 icon-border">
                        <i class="fab fa-facebook fa-lg fs-2" id="facebook"></i>
                    </a>
                    <a href="#" aria-label="Instagram" class="hover:text-pink-500 icon-border">
                        <i class="fab fa-instagram fa-lg fs-2" id="instagram"></i>
                    </a>
                    <a href="#" aria-label="Twitter" class="hover:text-blue-400 icon-border">
                        <i class="fab fa-twitter fa-lg fs-2" id="twitter"></i>
                    </a>
                </div>
            </div>

            <!-- COLONNA 3: Lavora con noi (ora allineata) -->
            <div class="col-12 col-md-4">
                @auth
                    <h3 class="mb-3">{{ __('ui.work_with_us') }}</h3>
                    @if (Auth::user()->is_revisor == false)
                    <p class="fw-bold mb-4">{{ __('ui.call_to_action') }}</p>
                    <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#revisorRequestModal">
                        {{ __('ui.work_with_us') }}
                    </button>
                    @else
                    <p class="mt-5 fs-5 fw-bold ca">{{ __('ui.already_revisor') }}</p>
                    @endif
                @endauth
                @guest
                    <h3 class="mb-3">{{ __('ui.work_with_us') }}</h3>
                    <p class="fw-bold mb-4">{{ __('ui.call_to_action') }}</p>
                    <a href="{{ route('login') }}" class="btn btn-custom">{{ __('ui.work_with_us') }}<a>
                @endguest
            </div>

        </div> <!-- Chiusura .row -->
    </div> <!-- Chiusura .container -->
</footer>