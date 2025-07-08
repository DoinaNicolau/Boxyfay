<x-layout>

    <div class="ecommerce-icons"></div>
    <div class="container2 pt-5 d-flex justify-content-center  ">
        <div class="form-container">


            <div class="row justify-content-center">
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
                <div class="col-12 justify-content-center">
                    <form data-loader action="{{ route('login') }}" method="POST" class="p-4">
                        @csrf
                        <div class="mb-3">
                            <h2 class=" text-center cs mb-3">✨{{ __('ui.login') }}✨</h2>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">📧{{ __('ui.email') }}</label>
                            <input type="email" id="email" name="email" class="form-control"
                                value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger fst-italic d-block mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">🔒{{ __('ui.password') }}</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                            @error('password')
                                <span class="text-danger fst-italic d-block mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">{{ __('ui.remember_me') }}</label>
                        </div>
                        <button type="submit" class="btn submit-btn mb-3">{{ __('ui.login') }}</button>

                        <p class="cs">{{ __('ui.no_account') }} <a href="{{ route('register') }}"
                                class="ca">{{ __('ui.register') }}</a></p>
                    </form>
                    <div class="mb-3 border-top d-flex flex-column align-items-center">
                        <h4 class="text-center cs my-3">✨{{ __('ui.or_login_with') }}✨</h4>
                        <a href="{{ route('google.login') }}" class="rounded-5 btn-light "
                            style="text-decoration: none;">
                            <img class="rounded-5 bg-light p-2  "
                                src="https://developers.google.com/identity/images/g-logo.png" alt="Google logo"
                                style="width:60px; height:60px;">
                            {{-- <span class="text-dark">Accedi con Google</span> --}}
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="video-bg-wave">
        <video autoplay muted loop playsinline>
            <source class="h-100" src="{{ asset('media/glass-wave.mp4') }}" type="video/mp4">
        </video>
    </div>

</x-layout>
