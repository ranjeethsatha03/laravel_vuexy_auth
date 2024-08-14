@if (auth()->check())
    @php
        $canViewRole = auth()->user()->hasPermission('view role');
        $canViewUser = auth()->user()->hasPermission('view user');
    @endphp  

    @if ($canViewRole || $canViewUser)
        <x-app-web-layout>
            @section('title', 'Roles and Users - Apps')

            @section('vendor-style')
                <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
                <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
                <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
            @endsection

            @section('page-script')
                <script src="{{ asset('assets/js/app-access-roles.js') }}"></script>
                <script src="{{ asset('assets/js/modal-add-role.js') }}"></script>
            @endsection

            @section('content')
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                @if ($canViewRole)
                    <h4 class="fw-semibold mb-4">{{ __('Roles_List') }}</h4>
                    <p class="mb-4">
                        {{ __('a_role_provides_access_to_predefined_menus_and_features_so_that_depending_on_the_assigned_role_an_administrator_can_have_access_to_what_a_user_needs') }}
                    </p>

                    <!-- Role cards -->
                    <div class="row g-4">
                        @foreach ($roles as $role)
                            <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="fw-normal mb-2">{{ __('total_4_users') }}</h6>
                                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                                <!-- Avatars here, just placeholders -->
                                                @foreach ($role->users as $user)
                                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                                        title="{{ $user->name }}" class="avatar avatar-sm pull-up">
                                                        <img class="rounded-circle" src="{{ asset('assets/img/avatars/1.png') }}"
                                                            alt="Avatar">
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                                    title="{{ $user->name }}" class="avatar avatar-sm pull-up">
                                                    <img class="rounded-circle" src="{{ asset('assets/img/avatars/2.png') }}"
                                                        alt="Avatar">
                                                </li>
                                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                                title="{{ $user->name }}" class="avatar avatar-sm pull-up">
                                                <img class="rounded-circle" src="{{ asset('assets/img/avatars/3.png') }}"
                                                    alt="Avatar">
                                            </li>
                                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="{{ $user->name }}" class="avatar avatar-sm pull-up">
                                            <img class="rounded-circle" src="{{ asset('assets/img/avatars/4.png') }}"
                                                alt="Avatar">
                                        </li>
                                                @endforeach
                                            </ul>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-end mt-1">
                                            <div class="role-heading">
                                                <h4 class="mb-1">{{ ucfirst($role->name) }}</h4>
                                                @if (auth()->user()->hasPermission('update role'))
                                                    <a href="{{ url('roles/' . $role->id . '/edit') }}" data-bs-toggle="modal"
                                                        data-bs-target="#editRoleModal" class="role-edit-modal"
                                                        style="margin-right: 8rem;"
                                                        onclick="openEditRoleModal('{{ $role->id }}', '{{ $role->name }}', [{{ implode(',', $role->permissions->pluck('id')->toArray()) }}])">
                                                        <span>{{ __('edit_role') }}</span></a>
                                                @endif
                                                @if (auth()->user()->hasPermission('delete role'))
                                                    <a href="{{ url('roles/' . $role->id . '/delete') }}" class="role-edit-modal"
                                                        style="color: red !important;"> Delete </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if (auth()->user()->hasPermission('create role'))
                            <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="card h-100">
                                    <div class="row h-100">
                                        <div class="col-sm-3">
                                            <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                                                <img src="{{ asset('assets/img/illustrations/page-misc-error.png') }}"
                                                    class="img-fluid mt-sm-4 mt-md-0" alt="add-new-roles" width="83">
                                            </div>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="card-body text-sm-end text-center ps-sm-0">
                                                <button data-bs-target="#addRoleModal" data-bs-toggle="modal"
                                                    class="btn btn-primary mb-2 text-nowrap add-new-role">{{ __('add_new_role') }}</button>
                                                <p class="mb-0 mt-1">{{ __('add_role_if_it_does_not_exist') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif

                @if ($canViewUser)
                    <div class="col-12">
                        <!-- User Table -->
                        @if (auth()->user()->hasPermission('create user'))
                            <a href="{{ url('users/create') }}" class="btn btn-primary float-end">{{ __('add_user') }}</a>
                        @endif
                        <h4 class="fw-semibold mt-4 mb-4">{{ __('users_list') }}</h4>
                        <div class="card">
                            <div class="card-datatable table-responsive">
                                <table class="datatables-users table border-top">
                                    <thead>
                                        <tr>
                                            <th class="text-left px-4 py-2">{{ __('id') }}</th>
                                            <th class="text-left px-4 py-2">{{ __('user') }}</th>
                                            <th class="text-left px-4 py-2">{{ __('email') }}</th>
                                            <th class="text-left px-4 py-2">{{ __('role') }}</th>
                                            <th class="text-left px-4 py-2">{{ __('action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="text-left px-4 py-2">{{ $user->id }}</td>
                                                <td class="text-left px-4 py-2">{{ $user->name }}</td>
                                                <td class="text-left px-4 py-2">{{ $user->email }}</td>
                                                <td class="text-left px-4 py-2">
                                                    @foreach ($user->getRoleNames() as $rolename)
                                                        <label class="badge bg-primary mx-1">{{ $rolename }}</label>
                                                    @endforeach
                                                </td>
                                                <td class="text-left px-4 py-2">
                                                    @if (auth()->user()->hasPermission('update user') || auth()->user()->hasPermission('delete user'))
                                                        <button type="button"
                                                            class="btn rounded-pill btn-outline-primary waves-effect dropdown-toggle"
                                                            data-bs-toggle="dropdown"
                                                            aria-expanded="false">{{ __('action') }}</button>

                                                        <ul class="dropdown-menu">
                                                            @if (auth()->user()->hasPermission('update user'))
                                                                <li><a class="dropdown-item"
                                                                        href="{{ url('users/' . $user->id . '/edit') }}">{{ __('edit') }}</a>
                                                                </li>
                                                            @endif
                                                            @if (auth()->user()->hasPermission('delete user'))
                                                                <li><a class="dropdown-item"
                                                                        href="{{ url('users/' . $user->id . '/delete') }}">{{ __('delete') }}</a>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Add Role Modal -->
                @if ($canViewRole)
                    @include('roles.create')
                    @include('roles.edit')
                @endif
                <!-- / Add Role Modal -->

            @endsection
        </x-app-web-layout>
    @else
        <script>
            window.location.href = "{{ route('dashboard') }}";
        </script>
    @endif  
@endif
