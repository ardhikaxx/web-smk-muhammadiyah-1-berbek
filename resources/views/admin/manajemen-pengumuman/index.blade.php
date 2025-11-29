@extends('layouts.app')

@section('title', 'Manajemen Pengumuman')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/manajemen-pengumuman.css') }}">

    <div class="manajemen-pengumuman-container">
        <div class="page-header mb-2">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-title">Manajemen Pengumuman</h1>
                    <p class="page-subtitle">Kelola pengumuman penting SMK Muhammadiyah 1 Berbek</p>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPengumumanModal">
                        <i class="fas fa-plus me-2"></i>Tambah Pengumuman
                    </button>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stat-card primary">
                    <div class="stat-icon">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $pengumumen->count() }}</h3>
                        <p class="stat-label">Total Pengumuman</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card success">
                    <div class="stat-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $pengumumen->where('status', true)->count() }}</h3>
                        <p class="stat-label">Pengumuman Aktif</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card warning">
                    <div class="stat-icon">
                        <i class="fas fa-eye-slash"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $pengumumen->where('status', false)->count() }}</h3>
                        <p class="stat-label">Pengumuman Nonaktif</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card info">
                    <div class="stat-icon">
                        <i class="fas fa-sort"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $pengumumen->max('urutan') ?? 0 }}</h3>
                        <p class="stat-label">Urutan Tertinggi</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="pengumuman-grid-card">
            <div class="card-header">
                <div class="header-content">
                    <i class="fas fa-bullhorn header-icon"></i>
                    <div>
                        <h3 class="card-title">Daftar Pengumuman</h3>
                        <p class="card-subtitle">Kelola semua pengumuman penting yang ditampilkan di website</p>
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
                        <input type="text" id="searchInput" placeholder="Cari pengumuman...">
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if ($pengumumen->isEmpty())
                    <div class="empty-state">
                        <i class="fas fa-bullhorn fa-4x text-muted mb-4"></i>
                        <h4>Belum ada pengumuman</h4>
                        <p class="text-muted">Tambahkan pengumuman pertama untuk memberikan informasi penting.</p>
                        <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#tambahPengumumanModal">
                            <i class="fas fa-plus me-2"></i>Tambah Pengumuman Pertama
                        </button>
                    </div>
                @else
                    <div class="pengumuman-grid" id="pengumumanGridView">
                        @foreach ($pengumumen as $item)
                            <div class="pengumuman-card" data-pengumuman-id="{{ $item->id }}">
                                <div class="pengumuman-image">
                                    <img src="{{ $item->foto_pengumuman_url }}" alt="{{ $item->nama_pengumuman }}">
                                    <div class="pengumuman-overlay">
                                        <div class="action-buttons">
                                            <button class="btn btn-sm btn-edit"
                                                onclick="editPengumuman({{ $item->id }})" title="Edit Pengumuman">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-view"
                                                onclick="viewPengumuman({{ $item->id }})" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-delete"
                                                onclick="deletePengumuman({{ $item->id }})" title="Hapus Pengumuman">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="pengumuman-badges">
                                        <span class="badge badge-urutan">#{{ $item->urutan }}</span>
                                        @if ($item->status)
                                            <span class="badge badge-active">Aktif</span>
                                        @else
                                            <span class="badge badge-inactive">Nonaktif</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="pengumuman-content">
                                    <h6 class="pengumuman-title">{{ $item->nama_pengumuman }}</h6>
                                    <p class="pengumuman-description">{{ $item->deskripsi_pendek }}</p>
                                    <div class="pengumuman-meta">
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $item->created_at->format('d M Y') }}
                                        </small>
                                    </div>
                                    <div class="pengumuman-actions">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-toggle" type="checkbox"
                                                data-pengumuman-id="{{ $item->id }}"
                                                {{ $item->status ? 'checked' : '' }}>
                                            <label class="form-check-label">Aktif</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="pengumuman-list d-none" id="pengumumanListView">
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
                                    @foreach ($pengumumen as $item)
                                        <tr data-pengumuman-id="{{ $item->id }}">
                                            <td>
                                                <div class="pengumuman-thumb">
                                                    <img src="{{ $item->foto_pengumuman_url }}"
                                                        alt="{{ $item->nama_pengumuman }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="pengumuman-info">
                                                    <h6 class="pengumuman-title">{{ $item->nama_pengumuman }}</h6>
                                                    <p class="pengumuman-description">{{ $item->deskripsi_pendek }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        data-pengumuman-id="{{ $item->id }}"
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
                                                        onclick="editPengumuman({{ $item->id }})"
                                                        title="Edit Pengumuman">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-view"
                                                        onclick="viewPengumuman({{ $item->id }})"
                                                        title="Lihat Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-delete"
                                                        onclick="deletePengumuman({{ $item->id }})"
                                                        title="Hapus Pengumuman">
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

    <!-- Modal Tambah Pengumuman -->
    <div class="modal fade" id="tambahPengumumanModal" tabindex="-1" aria-labelledby="tambahPengumumanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPengumumanModalLabel">
                        <i class="fas fa-plus me-2"></i>Tambah Pengumuman Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="tambahPengumumanForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="pengumuman-upload-area">
                                    <div class="upload-wrapper" id="tambahUploadWrapper">
                                        <div class="upload-placeholder" id="tambahUploadPreview">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <p>Klik untuk upload gambar</p>
                                            <small>Format: JPG, PNG, GIF, WEBP<br>Maksimal: 5MB</small>
                                        </div>
                                        <input type="file" name="foto_pengumuman" id="tambahFotoPengumuman"
                                            class="upload-input" accept="image/*" required>
                                    </div>
                                    <div class="image-preview d-none" id="tambahImagePreview">
                                        <img src="" alt="Preview" id="tambahPreviewImage">
                                        <button type="button" class="btn-remove-preview"
                                            onclick="removePreview('tambah')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="invalid-feedback" id="tambahFotoPengumuman_error"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tambahNamaPengumuman" class="form-label">Nama Pengumuman *</label>
                                    <input type="text" class="form-control" id="tambahNamaPengumuman"
                                        name="nama_pengumuman" placeholder="Masukkan nama pengumuman" required>
                                    <div class="invalid-feedback" id="tambahNamaPengumuman_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="tambahDeskripsiPengumuman" class="form-label">Deskripsi Pengumuman
                                        *</label>
                                    <textarea class="form-control" id="tambahDeskripsiPengumuman" name="deskripsi_pengumuman" rows="4"
                                        placeholder="Masukkan deskripsi pengumuman" required></textarea>
                                    <small class="form-text text-muted">Maksimal 1000 karakter</small>
                                    <div class="invalid-feedback" id="tambahDeskripsiPengumuman_error"></div>
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
                        <button type="submit" class="btn btn-primary" id="tambahPengumumanBtn">
                            <i class="fas fa-save me-2"></i>Simpan Pengumuman
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Pengumuman -->
    <div class="modal fade" id="editPengumumanModal" tabindex="-1" aria-labelledby="editPengumumanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPengumumanModalLabel">
                        <i class="fas fa-edit me-2"></i>Edit Pengumuman
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editPengumumanForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editPengumumanId" name="id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="pengumuman-upload-area">
                                    <div class="current-image mb-3">
                                        <label class="form-label">Gambar Saat Ini</label>
                                        <div class="current-image-preview">
                                            <img src="" alt="Current Pengumuman" id="editCurrentImage">
                                        </div>
                                    </div>
                                    <div class="upload-wrapper" id="editUploadWrapper">
                                        <div class="upload-placeholder" id="editUploadPreview">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <p>Klik untuk ubah gambar</p>
                                            <small>Format: JPG, PNG, GIF, WEBP<br>Maksimal: 5MB</small>
                                        </div>
                                        <input type="file" name="foto_pengumuman" id="editFotoPengumuman"
                                            class="upload-input" accept="image/*">
                                    </div>
                                    <div class="image-preview d-none" id="editImagePreview">
                                        <img src="" alt="Preview" id="editPreviewImage">
                                        <button type="button" class="btn-remove-preview"
                                            onclick="removePreview('edit')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="invalid-feedback" id="editFotoPengumuman_error"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editNamaPengumuman" class="form-label">Nama Pengumuman *</label>
                                    <input type="text" class="form-control" id="editNamaPengumuman"
                                        name="nama_pengumuman" placeholder="Masukkan nama pengumuman" required>
                                    <div class="invalid-feedback" id="editNamaPengumuman_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="editDeskripsiPengumuman" class="form-label">Deskripsi Pengumuman *</label>
                                    <textarea class="form-control" id="editDeskripsiPengumuman" name="deskripsi_pengumuman" rows="4"
                                        placeholder="Masukkan deskripsi pengumuman" required></textarea>
                                    <small class="form-text text-muted">Maksimal 1000 karakter</small>
                                    <div class="invalid-feedback" id="editDeskripsiPengumuman_error"></div>
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
                        <button type="submit" class="btn btn-primary" id="editPengumumanBtn">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal View Pengumuman -->
    <div class="modal fade" id="viewPengumumanModal" tabindex="-1" aria-labelledby="viewPengumumanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewPengumumanModalLabel">
                        <i class="fas fa-eye me-2"></i>Detail Pengumuman
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="pengumuman-detail-image">
                                <img src="" alt="Pengumuman Detail" id="viewPengumumanImage"
                                    class="img-fluid rounded">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pengumuman-detail-info">
                                <h4 id="viewPengumumanTitle" class="mb-3"></h4>
                                <div class="detail-item">
                                    <label class="detail-label">Deskripsi:</label>
                                    <p id="viewPengumumanDescription" class="detail-content"></p>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <label class="detail-label">Status:</label>
                                            <span id="viewPengumumanStatus" class="badge"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <label class="detail-label">Urutan:</label>
                                            <span id="viewPengumumanUrutan" class="detail-content"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <label class="detail-label">Dibuat:</label>
                                            <span id="viewPengumumanCreated" class="detail-content"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <label class="detail-label">Diperbarui:</label>
                                            <span id="viewPengumumanUpdated" class="detail-content"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initManajemenPengumuman();
        });

        function initManajemenPengumuman() {
            initPengumumanUpload();
            initFormSubmissions();
            initViewToggle();
            initStatusToggle();
            initSearch();
        }

        function initPengumumanUpload() {
            const tambahUploadInput = document.getElementById('tambahFotoPengumuman');
            const tambahUploadWrapper = document.getElementById('tambahUploadWrapper');
            const tambahImagePreview = document.getElementById('tambahImagePreview');
            const tambahPreviewImage = document.getElementById('tambahPreviewImage');

            if (tambahUploadInput) {
                tambahUploadInput.addEventListener('change', function(e) {
                    handlePengumumanUpload(e, tambahUploadWrapper, tambahImagePreview, tambahPreviewImage);
                });

                initDragAndDrop(tambahUploadWrapper, tambahUploadInput);
            }

            const editUploadInput = document.getElementById('editFotoPengumuman');
            const editUploadWrapper = document.getElementById('editUploadWrapper');
            const editImagePreview = document.getElementById('editImagePreview');
            const editPreviewImage = document.getElementById('editPreviewImage');

            if (editUploadInput) {
                editUploadInput.addEventListener('change', function(e) {
                    handlePengumumanUpload(e, editUploadWrapper, editImagePreview, editPreviewImage);
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

        function handlePengumumanUpload(event, uploadWrapper, imagePreview, previewImage) {
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
                const uploadInput = document.getElementById('tambahFotoPengumuman');

                uploadWrapper.classList.remove('d-none');
                imagePreview.classList.add('d-none');
                uploadInput.value = '';
            } else if (type === 'edit') {
                const uploadWrapper = document.getElementById('editUploadWrapper');
                const imagePreview = document.getElementById('editImagePreview');
                const uploadInput = document.getElementById('editFotoPengumuman');

                uploadWrapper.classList.remove('d-none');
                imagePreview.classList.add('d-none');
                uploadInput.value = '';
            }
        }

        function initFormSubmissions() {
            const tambahPengumumanForm = document.getElementById('tambahPengumumanForm');
            if (tambahPengumumanForm) {
                tambahPengumumanForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    storePengumuman();
                });
            }

            const editPengumumanForm = document.getElementById('editPengumumanForm');
            if (editPengumumanForm) {
                editPengumumanForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    updatePengumuman();
                });
            }
        }

        function initViewToggle() {
            const viewButtons = document.querySelectorAll('.view-btn');
            const gridView = document.getElementById('pengumumanGridView');
            const listView = document.getElementById('pengumumanListView');

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
                    const pengumumanId = this.getAttribute('data-pengumuman-id');
                    const status = this.checked;

                    updatePengumumanStatus(pengumumanId, status);
                });
            });
        }

        function initSearch() {
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    const gridCards = document.querySelectorAll('.pengumuman-card');
                    const listRows = document.querySelectorAll('.pengumuman-list tbody tr');
                    gridCards.forEach(card => {
                        const title = card.querySelector('.pengumuman-title').textContent.toLowerCase();
                        const description = card.querySelector('.pengumuman-description').textContent
                            .toLowerCase();

                        if (title.includes(searchTerm) || description.includes(searchTerm)) {
                            card.style.display = '';
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    listRows.forEach(row => {
                        const title = row.querySelector('.pengumuman-title').textContent.toLowerCase();
                        const description = row.querySelector('.pengumuman-description').textContent
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

        function storePengumuman() {
            const form = document.getElementById('tambahPengumumanForm');
            const formData = new FormData(form);
            const submitBtn = document.getElementById('tambahPengumumanBtn');
            clearErrors('tambah');
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;

            fetch('{{ route('admin.manajemen-pengumuman.store') }}', {
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
                            bootstrap.Modal.getInstance(document.getElementById('tambahPengumumanModal'))
                        .hide();
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
                        text: 'Terjadi kesalahan saat menambahkan pengumuman.'
                    });
                })
                .finally(() => {
                    submitBtn.classList.remove('btn-loading');
                    submitBtn.disabled = false;
                });
        }

        function editPengumuman(pengumumanId) {
            const editPengumumanBtn = document.getElementById('editPengumumanBtn');
            editPengumumanBtn.classList.add('btn-loading');
            editPengumumanBtn.disabled = true;

            fetch(`/admin/manajemen-pengumuman/${pengumumanId}`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const pengumuman = data.pengumuman;
                        document.getElementById('editPengumumanId').value = pengumuman.id;
                        document.getElementById('editNamaPengumuman').value = pengumuman.nama_pengumuman;
                        document.getElementById('editDeskripsiPengumuman').value = pengumuman.deskripsi_pengumuman;
                        document.getElementById('editUrutan').value = pengumuman.urutan;
                        document.getElementById('editStatus').checked = pengumuman.status;
                        document.getElementById('editCurrentImage').src = pengumuman.foto_pengumuman_url;
                        removePreview('edit');
                        const modal = new bootstrap.Modal(document.getElementById('editPengumumanModal'));
                        modal.show();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal memuat data pengumuman.'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat memuat data pengumuman.'
                    });
                })
                .finally(() => {
                    editPengumumanBtn.classList.remove('btn-loading');
                    editPengumumanBtn.disabled = false;
                });
        }

        function viewPengumuman(pengumumanId) {
            fetch(`/admin/manajemen-pengumuman/${pengumumanId}`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const pengumuman = data.pengumuman;

                        document.getElementById('viewPengumumanImage').src = pengumuman.foto_pengumuman_url;
                        document.getElementById('viewPengumumanTitle').textContent = pengumuman.nama_pengumuman;
                        document.getElementById('viewPengumumanDescription').textContent = pengumuman
                            .deskripsi_pengumuman;
                        document.getElementById('viewPengumumanUrutan').textContent = '#' + pengumuman.urutan;
                        document.getElementById('viewPengumumanCreated').textContent = pengumuman.created_at;
                        document.getElementById('viewPengumumanUpdated').textContent = pengumuman.updated_at;
                        const statusBadge = document.getElementById('viewPengumumanStatus');
                        statusBadge.textContent = pengumuman.status ? 'Aktif' : 'Nonaktif';
                        statusBadge.className = pengumuman.status ? 'badge badge-active' : 'badge badge-inactive';
                        const modal = new bootstrap.Modal(document.getElementById('viewPengumumanModal'));
                        modal.show();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal memuat data pengumuman.'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat memuat data pengumuman.'
                    });
                });
        }

        function updatePengumuman() {
            const form = document.getElementById('editPengumumanForm');
            const formData = new FormData(form);
            const pengumumanId = document.getElementById('editPengumumanId').value;
            const submitBtn = document.getElementById('editPengumumanBtn');
            clearErrors('edit');
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;

            fetch(`/admin/manajemen-pengumuman/${pengumumanId}`, {
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
                            bootstrap.Modal.getInstance(document.getElementById('editPengumumanModal')).hide();
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
                        text: 'Terjadi kesalahan saat memperbarui pengumuman.'
                    });
                })
                .finally(() => {
                    submitBtn.classList.remove('btn-loading');
                    submitBtn.disabled = false;
                });
        }

        function updatePengumumanStatus(pengumumanId, status) {
            fetch(`/admin/manajemen-pengumuman/${pengumumanId}/status`, {
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
                        const toggle = document.querySelector(`.status-toggle[data-pengumuman-id="${pengumumanId}"]`);
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
                        text: 'Terjadi kesalahan saat memperbarui status pengumuman.'
                    });
                    const toggle = document.querySelector(`.status-toggle[data-pengumuman-id="${pengumumanId}"]`);
                    if (toggle) {
                        toggle.checked = !status;
                    }
                });
        }

        function deletePengumuman(pengumumanId) {
            Swal.fire({
                title: 'Hapus Pengumuman?',
                text: "Pengumuman akan dihapus permanen. Tindakan ini tidak dapat dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/manajemen-pengumuman/${pengumumanId}`, {
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
                                    const pengumumanCard = document.querySelector(
                                        `.pengumuman-card[data-pengumuman-id="${pengumumanId}"]`);
                                    const pengumumanRow = document.querySelector(
                                        `tr[data-pengumuman-id="${pengumumanId}"]`);

                                    if (pengumumanCard) pengumumanCard.remove();
                                    if (pengumumanRow) pengumumanRow.remove();
                                    if (document.querySelectorAll('.pengumuman-card').length === 0 &&
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
                                text: 'Terjadi kesalahan saat menghapus pengumuman.'
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

        window.editPengumuman = editPengumuman;
        window.viewPengumuman = viewPengumuman;
        window.deletePengumuman = deletePengumuman;
        window.removePreview = removePreview;
    </script>
@endsection
