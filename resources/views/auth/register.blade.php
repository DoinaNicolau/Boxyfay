<x-layout>
    <div class="wrapper"></div>
    <div class="ecommerce-icons"></div>

    <div class="container2 d-flex justify-content-center pt-5">
        <div class="form-container">
            <div class="row  justify-content-center">
                <div class="col-12 d-flex justify-content-center align-items-center flex-column"> <svg width="100"
                        height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" class="me-2">
                        <g stroke="currentColor" stroke-width="5" fill="none" stroke-linejoin="round"
                            stroke-linecap="round">
                            <path d="M50 15 L85 32.5 L85 67.5 L50 85 L15 67.5 L15 32.5 Z" />
                            <path d="M15 32.5 L50 50 L85 32.5" />
                            <path d="M50 50 L50 85" />
                        </g>
                        <polygon points="15,32.5 50,50 50,15 15,32.5" fill="#73bd61" stroke="#73bd61" stroke-width="5"
                            stroke-linejoin="round" />
                    </svg>
                    <span class="logo-nav fw-bold fs-1">Boxyfay</span>
                </div>
                <div class="col-12 justify-content-center  ">
                    <form data-loader action="{{ route('register') }}" method="POST" class="p-4">
                        @csrf

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="mb-3 form-header">
                            <h2 class="cs mb-3 text-center">✨{{ __('ui.register') }}✨</h2>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">👤{{ __('ui.name') }}</label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ old('name') }}" placeholder="{{ __('ui.name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">📧{{ __('ui.email') }}</label>
                            <input type="email" id="email" name="email" class="form-control"
                                value="{{ old('email') }}" placeholder="{{ __('ui.email') }}" required>
                            @error('email')
                                <span class="text-danger fst-italic d-block mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">🔒{{ __('ui.password') }}</label>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="{{ __('ui.password') }} " required>
                            @error('password')
                                <span class="text-danger fst-italic d-block mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation"
                                class="form-label">🔐{{ __('ui.password_confirmation') }}</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" placeholder="{{ __('ui.password_confirmation') }}" required>
                        </div>
                        <div>
                            <button type="submit" class="btn submit-btn mb-3">{{ __('ui.register') }}</button>
                        </div>
                        <p class="cs">{{ __('ui.already_registered') }} <a href="{{ route('login') }}"
                                class="ca">{{ __('ui.login') }}</a>
                        </p>
                        <div class="benefits-section">
                            <div class="benefits-title">✨ Vantaggi Membri</div>
                            <div class="benefits-list d-flex justify-content-evenly flex-wrap">
                                <div class="benefit-item">🚚 Spedizione Gratuita</div>
                                <div class="benefit-item">💳 Pagamenti Sicuri</div>
                                <div class="benefit-item">🎁 Offerte Esclusive</div>
                                <div class="benefit-item">📞 Supporto 24/7</div>
                                <div class="benefit-item">🔄 Resi Facili</div>
                                <div class="benefit-item">⭐ Punti Fedeltà</div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="video-bg-wave">
        <video autoplay muted loop playsinline>
            <source src="{{ asset('media/glass-wave.mp4') }}" type="video/mp4">
        </video>
    </div>
</x-layout>
