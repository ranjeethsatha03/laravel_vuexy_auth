/**
 * Add new role Modal JS
 * Adapted for Edit Role Modal
 */

'use strict';

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    // Add role form validation
    FormValidation.formValidation(document.getElementById('addRoleForm'), {
      fields: {
        modalRoleName: {
          validators: {
            notEmpty: {
              message: 'Please enter role name'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          eleValidClass: '',
          rowSelector: '.col-12'
        }),
        submitButton: new FormValidation.plugins.SubmitButton(),
        autoFocus: new FormValidation.plugins.AutoFocus()
      }
    });

    // Edit role form validation
    FormValidation.formValidation(document.getElementById('editRoleForm'), {
      fields: {
        editRoleName: {
          validators: {
            notEmpty: {
              message: 'Please enter role name'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          eleValidClass: '',
          rowSelector: '.col-12'
        }),
        submitButton: new FormValidation.plugins.SubmitButton(),
        autoFocus: new FormValidation.plugins.AutoFocus()
      }
    });

    // Select All checkbox click for Add Role
    const selectAllAdd = document.querySelector('#selectAll'),
      checkboxListAdd = document.querySelectorAll('#addRoleModal [type="checkbox"]');
    selectAllAdd.addEventListener('change', t => {
      checkboxListAdd.forEach(e => {
        e.checked = t.target.checked;
      });
    });

    // Select All checkbox click for Edit Role
    const selectAllEdit = document.querySelector('#editSelectAll'),
      checkboxListEdit = document.querySelectorAll('#editRoleModal [type="checkbox"]');
    selectAllEdit.addEventListener('change', t => {
      checkboxListEdit.forEach(e => {
        e.checked = t.target.checked;
      });
    });
  })();
});
