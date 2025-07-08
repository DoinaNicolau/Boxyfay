<div>
    <form data-loader wire:submit="store" class="box-article bg-article my-5">

        <div class="mb-3">
            <h3 class="text-center">{{ __('ui.insert_article') }}</h3>
        </div>

        {{-- SECTION 1: ARTICLE DETAILS --}}

        {{-- Titolo --}}
        <div class="mb-3">
            <label for="title" class="form-label">{{ __('ui.title') }}</label>
            <input type="text" class="form-control" id="title" wire:model.blur="title" placeholder="{{ __('ui.insert_title') }}">
            @error('title')
                <span class="text-danger fst-italic d-block mt-2">{{ $message }}</span>
            @enderror
        </div>

        {{-- Prezzo --}}
        <div class="mb-3">
            <label for="price" class="form-label">{{ __('ui.prezzo') }}</label>
            <input type="number" class="form-control" id="price" wire:model.blur="price" placeholder="{{ __('ui.insert_price') }}">
            @error('price')
                <span class="text-danger fst-italic d-block mt-2">{{ $message }}</span>
            @enderror
        </div>

        {{-- Categoria --}}
        <div class="mb-3">
            <label for="category" class="form-label">{{ __('ui.categoria') }}</label>
            <select class="form-select" id="category" wire:model.blur="category_id">
                <option selected>{{ __('ui.select_category') }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" class="cp">{{ __("ui.$category->name") }}</option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text-danger fst-italic d-block mt-2">{{ $message }}</span>
            @enderror
        </div>

        {{-- Descrizione --}}
        <div class="mb-3">
            <label for="description" class="form-label">{{ __('ui.description') }}</label>
            <textarea class="form-control" id="description" rows="3" wire:model.blur="description" placeholder="{{ __('ui.insert_description') }}"></textarea>
            @error('description')
                <span class="text-danger fst-italic d-block mt-2">{{ $message }}</span>
            @enderror
        </div>

        {{-- SECTION 2: IMAGE UPLOAD & PREVIEW --}}


        {{-- Input per l'upload --}}
        <div class="mb-3">
            <label for="image" class="form-label">{{ __('ui.upload_images') }}</label>
            <input id="image" type="file" wire:model.live="temporary_images" multiple
                class="form-control shadow @error('temporary_images.*') is-invalid @enderror" />
            @error('temporary_images.*')
                <p class="text-danger mt-2">{{ $message }}</p>
            @enderror
            @error('temporary_images')
                <p class="text-danger mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Sezione Anteprima --}}
        @if (!empty($images))
            <div class="row rounded shadow py-4 my-3">
                <div class="col-12">
                    <p><strong>{{ __('ui.photo_preview') }}</strong></p>
                </div>

                @foreach ($images as $key => $image)
                    <div class="col-12 col-md-4 my-3 d-flex flex-column align-items-center">
                        <div class="img-preview-square mx-auto shadow rounded"
                            style="background-image: url('{{ $image->temporaryUrl() }}');">
                        </div>
                        <button type="button" class="btn mt-2 btn-custom-danger"
                            wire:click="removeImage({{ $key }})"><i class="fas fa-times"></i></button>
                    </div>
                @endforeach

            </div>
        @endif
        {{-- Fine Sezione Anteprima --}}

        {{-- SECTION 3: SUBMIT BUTTON --}}
        <button type="submit" class="btn btn-custom w-100 my-3">
            <div wire:loading.remove wire:target="store">
                {{ __('ui.upload_article') }}
            </div>
            <div wire:loading wire:target="store">
                {{ __('ui.loading') }}...
            </div>
        </button>

    </form>
</div>
