@extends('layouts.app')

@section('title', 'Manajemen Admin')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/manajemen-admin.css') }}">

    <div class="manajemen-admin-container">
        <div class="page-header mb-2">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-title">Manajemen Admin</h1>
                    <p class="page-subtitle">Kelola data administrator sistem</p>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahAdminModal">
                        <i class="fas fa-plus me-2"></i>Tambah Admin
                    </button>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stat-card primary">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $admins->count() + 1 }}</h3>
                        <p class="stat-label">Total Admin</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card success">
                    <div class="stat-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $admins->where('created_at', '>=', now()->subMonth())->count() }}</h3>
                        <p class="stat-label">Admin Baru (30 hari)</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card warning">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $admins->where('updated_at', '>=', now()->subWeek())->count() }}</h3>
                        <p class="stat-label">Diperbarui (7 hari)</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card info">
                    <div class="stat-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">1</h3>
                        <p class="stat-label">Anda Login</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="admin-table-card">
            <div class="card-header">
                <div class="header-content">
                    <i class="fas fa-list header-icon"></i>
                    <div>
                        <h3 class="card-title">Daftar Administrator</h3>
                        <p class="card-subtitle">Kelola semua akun administrator sistem</p>
                    </div>
                </div>
                <div class="header-actions">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" placeholder="Cari admin...">
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="adminsTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Admin</th>
                                <th>Kontak</th>
                                <th>Tanggal Dibuat</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="current-user">
                                <td>
                                    <div class="admin-avatar">
                                        @if (Auth::guard('admin')->user()->foto_profil)
                                            <img src="{{ asset('images/photo/' . Auth::guard('admin')->user()->foto_profil) }}"
                                                alt="Profile">
                                        @else
                                            <div class="avatar-placeholder">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="admin-info">
                                        <h6 class="admin-name">{{ Auth::guard('admin')->user()->nama_lengkap }}</h6>
                                        <span class="admin-email">{{ Auth::guard('admin')->user()->email }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="contact-info">
                                        <span class="phone">{{ Auth::guard('admin')->user()->nomor_telepon ?? '-' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span
                                        class="date">{{ Auth::guard('admin')->user()->created_at->format('d M Y') }}</span>
                                </td>
                                <td>
                                    <span class="badge badge-current">Anda</span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-outline-primary"
                                            onclick="editAdmin({{ Auth::guard('admin')->user()->id }})" disabled
                                            title="Edit profil melalui Pengaturan">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" disabled
                                            title="Tidak dapat menghapus akun sendiri">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            @foreach ($admins as $admin)
                                <tr data-admin-id="{{ $admin->id }}">
                                    <td>
                                        <div class="admin-avatar">
                                            @if ($admin->foto_profil)
                                                <img src="{{ asset('images/photo/' . $admin->foto_profil) }}"
                                                    alt="Profile">
                                            @else
                                                <div class="avatar-placeholder">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="admin-info">
                                            <h6 class="admin-name">{{ $admin->nama_lengkap }}</h6>
                                            <span class="admin-email">{{ $admin->email }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="contact-info">
                                            <span class="phone">{{ $admin->nomor_telepon ?? '-' }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="date">{{ $admin->created_at->format('d M Y') }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-active">Aktif</span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn btn-sm btn-edit" onclick="editAdmin({{ $admin->id }})"
                                                title="Edit Admin">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-password"
                                                onclick="changePassword({{ $admin->id }})" title="Ubah Password">
                                                <i class="fas fa-key"></i>
                                            </button>
                                            <button class="btn btn-sm btn-delete"
                                                onclick="deleteAdmin({{ $admin->id }})" title="Hapus Admin">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            @if ($admins->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                            <h5>Belum ada admin lainnya</h5>
                                            <p class="text-muted">Tambahkan admin baru untuk mengelola sistem bersama.</p>
                                            <button class="btn btn-primary mt-2" data-bs-toggle="modal"
                                                data-bs-target="#tambahAdminModal">
                                                <i class="fas fa-plus me-2"></i>Tambah Admin Pertama
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahAdminModal" tabindex="-1" aria-labelledby="tambahAdminModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahAdminModalLabel">
                        <i class="fas fa-user-plus me-2"></i>Tambah Admin Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="tambahAdminForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <div class="profile-picture-upload">
                                    <div class="upload-wrapper">
                                        <div class="upload-placeholder" id="tambahUploadPreview">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="upload-overlay">
                                            <i class="fas fa-camera"></i>
                                            <span>Tambahkan Foto</span>
                                        </div>
                                        <input type="file" name="foto_profil" id="tambahFotoProfil"
                                            class="upload-input" accept="image/*">
                                    </div>
                                    <small class="text-muted mt-2 d-block">Opsional</small>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="tambahNamaLengkap" class="form-label">Nama Lengkap *</label>
                                    <input type="text" class="form-control" id="tambahNamaLengkap"
                                        name="nama_lengkap" required>
                                    <div class="invalid-feedback" id="tambahNamaLengkap_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="tambahEmail" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="tambahEmail" name="email" required>
                                    <div class="invalid-feedback" id="tambahEmail_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="tambahNomorTelepon" class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="tambahNomorTelepon"
                                        name="nomor_telepon">
                                    <div class="invalid-feedback" id="tambahNomorTelepon_error"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tambahPassword" class="form-label">Password *</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="tambahPassword"
                                                    name="password" required>
                                                <button type="button" class="btn btn-outline-secondary toggle-password">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                            <div class="invalid-feedback" id="tambahPassword_error"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tambahPasswordConfirmation" class="form-label">Konfirmasi Password
                                                *</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control"
                                                    id="tambahPasswordConfirmation" name="password_confirmation" required>
                                                <button type="button" class="btn btn-outline-secondary toggle-password">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                            <div class="invalid-feedback" id="tambahPasswordConfirmation_error"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="tambahAdminBtn">
                            <i class="fas fa-save me-2"></i>Simpan Admin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="editAdminModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAdminModalLabel">
                        <i class="fas fa-user-edit me-2"></i>Edit Data Admin
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editAdminForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editAdminId" name="id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <div class="profile-picture-upload">
                                    <div class="upload-wrapper">
                                        <div class="upload-placeholder" id="editUploadPreview">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="upload-overlay">
                                            <i class="fas fa-camera"></i>
                                            <span>Ubah Foto</span>
                                        </div>
                                        <input type="file" name="foto_profil" id="editFotoProfil"
                                            class="upload-input" accept="image/*">
                                    </div>
                                    <small class="text-muted mt-2 d-block">Klik untuk mengubah foto</small>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="editNamaLengkap" class="form-label">Nama Lengkap *</label>
                                    <input type="text" class="form-control" id="editNamaLengkap" name="nama_lengkap"
                                        required>
                                    <div class="invalid-feedback" id="editNamaLengkap_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="editEmail" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="editEmail" name="email" required>
                                    <div class="invalid-feedback" id="editEmail_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="editNomorTelepon" class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="editNomorTelepon"
                                        name="nomor_telepon">
                                    <div class="invalid-feedback" id="editNomorTelepon_error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="editAdminBtn">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">
                        <i class="fas fa-key me-2"></i>Ubah Password Admin
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="changePasswordForm">
                    @csrf
                    <input type="hidden" id="passwordAdminId" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="newPassword" class="form-label">Password Baru *</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="newPassword" name="password" required>
                                <button type="button" class="btn btn-outline-secondary toggle-password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="invalid-feedback" id="newPassword_error"></div>
                        </div>
                        <div class="form-group">
                            <label for="newPasswordConfirmation" class="form-label">Konfirmasi Password Baru *</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="newPasswordConfirmation"
                                    name="password_confirmation" required>
                                <button type="button" class="btn btn-outline-secondary toggle-password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="invalid-feedback" id="newPasswordConfirmation_error"></div>
                        </div>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Password akan diubah untuk admin yang dipilih.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="changePasswordBtn">
                            <i class="fas fa-save me-2"></i>Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initManajemenAdmin();
        });

        function initManajemenAdmin() {
            initProfilePictureUpload();
            initFormSubmissions();
            initPasswordToggle();
            initSearch();
        }

        function initProfilePictureUpload() {
            const tambahUploadInput = document.getElementById('tambahFotoProfil');
            const tambahUploadPreview = document.getElementById('tambahUploadPreview');

            if (tambahUploadInput && tambahUploadPreview) {
                tambahUploadInput.addEventListener('change', function(e) {
                    handleImageUpload(e, tambahUploadPreview);
                });
            }

            const editUploadInput = document.getElementById('editFotoProfil');
            const editUploadPreview = document.getElementById('editUploadPreview');

            if (editUploadInput && editUploadPreview) {
                editUploadInput.addEventListener('change', function(e) {
                    handleImageUpload(e, editUploadPreview);
                });
            }
        }

        function handleImageUpload(event, previewElement) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (previewElement.classList.contains('upload-placeholder')) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = 'Profile Preview';
                        img.className = 'upload-preview';
                        previewElement.parentNode.replaceChild(img, previewElement);
                    } else {
                        previewElement.src = e.target.result;
                    }
                }
                reader.readAsDataURL(file);
            }
        }

        function initFormSubmissions() {
            const tambahAdminForm = document.getElementById('tambahAdminForm');
            if (tambahAdminForm) {
                tambahAdminForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    storeAdmin();
                });
            }

            const editAdminForm = document.getElementById('editAdminForm');
            if (editAdminForm) {
                editAdminForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    updateAdmin();
                });
            }

            const changePasswordForm = document.getElementById('changePasswordForm');
            if (changePasswordForm) {
                changePasswordForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    updateAdminPassword();
                });
            }
        }

        function initPasswordToggle() {
            const toggleButtons = document.querySelectorAll('.toggle-password');

            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.parentElement.querySelector('input');
                    const icon = this.querySelector('i');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });
        }

        function initSearch() {
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    const rows = document.querySelectorAll('#adminsTable tbody tr');

                    rows.forEach(row => {
                        if (row.classList.contains('current-user')) return;

                        const text = row.textContent.toLowerCase();
                        if (text.includes(searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }
        }

        function storeAdmin() {
            const form = document.getElementById('tambahAdminForm');
            const formData = new FormData(form);
            const submitBtn = document.getElementById('tambahAdminBtn');
            clearErrors('tambah');
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;

            fetch('{{ route('admin.manajemen-admin.store') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            bootstrap.Modal.getInstance(document.getElementById('tambahAdminModal')).hide();
                            form.reset();
                            resetProfilePreview('tambahUploadPreview');
                            window.location.reload();
                        });
                    } else {
                        showErrors(data.errors, 'tambah');
                        if (data.message && !data.errors) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: data.message
                            });
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat menambahkan admin.'
                    });
                })
                .finally(() => {
                    submitBtn.classList.remove('btn-loading');
                    submitBtn.disabled = false;
                });
        }

        function editAdmin(adminId) {
            const editAdminBtn = document.getElementById('editAdminBtn');
            editAdminBtn.classList.add('btn-loading');
            editAdminBtn.disabled = true;

            fetch(`/admin/manajemen-admin/${adminId}`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const admin = data.admin;
                        document.getElementById('editAdminId').value = admin.id;
                        document.getElementById('editNamaLengkap').value = admin.nama_lengkap;
                        document.getElementById('editEmail').value = admin.email;
                        document.getElementById('editNomorTelepon').value = admin.nomor_telepon || '';

                        const preview = document.getElementById('editUploadPreview');
                        if (admin.foto_profil) {
                            if (preview.classList.contains('upload-placeholder')) {
                                const img = document.createElement('img');
                                img.src = admin.foto_profil;
                                img.alt = 'Profile Preview';
                                img.className = 'upload-preview';
                                preview.parentNode.replaceChild(img, preview);
                            } else {
                                preview.src = admin.foto_profil;
                            }
                        } else {
                            resetProfilePreview('editUploadPreview');
                        }

                        const modal = new bootstrap.Modal(document.getElementById('editAdminModal'));
                        modal.show();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal memuat data admin.'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat memuat data admin.'
                    });
                })
                .finally(() => {
                    editAdminBtn.classList.remove('btn-loading');
                    editAdminBtn.disabled = false;
                });
        }

        function updateAdmin() {
            const form = document.getElementById('editAdminForm');
            const formData = new FormData(form);
            const adminId = document.getElementById('editAdminId').value;
            const submitBtn = document.getElementById('editAdminBtn');
            clearErrors('edit');
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;

            fetch(`/admin/manajemen-admin/${adminId}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-HTTP-Method-Override': 'PUT'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            bootstrap.Modal.getInstance(document.getElementById('editAdminModal')).hide();
                            window.location.reload();
                        });
                    } else {
                        showErrors(data.errors, 'edit');
                        if (data.message && !data.errors) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: data.message
                            });
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat memperbarui admin.'
                    });
                })
                .finally(() => {
                    submitBtn.classList.remove('btn-loading');
                    submitBtn.disabled = false;
                });
        }

        function changePassword(adminId) {
            document.getElementById('passwordAdminId').value = adminId;
            const modal = new bootstrap.Modal(document.getElementById('changePasswordModal'));
            modal.show();
        }

        function updateAdminPassword() {
            const form = document.getElementById('changePasswordForm');
            const formData = new FormData(form);
            const adminId = document.getElementById('passwordAdminId').value;
            const submitBtn = document.getElementById('changePasswordBtn');
            clearErrors();
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;

            fetch(`/admin/manajemen-admin/${adminId}/password`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            bootstrap.Modal.getInstance(document.getElementById('changePasswordModal')).hide();
                            form.reset();
                        });
                    } else {
                        showErrors(data.errors);
                        if (data.message && !data.errors) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: data.message
                            });
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat memperbarui password.'
                    });
                })
                .finally(() => {
                    submitBtn.classList.remove('btn-loading');
                    submitBtn.disabled = false;
                });
        }

        function deleteAdmin(adminId) {
            Swal.fire({
                title: 'Hapus Admin?',
                text: "Data admin akan dihapus permanen. Tindakan ini tidak dapat dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/manajemen-admin/${adminId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content'),
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Terhapus!',
                                    text: data.message,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    const row = document.querySelector(
                                        `tr[data-admin-id="${adminId}"]`);
                                    if (row) {
                                        row.remove();
                                    }

                                    if (document.querySelectorAll(
                                            '#adminsTable tbody tr:not(.current-user)').length === 0) {
                                        window.location.reload();
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: data.message
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat menghapus admin.'
                            });
                        });
                }
            });
        }

        function showErrors(errors, prefix = '') {
            if (!errors) return;

            for (const field in errors) {
                const input = document.querySelector(`[name="${field}"]`);
                const errorElement = document.getElementById(`${prefix}${field}_error`);

                if (input) {
                    input.classList.add('is-invalid');
                }

                if (errorElement) {
                    errorElement.textContent = errors[field][0];
                }
            }
        }

        function clearErrors(prefix = '') {
            const invalidInputs = document.querySelectorAll('.is-invalid');
            invalidInputs.forEach(input => {
                input.classList.remove('is-invalid');
            });

            const errorElements = document.querySelectorAll('.invalid-feedback');
            errorElements.forEach(element => {
                if (prefix === '' || element.id.startsWith(prefix)) {
                    element.textContent = '';
                }
            });
        }

        function resetProfilePreview(previewId) {
            const preview = document.getElementById(previewId);
            if (preview && !preview.classList.contains('upload-placeholder')) {
                const placeholder = document.createElement('div');
                placeholder.className = 'upload-placeholder';
                placeholder.id = previewId;
                placeholder.innerHTML = '<i class="fas fa-user"></i>';
                preview.parentNode.replaceChild(placeholder, preview);
            }
        }

        window.editAdmin = editAdmin;
        window.changePassword = changePassword;
        window.deleteAdmin = deleteAdmin;
    </script>
@endsection
