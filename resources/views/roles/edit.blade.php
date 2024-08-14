<!-- Edit Role Modal -->
<div class="modal fade" id="editRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="role-title mb-2">{{ __('edit_role') }}</h3>
                    <p class="text-muted">{{ __('update_role_permissions') }}</p>
                </div>
                <!-- Edit role form -->
                <form id="editRoleForm" action="{{ route('roles.update', $role->id) }}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editRoleId" name="role_id" />
                    <div class="col-12 mb-4">
                        <label class="form-label" for="editRoleName">{{ __('role_name') }}</label>
                        <input type="text" id="editRoleName" name="name" class="form-control"
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
                                                <input class="form-check-input" type="checkbox" id="editSelectAll" />
                                                <label class="form-check-label" for="editSelectAll">
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
                                                        id="edit-permission-{{ $permission->id }}" {{--  {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />  --}}
                                                        <label class="form-check-label"
                                                        for="edit-permission-{{ $permission->id }}">
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
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            aria-label="Close">{{ __('cancel') }}</button>
                    </div>
                </form>
                <!--/ Edit role form -->
            </div>
        </div>
    </div>
</div>
<!--/ Edit Role Modal -->

<script>
    document.getElementById('editSelectAll').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('#editRoleModal .form-check-input:not(#editSelectAll)');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    function openEditRoleModal(roleId, roleName, permissions) {
        document.querySelector('#editRoleModal form').action = `{{ route('roles.update', $role->id) }}`;
        document.getElementById('editRoleName').value = roleName;
        const checkboxes = document.querySelectorAll('#editRoleModal .form-check-input[name="permissions[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = permissions.includes(parseInt(checkbox.value));
        });
        var editRoleModal = new bootstrap.Modal(document.getElementById('editRoleModal'));
        editRoleModal.show();
    }
</script>
