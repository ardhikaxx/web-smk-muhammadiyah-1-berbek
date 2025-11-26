@extends('layouts.app')

@section('title', 'Manajemen Fasilitas')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/manajemen-fasilitas.css') }}">

    <div class="manajemen-fasilitas-container">
        <div class="page-header mb-2">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-title">Manajemen Fasilitas</h1>
                    <p class="page-subtitle">Kelola fasilitas yang tersedia di SMK Muhammadiyah 1 Berbek</p>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahFasilitasModal">
                        <i class="fas fa-plus me-2"></i>Tambah Fasilitas
                    </button>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stat-card primary">
                    <div class="stat-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $fasilitas->count() }}</h3>
                        <p class="stat-label">Total Fasilitas</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card success">
                    <div class="stat-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $fasilitas->where('status', true)->count() }}</h3>
                        <p class="stat-label">Fasilitas Aktif</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card warning">
                    <div class="stat-icon">
                        <i class="fas fa-eye-slash"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $fasilitas->where('status', false)->count() }}</h3>
                        <p class="stat-label">Fasilitas Nonaktif</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card info">
                    <div class="stat-icon">
                        <i class="fas fa-sort"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $fasilitas->max('urutan') ?? 0 }}</h3>
                        <p class="stat-label">Urutan Tertinggi</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="fasilitas-grid-card">
            <div class="card-header">
                <div class="header-content">
                    <i class="fas fa-th-large header-icon"></i>
                    <div>
                        <h3 class="card-title">Daftar Fasilitas</h3>
                        <p class="card-subtitle">Kelola semua fasilitas yang ditampilkan di website</p>
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
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" placeholder="Cari fasilitas...">
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if ($fasilitas->isEmpty())
                    <div class="empty-state">
                        <i class="fas fa-building fa-4x text-muted mb-4"></i>
                        <h4>Belum ada fasilitas</h4>
                        <p class="text-muted">Tambahkan fasilitas pertama untuk ditampilkan di website.</p>
                        <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#tambahFasilitasModal">
                            <i class="fas fa-plus me-2"></i>Tambah Fasilitas Pertama
                        </button>
                    </div>
                @else
                    <div class="fasilitas-grid" id="fasilitasGridView">
                        @foreach ($fasilitas as $item)
                            <div class="fasilitas-card" data-fasilitas-id="{{ $item->id }}">
                                <div class="fasilitas-image">
                                    <img src="{{ $item->foto_fasilitas_url }}" alt="{{ $item->nama_fasilitas }}">
                                    <div class="fasilitas-overlay">
                                        <div class="action-buttons">
                                            <button class="btn btn-sm btn-edit" onclick="editFasilitas({{ $item->id }})"
                                                title="Edit Fasilitas">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-delete"
                                                onclick="deleteFasilitas({{ $item->id }})" title="Hapus Fasilitas">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="fasilitas-badges">
                                        <span class="badge badge-urutan">#{{ $item->urutan }}</span>
                                        @if ($item->status)
                                            <span class="badge badge-active">Aktif</span>
                                        @else
                                            <span class="badge badge-inactive">Nonaktif</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="fasilitas-content">
                                    <h6 class="fasilitas-title">{{ $item->nama_fasilitas }}</h6>
                                    <p class="fasilitas-description">{{ $item->deskripsi_pendek }}</p>
                                    <div class="fasilitas-meta">
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $item->created_at->format('d M Y') }}
                                        </small>
                                    </div>
                                    <div class="fasilitas-actions">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-toggle" type="checkbox"
                                                data-fasilitas-id="{{ $item->id }}"
                                                {{ $item->status ? 'checked' : '' }}>
                                            <label class="form-check-label">Aktif</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="fasilitas-list d-none" id="fasilitasListView">
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
                                    @foreach ($fasilitas as $item)
                                        <tr data-fasilitas-id="{{ $item->id }}">
                                            <td>
                                                <div class="fasilitas-thumb">
                                                    <img src="{{ $item->foto_fasilitas_url }}"
                                                        alt="{{ $item->nama_fasilitas }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="fasilitas-info">
                                                    <h6 class="fasilitas-title">{{ $item->nama_fasilitas }}</h6>
                                                    <p class="fasilitas-description">{{ $item->deskripsi_pendek }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        data-fasilitas-id="{{ $item->id }}"
                                                        {{ $item->status ? 'checked' : '' }}>
                                                    <label class="form-check-label">
                                                        {{ $item->status ? 'Aktif' : 'Nonaktif' }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="urutan-badge">#{{ $item->urutan }}</span>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $item->created_at->format('d M Y') }}
                                                </small>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-sm btn-edit"
                                                        onclick="editFasilitas({{ $item->id }})"
                                                        title="Edit Fasilitas">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-delete"
                                                        onclick="deleteFasilitas({{ $item->id }})"
                                                        title="Hapus Fasilitas">
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

    <div class="modal fade" id="tambahFasilitasModal" tabindex="-1" aria-labelledby="tambahFasilitasModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahFasilitasModalLabel">
                        <i class="fas fa-plus me-2"></i>Tambah Fasilitas Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="tambahFasilitasForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="fasilitas-upload-area">
                                    <div class="upload-wrapper" id="tambahUploadWrapper">
                                        <div class="upload-placeholder" id="tambahUploadPreview">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <p>Klik untuk upload gambar</p>
                                            <small>Format: JPG, PNG, GIF, WEBP<br>Maksimal: 5MB</small>
                                        </div>
                                        <input type="file" name="foto_fasilitas" id="tambahFotoFasilitas"
                                            class="upload-input" accept="image/*" required>
                                    </div>
                                    <div class="image-preview d-none" id="tambahImagePreview">
                                        <img src="" alt="Preview" id="tambahPreviewImage">
                                        <button type="button" class="btn-remove-preview"
                                            onclick="removePreview('tambah')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="invalid-feedback" id="tambahFotoFasilitas_error"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tambahNamaFasilitas" class="form-label">Nama Fasilitas *</label>
                                    <input type="text" class="form-control" id="tambahNamaFasilitas"
                                        name="nama_fasilitas" placeholder="Masukkan nama fasilitas" required>
                                    <div class="invalid-feedback" id="tambahNamaFasilitas_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="tambahDeskripsiFasilitas" class="form-label">Deskripsi Fasilitas *</label>
                                    <textarea class="form-control" id="tambahDeskripsiFasilitas" name="deskripsi_fasilitas" rows="4"
                                        placeholder="Masukkan deskripsi fasilitas" required></textarea>
                                    <small class="form-text text-muted">Maksimal 1000 karakter</small>
                                    <div class="invalid-feedback" id="tambahDeskripsiFasilitas_error"></div>
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
                        <button type="submit" class="btn btn-primary" id="tambahFasilitasBtn">
                            <i class="fas fa-save me-2"></i>Simpan Fasilitas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editFasilitasModal" tabindex="-1" aria-labelledby="editFasilitasModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFasilitasModalLabel">
                        <i class="fas fa-edit me-2"></i>Edit Fasilitas
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editFasilitasForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editFasilitasId" name="id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="fasilitas-upload-area">
                                    <div class="current-image mb-3">
                                        <label class="form-label">Gambar Saat Ini</label>
                                        <div class="current-image-preview">
                                            <img src="" alt="Current Fasilitas" id="editCurrentImage">
                                        </div>
                                    </div>
                                    <div class="upload-wrapper" id="editUploadWrapper">
                                        <div class="upload-placeholder" id="editUploadPreview">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <p>Klik untuk ubah gambar</p>
                                            <small>Format: JPG, PNG, GIF, WEBP<br>Maksimal: 5MB</small>
                                        </div>
                                        <input type="file" name="foto_fasilitas" id="editFotoFasilitas"
                                            class="upload-input" accept="image/*">
                                    </div>
                                    <div class="image-preview d-none" id="editImagePreview">
                                        <img src="" alt="Preview" id="editPreviewImage">
                                        <button type="button" class="btn-remove-preview"
                                            onclick="removePreview('edit')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="invalid-feedback" id="editFotoFasilitas_error"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editNamaFasilitas" class="form-label">Nama Fasilitas *</label>
                                    <input type="text" class="form-control" id="editNamaFasilitas"
                                        name="nama_fasilitas" placeholder="Masukkan nama fasilitas" required>
                                    <div class="invalid-feedback" id="editNamaFasilitas_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="editDeskripsiFasilitas" class="form-label">Deskripsi Fasilitas *</label>
                                    <textarea class="form-control" id="editDeskripsiFasilitas" name="deskripsi_fasilitas" rows="4"
                                        placeholder="Masukkan deskripsi fasilitas" required></textarea>
                                    <small class="form-text text-muted">Maksimal 1000 karakter</small>
                                    <div class="invalid-feedback" id="editDeskripsiFasilitas_error"></div>
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
                        <button type="submit" class="btn btn-primary" id="editFasilitasBtn">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initManajemenFasilitas();
        });

        function initManajemenFasilitas() {
            initFasilitasUpload();
            initFormSubmissions();
            initViewToggle();
            initStatusToggle();
            initSearch();
        }

        function initFasilitasUpload() {
            const tambahUploadInput = document.getElementById('tambahFotoFasilitas');
            const tambahUploadWrapper = document.getElementById('tambahUploadWrapper');
            const tambahImagePreview = document.getElementById('tambahImagePreview');
            const tambahPreviewImage = document.getElementById('tambahPreviewImage');

            if (tambahUploadInput) {
                tambahUploadInput.addEventListener('change', function(e) {
                    handleFasilitasUpload(e, tambahUploadWrapper, tambahImagePreview, tambahPreviewImage);
                });

                initDragAndDrop(tambahUploadWrapper, tambahUploadInput);
            }

            const editUploadInput = document.getElementById('editFotoFasilitas');
            const editUploadWrapper = document.getElementById('editUploadWrapper');
            const editImagePreview = document.getElementById('editImagePreview');
            const editPreviewImage = document.getElementById('editPreviewImage');

            if (editUploadInput) {
                editUploadInput.addEventListener('change', function(e) {
                    handleFasilitasUpload(e, editUploadWrapper, editImagePreview, editPreviewImage);
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

        function handleFasilitasUpload(event, uploadWrapper, imagePreview, previewImage) {
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
                const uploadInput = document.getElementById('tambahFotoFasilitas');

                uploadWrapper.classList.remove('d-none');
                imagePreview.classList.add('d-none');
                uploadInput.value = '';
            } else if (type === 'edit') {
                const uploadWrapper = document.getElementById('editUploadWrapper');
                const imagePreview = document.getElementById('editImagePreview');
                const uploadInput = document.getElementById('editFotoFasilitas');

                uploadWrapper.classList.remove('d-none');
                imagePreview.classList.add('d-none');
                uploadInput.value = '';
            }
        }

        function initFormSubmissions() {
            const tambahFasilitasForm = document.getElementById('tambahFasilitasForm');
            if (tambahFasilitasForm) {
                tambahFasilitasForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    storeFasilitas();
                });
            }

            const editFasilitasForm = document.getElementById('editFasilitasForm');
            if (editFasilitasForm) {
                editFasilitasForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    updateFasilitas();
                });
            }
        }

        function initViewToggle() {
            const viewButtons = document.querySelectorAll('.view-btn');
            const gridView = document.getElementById('fasilitasGridView');
            const listView = document.getElementById('fasilitasListView');

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
                    const fasilitasId = this.getAttribute('data-fasilitas-id');
                    const status = this.checked;

                    updateFasilitasStatus(fasilitasId, status);
                });
            });
        }

        function initSearch() {
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    const gridCards = document.querySelectorAll('.fasilitas-card');
                    const listRows = document.querySelectorAll('.fasilitas-list tbody tr');

                    gridCards.forEach(card => {
                        const title = card.querySelector('.fasilitas-title').textContent.toLowerCase();
                        const description = card.querySelector('.fasilitas-description').textContent
                            .toLowerCase();

                        if (title.includes(searchTerm) || description.includes(searchTerm)) {
                            card.style.display = '';
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    listRows.forEach(row => {
                        const title = row.querySelector('.fasilitas-title').textContent.toLowerCase();
                        const description = row.querySelector('.fasilitas-description').textContent
                            .toLowerCase();

                        if (title.includes(searchTerm) || description.includes(searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }
        }

        function storeFasilitas() {
            const form = document.getElementById('tambahFasilitasForm');
            const formData = new FormData(form);
            const submitBtn = document.getElementById('tambahFasilitasBtn');
            clearErrors('tambah');
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;

            fetch('{{ route('admin.manajemen-fasilitas.store') }}', {
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
                            bootstrap.Modal.getInstance(document.getElementById('tambahFasilitasModal')).hide();
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
                        text: 'Terjadi kesalahan saat menambahkan fasilitas.'
                    });
                })
                .finally(() => {
                    submitBtn.classList.remove('btn-loading');
                    submitBtn.disabled = false;
                });
        }

        function editFasilitas(fasilitasId) {
            const editFasilitasBtn = document.getElementById('editFasilitasBtn');
            editFasilitasBtn.classList.add('btn-loading');
            editFasilitasBtn.disabled = true;

            fetch(`/admin/manajemen-fasilitas/${fasilitasId}`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const fasilitas = data.fasilitas;
                        document.getElementById('editFasilitasId').value = fasilitas.id;
                        document.getElementById('editNamaFasilitas').value = fasilitas.nama_fasilitas;
                        document.getElementById('editDeskripsiFasilitas').value = fasilitas.deskripsi_fasilitas;
                        document.getElementById('editUrutan').value = fasilitas.urutan;
                        document.getElementById('editStatus').checked = fasilitas.status;
                        document.getElementById('editCurrentImage').src = fasilitas.foto_fasilitas_url;
                        removePreview('edit');
                        const modal = new bootstrap.Modal(document.getElementById('editFasilitasModal'));
                        modal.show();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal memuat data fasilitas.'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat memuat data fasilitas.'
                    });
                })
                .finally(() => {
                    editFasilitasBtn.classList.remove('btn-loading');
                    editFasilitasBtn.disabled = false;
                });
        }

        function updateFasilitas() {
            const form = document.getElementById('editFasilitasForm');
            const formData = new FormData(form);
            const fasilitasId = document.getElementById('editFasilitasId').value;
            const submitBtn = document.getElementById('editFasilitasBtn');
            clearErrors('edit');
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;

            fetch(`/admin/manajemen-fasilitas/${fasilitasId}`, {
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
                            bootstrap.Modal.getInstance(document.getElementById('editFasilitasModal')).hide();
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
                        text: 'Terjadi kesalahan saat memperbarui fasilitas.'
                    });
                })
                .finally(() => {
                    submitBtn.classList.remove('btn-loading');
                    submitBtn.disabled = false;
                });
        }

        function updateFasilitasStatus(fasilitasId, status) {
            fetch(`/admin/manajemen-fasilitas/${fasilitasId}/status`, {
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
                        // Revert toggle
                        const toggle = document.querySelector(`.status-toggle[data-fasilitas-id="${fasilitasId}"]`);
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
                        text: 'Terjadi kesalahan saat memperbarui status fasilitas.'
                    });
                    const toggle = document.querySelector(`.status-toggle[data-fasilitas-id="${fasilitasId}"]`);
                    if (toggle) {
                        toggle.checked = !status;
                    }
                });
        }

        function deleteFasilitas(fasilitasId) {
            Swal.fire({
                title: 'Hapus Fasilitas?',
                text: "Fasilitas akan dihapus permanen. Tindakan ini tidak dapat dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/manajemen-fasilitas/${fasilitasId}`, {
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
                                    const fasilitasCard = document.querySelector(
                                        `.fasilitas-card[data-fasilitas-id="${fasilitasId}"]`);
                                    const fasilitasRow = document.querySelector(
                                        `tr[data-fasilitas-id="${fasilitasId}"]`);

                                    if (fasilitasCard) fasilitasCard.remove();
                                    if (fasilitasRow) fasilitasRow.remove();

                                    if (document.querySelectorAll('.fasilitas-card').length === 0 &&
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
                                text: 'Terjadi kesalahan saat menghapus fasilitas.'
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

        window.editFasilitas = editFasilitas;
        window.deleteFasilitas = deleteFasilitas;
        window.removePreview = removePreview;
    </script>
@endsection
