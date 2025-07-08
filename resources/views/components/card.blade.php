 <a data-loader class="text-decoration-none cs" href="{{ route('article.show', $article) }}">

     <div class="card">
         <div class="card-inner">
             <div class="card-front">

                 <img src="{{ $article->images->isNotEmpty() ? $article->images->first()->getUrl(600, 600) : 'https://picsum.photos/300/300' }}"
                     class="img-card" alt="Immagine dell'articolo {{ $article->title }}">
             </div>

             <div class="card-back d-flex flex-column justify-content-center bg-cp fs-4 ">
                 <div>
                     <h5 class="card__title text-center my-3 border-bottom pb-3">{{ $article->title }}</h5>
                     <div class="text-center my-3">
                         <h4 class="fw-bold">{{ __('ui.prezzo') }}</h4>
                         <p>{{ $article->price }}€</p>
                     </div>

                     <div class="text-center my-3">
                         <h4 class="fw-bold">{{ __('ui.categoria') }}</h4>
                         <p>{{ __('ui.' . $article->category->translation_key) }}</p>

                     </div>


                 </div>


             </div>
         </div>
     </div>
 </a>
