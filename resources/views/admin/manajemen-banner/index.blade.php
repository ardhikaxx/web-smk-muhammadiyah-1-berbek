@extends('layouts.app')

@section('title', 'Manajemen Banner')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/manajemen-banner.css') }}">

    <div class="manajemen-banner-container">
        <div class="page-header mb-2">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-title">Manajemen Banner</h1>
                    <p class="page-subtitle">Kelola banner slider untuk halaman utama</p>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahBannerModal">
                        <i class="fas fa-plus me-2"></i>Tambah Banner
                    </button>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stat-card primary">
                    <div class="stat-icon">
                        <i class="fas fa-images"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $banners->count() }}</h3>
                        <p class="stat-label">Total Banner</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card success">
                    <div class="stat-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $banners->where('status', true)->count() }}</h3>
                        <p class="stat-label">Banner Aktif</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card warning">
                    <div class="stat-icon">
                        <i class="fas fa-eye-slash"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $banners->where('status', false)->count() }}</h3>
                        <p class="stat-label">Banner Nonaktif</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card info">
                    <div class="stat-icon">
                        <i class="fas fa-sort"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $banners->max('urutan') ?? 0 }}</h3>
                        <p class="stat-label">Urutan Tertinggi</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="banners-grid-card">
            <div class="card-header">
                <div class="header-content">
                    <i class="fas fa-th-large header-icon"></i>
                    <div>
                        <h3 class="card-title">Daftar Banner</h3>
                        <p class="card-subtitle">Kelola semua banner yang ditampilkan di halaman utama</p>
                    </div>
                </div>
                <div class="header-actions">
                    <div class="view-toggle">
                        <button class="view-btn active" data-view="grid">
                            <i class="fas fa-th-large"></i>
                        </button>
                        <button class="view-btn" data-view="list">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if ($banners->isEmpty())
                    <div class="empty-state">
                        <i class="fas fa-images fa-4x text-muted mb-4"></i>
                        <h4>Belum ada banner</h4>
                        <p class="text-muted">Tambahkan banner pertama untuk ditampilkan di halaman utama.</p>
                        <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#tambahBannerModal">
                            <i class="fas fa-plus me-2"></i>Tambah Banner Pertama
                        </button>
                    </div>
                @else
                    <div class="banners-grid" id="bannersGridView">
                        @foreach ($banners as $banner)
                            <div class="banner-card" data-banner-id="{{ $banner->id }}">
                                <div class="banner-image">
                                    <img src="{{ $banner->gambar_url }}" alt="{{ $banner->judul ?? 'Banner' }}">
                                    <div class="banner-overlay">
                                        <div class="action-buttons">
                                            <button class="btn btn-sm btn-edit" onclick="editBanner({{ $banner->id }})"
                                                title="Edit Banner">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-delete"
                                                onclick="deleteBanner({{ $banner->id }})" title="Hapus Banner">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="banner-badges">
                                        <span class="badge badge-urutan">#{{ $banner->urutan }}</span>
                                        @if ($banner->status)
                                            <span class="badge badge-active">Aktif</span>
                                        @else
                                            <span class="badge badge-inactive">Nonaktif</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="banner-content">
                                    <h6 class="banner-title">{{ $banner->judul ?? 'Tanpa Judul' }}</h6>
                                    @if ($banner->deskripsi)
                                        <p class="banner-description">{{ Str::limit($banner->deskripsi, 80) }}</p>
                                    @endif
                                    <div class="banner-meta">
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $banner->created_at->format('d M Y') }}
                                        </small>
                                    </div>
                                    <div class="banner-actions">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-toggle" type="checkbox"
                                                data-banner-id="{{ $banner->id }}"
                                                {{ $banner->status ? 'checked' : '' }}>
                                            <label class="form-check-label">Aktif</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="banners-list d-none" id="bannersListView">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Informasi</th>
                                        <th>Status</th>
                                        <th>Urutan</th>
                                        <th>Tanggal</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banners as $banner)
                                        <tr data-banner-id="{{ $banner->id }}">
                                            <td>
                                                <div class="banner-thumb">
                                                    <img src="{{ $banner->gambar_url }}"
                                                        alt="{{ $banner->judul ?? 'Banner' }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="banner-info">
                                                    <h6 class="banner-title">{{ $banner->judul ?? 'Tanpa Judul' }}</h6>
                                                    @if ($banner->deskripsi)
                                                        <p class="banner-description">{{ $banner->deskripsi }}</p>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        data-banner-id="{{ $banner->id }}"
                                                        {{ $banner->status ? 'checked' : '' }}>
                                                    <label class="form-check-label">
                                                        {{ $banner->status ? 'Aktif' : 'Nonaktif' }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="urutan-badge">#{{ $banner->urutan }}</span>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $banner->created_at->format('d M Y') }}
                                                </small>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-sm btn-edit"
                                                        onclick="editBanner({{ $banner->id }})" title="Edit Banner">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-delete"
                                                        onclick="deleteBanner({{ $banner->id }})" title="Hapus Banner">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahBannerModal" tabindex="-1" aria-labelledby="tambahBannerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahBannerModalLabel">
                        <i class="fas fa-plus me-2"></i>Tambah Banner Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="tambahBannerForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="banner-upload-area">
                                    <div class="upload-wrapper" id="tambahUploadWrapper">
                                        <div class="upload-placeholder" id="tambahUploadPreview">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <p>Klik untuk upload gambar</p>
                                            <small>Format: JPG, PNG, GIF, WEBP<br>Maksimal: 5MB</small>
                                        </div>
                                        <input type="file" name="gambar" id="tambahGambar" class="upload-input"
                                            accept="image/*" required>
                                    </div>
                                    <div class="image-preview d-none" id="tambahImagePreview">
                                        <img src="" alt="Preview" id="tambahPreviewImage">
                                        <button type="button" class="btn-remove-preview"
                                            onclick="removePreview('tambah')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="invalid-feedback" id="tambahGambar_error"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tambahJudul" class="form-label">Judul Banner (Opsional)</label>
                                    <input type="text" class="form-control" id="tambahJudul" name="judul"
                                        placeholder="Masukkan judul banner">
                                    <div class="invalid-feedback" id="tambahJudul_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="tambahDeskripsi" class="form-label">Deskripsi (Opsional)</label>
                                    <textarea class="form-control" id="tambahDeskripsi" name="deskripsi" rows="3"
                                        placeholder="Masukkan deskripsi banner"></textarea>
                                    <div class="invalid-feedback" id="tambahDeskripsi_error"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tambahUrutan" class="form-label">Urutan Tampil</label>
                                            <input type="number" class="form-control" id="tambahUrutan" name="urutan"
                                                value="0" min="0">
                                            <div class="invalid-feedback" id="tambahUrutan_error"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Status</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="tambahStatus"
                                                    name="status" checked>
                                                <label class="form-check-label" for="tambahStatus">Aktif</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="tambahBannerBtn">
                            <i class="fas fa-save me-2"></i>Simpan Banner
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editBannerModal" tabindex="-1" aria-labelledby="editBannerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBannerModalLabel">
                        <i class="fas fa-edit me-2"></i>Edit Banner
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editBannerForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editBannerId" name="id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="banner-upload-area">
                                    <div class="current-image mb-3">
                                        <label class="form-label">Gambar Saat Ini</label>
                                        <div class="current-image-preview">
                                            <img src="" alt="Current Banner" id="editCurrentImage">
                                        </div>
                                    </div>
                                    <div class="upload-wrapper" id="editUploadWrapper">
                                        <div class="upload-placeholder" id="editUploadPreview">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <p>Klik untuk ubah gambar</p>
                                            <small>Format: JPG, PNG, GIF, WEBP<br>Maksimal: 5MB</small>
                                        </div>
                                        <input type="file" name="gambar" id="editGambar" class="upload-input"
                                            accept="image/*">
                                    </div>
                                    <div class="image-preview d-none" id="editImagePreview">
                                        <img src="" alt="Preview" id="editPreviewImage">
                                        <button type="button" class="btn-remove-preview"
                                            onclick="removePreview('edit')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="invalid-feedback" id="editGambar_error"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editJudul" class="form-label">Judul Banner (Opsional)</label>
                                    <input type="text" class="form-control" id="editJudul" name="judul"
                                        placeholder="Masukkan judul banner">
                                    <div class="invalid-feedback" id="editJudul_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="editDeskripsi" class="form-label">Deskripsi (Opsional)</label>
                                    <textarea class="form-control" id="editDeskripsi" name="deskripsi" rows="3"
                                        placeholder="Masukkan deskripsi banner"></textarea>
                                    <div class="invalid-feedback" id="editDeskripsi_error"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editUrutan" class="form-label">Urutan Tampil</label>
                                            <input type="number" class="form-control" id="editUrutan" name="urutan"
                                                min="0">
                                            <div class="invalid-feedback" id="editUrutan_error"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Status</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="editStatus"
                                                    name="status">
                                                <label class="form-check-label" for="editStatus">Aktif</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="editBannerBtn">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initManajemenBanner();
        });

        function initManajemenBanner() {
            initBannerUpload();
            initFormSubmissions();
            initViewToggle();
            initStatusToggle();
        }

        function initBannerUpload() {
            const tambahUploadInput = document.getElementById('tambahGambar');
            const tambahUploadWrapper = document.getElementById('tambahUploadWrapper');
            const tambahImagePreview = document.getElementById('tambahImagePreview');
            const tambahPreviewImage = document.getElementById('tambahPreviewImage');

            if (tambahUploadInput) {
                tambahUploadInput.addEventListener('change', function(e) {
                    handleBannerUpload(e, tambahUploadWrapper, tambahImagePreview, tambahPreviewImage);
                });

                initDragAndDrop(tambahUploadWrapper, tambahUploadInput);
            }

            const editUploadInput = document.getElementById('editGambar');
            const editUploadWrapper = document.getElementById('editUploadWrapper');
            const editImagePreview = document.getElementById('editImagePreview');
            const editPreviewImage = document.getElementById('editPreviewImage');

            if (editUploadInput) {
                editUploadInput.addEventListener('change', function(e) {
                    handleBannerUpload(e, editUploadWrapper, editImagePreview, editPreviewImage);
                });

                initDragAndDrop(editUploadWrapper, editUploadInput);
            }
        }

        function initDragAndDrop(uploadWrapper, uploadInput) {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                uploadWrapper.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                uploadWrapper.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                uploadWrapper.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                uploadWrapper.classList.add('dragover');
            }

            function unhighlight() {
                uploadWrapper.classList.remove('dragover');
            }

            uploadWrapper.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                uploadInput.files = files;
                const event = new Event('change');
                uploadInput.dispatchEvent(event);
            }
        }

        function handleBannerUpload(event, uploadWrapper, imagePreview, previewImage) {
            const file = event.target.files[0];
            if (file) {
                const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                if (!validTypes.includes(file.type)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Format tidak didukung',
                        text: 'Hanya file JPG, PNG, GIF, dan WEBP yang diizinkan.'
                    });
                    return;
                }

                if (file.size > 5 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File terlalu besar',
                        text: 'Ukuran file maksimal 5MB.'
                    });
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    uploadWrapper.classList.add('d-none');
                    imagePreview.classList.remove('d-none');
                }
                reader.readAsDataURL(file);
            }
        }

        function removePreview(type) {
            if (type === 'tambah') {
                const uploadWrapper = document.getElementById('tambahUploadWrapper');
                const imagePreview = document.getElementById('tambahImagePreview');
                const uploadInput = document.getElementById('tambahGambar');

                uploadWrapper.classList.remove('d-none');
                imagePreview.classList.add('d-none');
                uploadInput.value = '';
            } else if (type === 'edit') {
                const uploadWrapper = document.getElementById('editUploadWrapper');
                const imagePreview = document.getElementById('editImagePreview');
                const uploadInput = document.getElementById('editGambar');

                uploadWrapper.classList.remove('d-none');
                imagePreview.classList.add('d-none');
                uploadInput.value = '';
            }
        }

        function initFormSubmissions() {
            const tambahBannerForm = document.getElementById('tambahBannerForm');
            if (tambahBannerForm) {
                tambahBannerForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    storeBanner();
                });
            }

            const editBannerForm = document.getElementById('editBannerForm');
            if (editBannerForm) {
                editBannerForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    updateBanner();
                });
            }
        }

        function initViewToggle() {
            const viewButtons = document.querySelectorAll('.view-btn');
            const gridView = document.getElementById('bannersGridView');
            const listView = document.getElementById('bannersListView');

            viewButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const view = this.getAttribute('data-view');
                    viewButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    if (view === 'grid') {
                        gridView.classList.remove('d-none');
                        listView.classList.add('d-none');
                    } else {
                        gridView.classList.add('d-none');
                        listView.classList.remove('d-none');
                    }
                });
            });
        }

        function initStatusToggle() {
            const statusToggles = document.querySelectorAll('.status-toggle');

            statusToggles.forEach(toggle => {
                toggle.addEventListener('change', function() {
                    const bannerId = this.getAttribute('data-banner-id');
                    const status = this.checked;

                    updateBannerStatus(bannerId, status);
                });
            });
        }

        function storeBanner() {
            const form = document.getElementById('tambahBannerForm');
            const formData = new FormData(form);
            const submitBtn = document.getElementById('tambahBannerBtn');
            clearErrors('tambah');
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;

            fetch('{{ route('admin.manajemen-banner.store') }}', {
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
                            bootstrap.Modal.getInstance(document.getElementById('tambahBannerModal')).hide();
                            form.reset();
                            removePreview('tambah');
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
                        text: 'Terjadi kesalahan saat menambahkan banner.'
                    });
                })
                .finally(() => {
                    submitBtn.classList.remove('btn-loading');
                    submitBtn.disabled = false;
                });
        }

        function editBanner(bannerId) {
            const editBannerBtn = document.getElementById('editBannerBtn');
            editBannerBtn.classList.add('btn-loading');
            editBannerBtn.disabled = true;

            fetch(`/admin/manajemen-banner/${bannerId}`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const banner = data.banner;
                        document.getElementById('editBannerId').value = banner.id;
                        document.getElementById('editJudul').value = banner.judul || '';
                        document.getElementById('editDeskripsi').value = banner.deskripsi || '';
                        document.getElementById('editUrutan').value = banner.urutan;
                        document.getElementById('editStatus').checked = banner.status;
                        document.getElementById('editCurrentImage').src = banner.gambar_url;
                        removePreview('edit');
                        const modal = new bootstrap.Modal(document.getElementById('editBannerModal'));
                        modal.show();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal memuat data banner.'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat memuat data banner.'
                    });
                })
                .finally(() => {
                    editBannerBtn.classList.remove('btn-loading');
                    editBannerBtn.disabled = false;
                });
        }

        function updateBanner() {
            const form = document.getElementById('editBannerForm');
            const formData = new FormData(form);
            const bannerId = document.getElementById('editBannerId').value;
            const submitBtn = document.getElementById('editBannerBtn');
            clearErrors('edit');
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;

            fetch(`/admin/manajemen-banner/${bannerId}`, {
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
                            bootstrap.Modal.getInstance(document.getElementById('editBannerModal')).hide();
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
                        text: 'Terjadi kesalahan saat memperbarui banner.'
                    });
                })
                .finally(() => {
                    submitBtn.classList.remove('btn-loading');
                    submitBtn.disabled = false;
                });
        }

        function updateBannerStatus(bannerId, status) {
            fetch(`/admin/manajemen-banner/${bannerId}/status`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: data.message
                        });
                        const toggle = document.querySelector(`.status-toggle[data-banner-id="${bannerId}"]`);
                        if (toggle) {
                            toggle.checked = !status;
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat memperbarui status banner.'
                    });
                    // Revert toggle
                    const toggle = document.querySelector(`.status-toggle[data-banner-id="${bannerId}"]`);
                    if (toggle) {
                        toggle.checked = !status;
                    }
                });
        }

        function deleteBanner(bannerId) {
            Swal.fire({
                title: 'Hapus Banner?',
                text: "Banner akan dihapus permanen. Tindakan ini tidak dapat dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/manajemen-banner/${bannerId}`, {
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
                                    const bannerCard = document.querySelector(
                                        `.banner-card[data-banner-id="${bannerId}"]`);
                                    const bannerRow = document.querySelector(
                                        `tr[data-banner-id="${bannerId}"]`);

                                    if (bannerCard) bannerCard.remove();
                                    if (bannerRow) bannerRow.remove();
                                    if (document.querySelectorAll('.banner-card').length === 0 &&
                                        document.querySelectorAll('tbody tr').length === 0) {
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
                                text: 'Terjadi kesalahan saat menghapus banner.'
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
                if (prefix === '' || input.name.startsWith(prefix)) {
                    input.classList.remove('is-invalid');
                }
            });

            const errorElements = document.querySelectorAll('.invalid-feedback');
            errorElements.forEach(element => {
                if (prefix === '' || element.id.startsWith(prefix)) {
                    element.textContent = '';
                }
            });
        }

        window.editBanner = editBanner;
        window.deleteBanner = deleteBanner;
        window.removePreview = removePreview;
    </script>
@endsection
