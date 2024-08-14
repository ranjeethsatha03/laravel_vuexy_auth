<x-app-web-layout>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url('users') }}"
                            class="btn rounded-pill btn-outline-primary waves-effect float-end">{{ __('back') }}</a>

                        <h4> {{ __('create_user') }} </h4>


                        <div class="card-body">
                            <form action="{{ url('users') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="" class="mb-3"> {{ __('name') }} </label>
                                    <input type="text" name="name" class="form-control" required />
                                </div>
                                <div class="mb-3">
                                    <label for="" class="mb-3"> {{ __('email') }} </label>
                                    <input type="text" name="email" class="form-control" required />
                                </div>
                                <div class="mb-3">
                                    <label for="" class="mb-3"> {{ __('password') }} </label>
                                    <input type="text" name="password" class="form-control" required />
                                </div>
                                <div class="mb-3">
                                    <label for="" class="mb-3"> {{ __('role') }} </label>
                                    <select name="roles[]" class="form-control" multiple required>
                                        <option value="">{{ __('select_role') }}</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}">{{ $role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">{{ __('save') }}</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-web-layout>
