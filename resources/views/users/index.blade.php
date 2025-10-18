 
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
    /* نفس الـ CSS السابق */
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .user-table th { font-weight: 600; color: #6c757d; }
    .badge-custom { font-size: 0.75rem; padding: 6px 10px; border-radius: 20px; font-weight: 500; }
    .badge-admin { background: #d1e7dd; color: #0f5132; }
    .badge-export { background: #cfe2ff; color: #084298; }
    .badge-import { background: #f8d7da; color: #842029; }
    .table td { vertical-align: middle; }
    .content { margin: 40px; }
    .action { padding: 10px; border-radius: 4px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3); transition: all 0.3s ease; }
    .action:hover { background: #EC8305; color: white; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); transform: translateY(-4px); cursor: pointer; }
    a { text-decoration: none; color: black; }
    .actions { display: flex; flex-direction: row; flex-wrap: wrap; gap: 10px; justify-content: center; align-items: center; }
    .alert { display: none; }
  </style>
</head>

<body class="container py-5">

<div class="content">
  <!-- رسائل التنبيه -->
  <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
    <span id="successMessage"></span>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>

  <div id="errorAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
    <span id="errorMessage"></span>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>

  <!-- Header -->
  <div class="page-header">
    <h3>User Management</h3>
    <div class="action">
      <a data-bs-toggle="modal" data-bs-target="#addUserModal" href="#"> + Add User</a>
      
    </div>
     <div class="action">
     
     <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
    Go to Dashboard
</a>
    </div>
  </div>

  <!-- Search -->
  <div class="mb-3">
    <input type="text" class="form-control" placeholder="Search users...">
  </div>

  <!-- User Table -->
  <table class="table user-table align-middle">
    <thead>
      <tr>
        <th><input type="checkbox"></th>
        <th>User Name</th>
        <th>Role</th>
        <th>Last Active</th>
        <th>Date Added</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
        <tr data-user-id="{{ $user->id }}">
          <td><input type="checkbox"></td>
          <td>
            <strong>{{ $user->name }}</strong><br>
            <small class="text-muted">{{ $user->email }}</small>
          </td>
          <td>
            <span class="badge badge-custom 
              @if($user->role == 'admin') badge-admin 
              @elseif($user->role == 'supervisor') badge-export 
              @else badge-import @endif">
              {{ $user->role }}
            </span>
          </td>
          <td>{{ $user->updated_at->format('M d, Y') }}</td>
          <td>{{ $user->created_at->format('M d, Y') }}</td>
          <td>
            <button class="btn btn-sm btn-outline-secondary view-user-btn" data-user-id="{{ $user->id }}">⋮</button>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form id="addUserForm" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Full Name *</label>
            <input type="text" class="form-control" name="name" required>
            <div class="invalid-feedback" id="nameError"></div>
          </div>
          <div class="mb-3">
            <label class="form-label">Email *</label>
            <input type="email" class="form-control" name="email" required>
            <div class="invalid-feedback" id="emailError"></div>
          </div>
          <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone">
            <div class="invalid-feedback" id="phoneError"></div>
          </div>
          <div class="mb-3">
            <label class="form-label">Role *</label>
            <select class="form-select" name="role" required>
              <option value="" selected disabled>Select Role</option>
              <option value="admin">admin</option>
              <option value="supervisor">supervisor</option>
              <option value="user">user</option>
            </select>
            <div class="invalid-feedback" id="roleError"></div>
          </div>
          <div class="mb-3">
            <label class="form-label">Password *</label>
            <input type="password" class="form-control" name="password" required>
            <div class="invalid-feedback" id="passwordError"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form id="editUserForm" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" id="editUserId">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Full Name *</label>
            <input type="text" class="form-control" name="name" id="editName" required>
            <div class="invalid-feedback" id="editNameError"></div>
          </div>
          <div class="mb-3">
            <label class="form-label">Email *</label>
            <input type="email" class="form-control" name="email" id="editEmail" required>
            <div class="invalid-feedback" id="editEmailError"></div>
          </div>
          <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone" id="editPhone">
            <div class="invalid-feedback" id="editPhoneError"></div>
          </div>
          <div class="mb-3">
            <label class="form-label">Role *</label>
            <select class="form-select" name="role" id="editRole" required>
              <option value="admin">admin</option>
              <option value="supervisor">supervisor</option>
              <option value="user">user</option>
            </select>
            <div class="invalid-feedback" id="editRoleError"></div>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="editPassword" placeholder="Leave blank to keep current password">
            <div class="invalid-feedback" id="editPasswordError"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    const editModal = new bootstrap.Modal(document.getElementById('editUserModal'));
    const addModal = new bootstrap.Modal(document.getElementById('addUserModal'));

    // دالة لعرض الرسائل
    function showAlert(type, message) {
        if (type === 'success') {
            $('#successMessage').text(message);
            $('#successAlert').show();
            $('#errorAlert').hide();
        } else {
            $('#errorMessage').text(message);
            $('#errorAlert').show();
            $('#successAlert').hide();
        }
        
        // إخفاء الرسائل تلقائياً بعد 5 ثواني
        setTimeout(() => {
            $('.alert').hide();
        }, 5000);
    }

    // إخفاء الأخطاء عند إغلاق المودال
    $('.modal').on('hidden.bs.modal', function () {
        $('.invalid-feedback').text('');
        $('.form-control, .form-select').removeClass('is-invalid');
        $(this).find('form')[0].reset();
    });

    // فتح modal التعديل
    $('.view-user-btn').click(function() {
        const userId = $(this).data('user-id');
        
        $.get(`/users/${userId}/edit`, function(user) {
            $('#editUserId').val(user.id);
            $('#editName').val(user.name);
            $('#editEmail').val(user.email);
            $('#editPhone').val(user.phone || '');
            $('#editRole').val(user.role);
            $('#editPassword').val('');
            
            $('#editUserForm').attr('action', `/users/${userId}`);
            editModal.show();
        }).fail(function(xhr) {
            showAlert('error', 'Error loading user data: ' + xhr.responseJSON?.message);
        });
    });

    // إرسال نموذج التعديل
    $('#editUserForm').submit(function(e) {
        e.preventDefault();
        
        const formData = $(this).serialize();
        const url = $(this).attr('action');
        
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    editModal.hide();
                    showAlert('success', response.message);
                    setTimeout(() => location.reload(), 1000);
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    // عرض أخطاء التحقق
                    const errors = xhr.responseJSON.errors;
                    $('.invalid-feedback').text('');
                    $('.form-control, .form-select').removeClass('is-invalid');
                    
                    for (const field in errors) {
                        $(`#edit${field.charAt(0).toUpperCase() + field.slice(1)}Error`).text(errors[field][0]);
                        $(`#edit${field.charAt(0).toUpperCase() + field.slice(1)}`).addClass('is-invalid');
                    }
                } else {
                    showAlert('error', xhr.responseJSON?.message || 'Error updating user');
                }
            }
        });
    });

    // إرسال نموذج الإضافة
    $('#addUserForm').submit(function(e) {
        e.preventDefault();
        
        const formData = $(this).serialize();
        
        $.ajax({
            url: '{{ route("users.store") }}',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    addModal.hide();
                    showAlert('success', response.message);
                    setTimeout(() => location.reload(), 1000);
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    // عرض أخطاء التحقق
                    const errors = xhr.responseJSON.errors;
                    $('.invalid-feedback').text('');
                    $('.form-control, .form-select').removeClass('is-invalid');
                    
                    for (const field in errors) {
                        $(`#${field}Error`).text(errors[field][0]);
                        $(`[name="${field}"]`).addClass('is-invalid');
                    }
                } else {
                    showAlert('error', xhr.responseJSON?.message || 'Error adding user');
                }
            }
        });
    });
});
</script>

</body>
</html>
 