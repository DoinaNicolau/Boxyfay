
 
  @auth
<div class="modal fade" id="revisorRequestModal" tabindex="-1" aria-labelledby="revisorRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content box-article">
            <div class="modal-header">
                <h5 class="modal-title ts" id="revisorRequestModalLabel">{{__('ui.send_application')}}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- Questo è il form che viene INVIATO --}}
            <form action="{{ route('revisor.submit') }}" method="POST">
                @csrf
                
                <div class="modal-body">
                    <p>{{__('ui.request_become_revisor')}}.</p>
                    <ul class="list-unstyled">
                        <li><strong>{{__('ui.name')}}:</strong> {{ Auth::user()->name }}</li>
                        <li><strong>{{__('ui.email')}}:</strong> {{ Auth::user()->email }}</li>
                    </ul>
                    <div class="form-group mt-4">
                        <label for="presentation">{{__('ui.why_become_revisor')}}</label>
                        <textarea name="presentation" id="presentation" class="form-control search-bar-custom cs mt-2" rows="3" placeholder="Parlaci un po' di te..."></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-custom-danger" data-bs-dismiss="modal">{{__('ui.cancel')}}</button>
                    {{-- Questo pulsante INVIA IL FORM perché è di tipo "submit" --}}
                    <button type="submit" class="btn-custom">{{__('ui.confirm_and_send')}}</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endauth
 
