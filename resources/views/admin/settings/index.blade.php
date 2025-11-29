@extends('layouts.app')

@section('title', 'Pengaturan Akun')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
    <div class="settings-container">
        <div class="settings-header mb-2">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-title">Pengaturan Akun</h1>
                    <p class="page-subtitle">Kelola informasi profil dan keamanan akun Anda</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="settings-card profile-card">
                    <div class="card-header">
                        <div class="header-content">
                            <i class="fas fa-user-circle header-icon"></i>
                            <div>
                                <h3 class="card-title">Informasi Profil</h3>
                                <p class="card-subtitle">Perbarui informasi profil dan foto Anda</p>
                            </div>
                        </div>
                        <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                            <i class="fas fa-edit me-2"></i>Edit
                        </button>
                    </div>

                    <div class="card-body">
                        <div class="profile-info-grid">
                            <div class="info-item">
                                <label class="info-label">Nama Lengkap</label>
                                <p class="info-value">{{ Auth::guard('admin')->user()->nama_lengkap }}</p>
                            </div>
                            <div class="info-item">
                                <label class="info-label">Email</label>
                                <p class="info-value">{{ Auth::guard('admin')->user()->email }}</p>
                            </div>
                            <div class="info-item">
                                <label class="info-label">Nomor Telepon</label>
                                <p class="info-value">{{ Auth::guard('admin')->user()->nomor_telepon ?? '-' }}</p>
                            </div>
                            <div class="info-item">
                                <label class="info-label">Bergabung Pada</label>
                                <p class="info-value">{{ Auth::guard('admin')->user()->created_at->format('d F Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="settings-card security-card mt-4 mb-4 lg:mb-0">
                    <div class="card-header">
                        <div class="header-content">
                            <i class="fas fa-shield-alt header-icon"></i>
                            <div>
                                <h3 class="card-title">Keamanan Akun</h3>
                                <p class="card-subtitle">Kelola kata sandi dan keamanan akun</p>
                            </div>
                        </div>
                        <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                            <i class="fas fa-key me-2"></i>Ubah Password
                        </button>
                    </div>

                    <div class="card-body">
                        <div class="security-status">
                            <div class="status-item">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Akun terverifikasi</span>
                            </div>
                            <div class="status-item">
                                <i class="fas fa-user-clock text-primary me-2"></i>
                                <span>Akun Dibuat Tanggal:
                                    {{ \Carbon\Carbon::parse(Auth::guard('admin')->user()->created_at)->setTimezone('Asia/Jakarta')->locale('id')->isoFormat('D MMMM YYYY [pukul] HH.mm') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="settings-card picture-card">
                    <div class="card-header">
                        <h3 class="card-title">Foto Profil</h3>
                    </div>
                    <div class="card-body text-center">
                        <div class="profile-picture-wrapper">
                            @if (Auth::guard('admin')->user()->foto_profil)
                                <img src="{{ asset('images/photo/' . Auth::guard('admin')->user()->foto_profil) }}"
                                    alt="Profile Picture" class="profile-picture" id="currentProfilePicture">
                            @else
                                <div class="profile-picture-placeholder">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                        </div>
                        <p class="picture-help mt-3">
                            Format: JPG, PNG, GIF<br>
                            Maksimal: 2MB
                        </p>
                    </div>
                </div>

                <div class="settings-card quick-actions-card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">Aksi Cepat</h3>
                    </div>
                    <div class="card-body">
                        <div class="quick-actions">
                            <button class="quick-action-btn" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                <i class="fas fa-user-edit"></i>
                                <span>Edit Profil</span>
                            </button>
                            <button class="quick-action-btn" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                <i class="fas fa-key"></i>
                                <span>Ubah Password</span>
                            </button>
                            <button class="quick-action-btn text-danger" onclick="confirmLogout()">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">
                        <i class="fas fa-user-edit me-2"></i>Edit Profil
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editProfileForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <div class="profile-picture-upload">
                                    <div class="upload-wrapper">
                                        @if (Auth::guard('admin')->user()->foto_profil)
                                            <img src="{{ asset('images/photo/' . Auth::guard('admin')->user()->foto_profil) }}"
                                                alt="Profile Picture" class="upload-preview" id="uploadPreview">
                                        @else
                                            <div class="upload-placeholder" id="uploadPreview">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        @endif
                                        <div class="upload-overlay">
                                            <i class="fas fa-camera"></i>
                                            <span>Ubah Foto</span>
                                        </div>
                                        <input type="file" name="foto_profil" id="foto_profil" class="upload-input"
                                            accept="image/*">
                                    </div>
                                    <small class="text-muted mt-2 d-block">Klik untuk mengubah foto</small>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="nama_lengkap" class="form-label">Nama Lengkap *</label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                        value="{{ Auth::guard('admin')->user()->nama_lengkap }}" required>
                                    <div class="invalid-feedback" id="nama_lengkap_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ Auth::guard('admin')->user()->email }}" required>
                                    <div class="invalid-feedback" id="email_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon"
                                        value="{{ Auth::guard('admin')->user()->nomor_telepon }}">
                                    <div class="invalid-feedback" id="nomor_telepon_error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="updateProfileBtn">
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
                        <i class="fas fa-key me-2"></i>Ubah Password
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="changePasswordForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="current_password" class="form-label">Password Saat Ini *</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="current_password"
                                    name="current_password" required>
                                <button type="button" class="btn toggle-password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="invalid-feedback" id="current_password_error"></div>
                        </div>
                        <div class="form-group">
                            <label for="new_password" class="form-label">Password Baru *</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="new_password" name="new_password"
                                    required>
                                <button type="button" class="btn toggle-password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="invalid-feedback" id="new_password_error"></div>
                        </div>
                        <div class="form-group">
                            <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru *</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="new_password_confirmation"
                                    name="new_password_confirmation" required>
                                <button type="button" class="btn toggle-password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="invalid-feedback" id="new_password_confirmation_error"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="updatePasswordBtn">
                            <i class="fas fa-save me-2"></i>Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initSettings();
        });

        function initSettings() {
            initProfilePictureUpload();
            initFormSubmissions();
            initPasswordToggle();
        }

        function initProfilePictureUpload() {
            const uploadInput = document.getElementById('foto_profil');
            const uploadPreview = document.getElementById('uploadPreview');
            const currentProfilePicture = document.getElementById('currentProfilePicture');

            if (uploadInput && uploadPreview) {
                uploadInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            if (uploadPreview.classList.contains('upload-placeholder')) {
                                const img = document.createElement('img');
                                img.src = e.target.result;
                                img.alt = 'Profile Preview';
                                img.className = 'upload-preview';
                                uploadPreview.parentNode.replaceChild(img, uploadPreview);
                            } else {
                                uploadPreview.src = e.target.result;
                            }
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }
        }

        function initFormSubmissions() {
            const editProfileForm = document.getElementById('editProfileForm');
            if (editProfileForm) {
                editProfileForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    updateProfile();
                });
            }

            const changePasswordForm = document.getElementById('changePasswordForm');
            if (changePasswordForm) {
                changePasswordForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    updatePassword();
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

        function updateProfile() {
            const form = document.getElementById('editProfileForm');
            const formData = new FormData(form);
            const submitBtn = document.getElementById('updateProfileBtn');
            clearErrors();
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;

            fetch('{{ route('admin.settings.profile') }}', {
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
                            updateProfileUI(data.admin);
                            bootstrap.Modal.getInstance(document.getElementById('editProfileModal')).hide();
                            setTimeout(() => {
                                window.location.reload();
                            }, 500);
                        });
                    } else {
                        showErrors(data.errors);
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
                        text: 'Terjadi kesalahan saat memperbarui profil.'
                    });
                })
                .finally(() => {
                    submitBtn.classList.remove('btn-loading');
                    submitBtn.disabled = false;
                });
        }

        function updatePassword() {
            const form = document.getElementById('changePasswordForm');
            const formData = new FormData(form);
            const submitBtn = document.getElementById('updatePasswordBtn');
            clearErrors();
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;

            fetch('{{ route('admin.settings.password') }}', {
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
                            // Close modal and reset form
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

        function showErrors(errors) {
            if (!errors) return;

            for (const field in errors) {
                const input = document.querySelector(`[name="${field}"]`);
                const errorElement = document.getElementById(`${field}_error`);

                if (input) {
                    input.classList.add('is-invalid');
                }

                if (errorElement) {
                    errorElement.textContent = errors[field][0];
                }
            }
        }

        function clearErrors() {
            const invalidInputs = document.querySelectorAll('.is-invalid');
            invalidInputs.forEach(input => {
                input.classList.remove('is-invalid');
            });

            const errorElements = document.querySelectorAll('.invalid-feedback');
            errorElements.forEach(element => {
                element.textContent = '';
            });
        }

        function updateProfileUI(adminData) {
            const infoItems = document.querySelectorAll('.info-value');
            infoItems.forEach(item => {
                const label = item.previousElementSibling.textContent.trim();
                if (label === 'Nama Lengkap') {
                    item.textContent = adminData.nama_lengkap;
                } else if (label === 'Email') {
                    item.textContent = adminData.email;
                }
            });

            if (adminData.foto_profil) {
                const currentPicture = document.getElementById('currentProfilePicture');
                const uploadPreview = document.getElementById('uploadPreview');

                if (currentPicture) {
                    currentPicture.src = adminData.foto_profil;
                }
                if (uploadPreview) {
                    uploadPreview.src = adminData.foto_profil;
                }
            }

            const adminNameElements = document.querySelectorAll('#adminName, #adminNameShort, #dropdownAdminName');
            adminNameElements.forEach(element => {
                element.textContent = adminData.nama_lengkap;
            });
        }

        window.updateProfile = updateProfile;
        window.updatePassword = updatePassword;
        window.confirmLogout = confirmLogout;
    </script>
@endsection
