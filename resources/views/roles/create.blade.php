<!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="role-title mb-2">{{ __('add_role') }}</h3>
                    <p class="text-muted">{{ __('set_role_permissions') }}</p>
                </div>
                <!-- Add role form -->
                <form action="{{ route('roles.store') }}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-12 mb-4">
                        <label class="form-label" for="modalRoleName">{{ __('role_name') }}</label>
                        <input type="text" id="modalRoleName" name="name" class="form-control"
                            placeholder="{{ __('enter_a_role_name') }}" required />
                    </div>
                    <div class="col-12">
                        <h5>{{ __('role_permissions') }}</h5>
                        <!-- Permission table -->
                        <div class="table-responsive">
                            <table class="table table-flush-spacing">
                                <tbody>
                                    <tr>
                                        <td class="text-nowrap fw-semibold"></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="selectAll" />
                                                <label class="form-check-label" for="selectAll">
                                                    {{ __('select_all') }}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td class="text-nowrap fw-semibold">{{ ucfirst($permission->name) }}</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                                        value="{{ $permission->id }}"
                                                        id="permission-{{ $permission->id }}" />
                                                    <label class="form-check-label"
                                                        for="permission-{{ $permission->id }}">
                                                        {{ ucfirst($permission->name) }}
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Permission table -->
                    </div>
                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">{{ __('submit') }}</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            aria-label="Close">{{ __('cancel') }}</button>
                    </div>
                </form>
                <!--/ Add role form -->
            </div>
        </div>
    </div>
</div>
<!--/ Add Role Modal -->

<script>
    document.getElementById('selectAll').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('.form-check-input:not(#selectAll)');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
</script>
