<x-app-web-layout>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url('users') }}" class="btn rounded-pill btn-outline-primary waves-effect float-end">
                            {{ __('back') }} </a>
                        <h4> {{ __('edit_user') }} </h4>
                        <div class="card-body">
                            <form action="{{ url('users/' . $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="" class="mb-3"> {{ __('name') }} </label>
                                    <input type="text" name="name" value="{{ $user->name }}"
                                        class="form-control" />
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="mb-3"> {{ __('email') }} </label>
                                    <input type="text" name="email" readonly value="{{ $user->email }}"
                                        class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="" class="mb-3"> {{ __('password') }} </label>
                                    <input type="text" name="password" class="form-control" />
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="mb-3"> {{ __('role') }} </label>
                                    <select name="roles[]" class="form-control" multiple>
                                        <option value="">{{ __('select_role') }}</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}"
                                                {{ in_array($role, $userRoles) ? 'selected' : '' }}>
                                                {{ $role }}</option>
                                        @endforeach
                                    </select>
                                    @error('roles')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">{{ __('update') }}</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-web-layout>
