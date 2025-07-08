<x-layout>

    <div class="wrapper"></div>
    <div class="container-fluid d-flex justify-content-center ">
        <div class="row w-75 justify-content-center">
            <div class="col-12 col-md-8 justify-content-center">
                <form action="{{ route('user.update') }}" method="post" class="box-article">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <h2 class="text-center cs mb-3">{{__('ui.edit_profile')}}</h2>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">{{__('ui.name')}}</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ Auth::user()->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{__('ui.Email')}}</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ Auth::user()->email }}">
                    </div>

                    <button type="submit" class="btn btn-custom mt-3">{{__('ui.edit_profile')}}</button>
                </form>
            </div>
        </div>
    </div>
<x-modale-revisor/>
</x-layout>
