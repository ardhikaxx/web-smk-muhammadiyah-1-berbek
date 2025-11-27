@extends('layouts.app')

@section('title', 'Manajemen Gallery')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/manajemen-gallery.css') }}">

    <div class="manajemen-gallery-container">
        <div class="page-header mb-2">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-title">Manajemen Gallery</h1>
                    <p class="page-subtitle">Kelola gallery kegiatan dan event SMK Muhammadiyah 1 Berbek</p>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahGalleryModal">
                        <i class="fas fa-plus me-2"></i>Tambah Gallery
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
                        <h3 class="stat-value">{{ $galleries->count() }}</h3>
                        <p class="stat-label">Total Gallery</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card success">
                    <div class="stat-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $galleries->where('status', true)->count() }}</h3>
                        <p class="stat-label">Gallery Aktif</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card warning">
                    <div class="stat-icon">
                        <i class="fas fa-eye-slash"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $galleries->where('status', false)->count() }}</h3>
                        <p class="stat-label">Gallery Nonaktif</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card info">
                    <div class="stat-icon">
                        <i class="fas fa-sort"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $galleries->max('urutan') ?? 0 }}</h3>
                        <p class="stat-label">Urutan Tertinggi</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="gallery-grid-card">
            <div class="card-header">
                <div class="header-content">
                    <i class="fas fa-th-large header-icon"></i>
                    <div>
                        <h3 class="card-title">Daftar Gallery</h3>
                        <p class="card-subtitle">Kelola semua gallery kegiatan yang ditampilkan di website</p>
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
                        <input type="text" id="searchInput" placeholder="Cari gallery...">
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if ($galleries->isEmpty())
                    <div class="empty-state">
                        <i class="fas fa-images fa-4x text-muted mb-4"></i>
                        <h4>Belum ada gallery</h4>
                        <p class="text-muted">Tambahkan gallery pertama untuk menampilkan kegiatan sekolah.</p>
                        <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#tambahGalleryModal">
                            <i class="fas fa-plus me-2"></i>Tambah Gallery Pertama
                        </button>
                    </div>
                @else
                    <div class="gallery-grid" id="galleryGridView">
                        @foreach ($galleries as $item)
                            <div class="gallery-card" data-gallery-id="{{ $item->id }}">
                                <div class="gallery-image">
                                    <img src="{{ $item->foto_gallery_url }}" alt="{{ $item->nama_gallery }}">
                                    <div class="gallery-overlay">
                                        <div class="action-buttons">
                                            <button class="btn btn-sm btn-edit" onclick="editGallery({{ $item->id }})"
                                                title="Edit Gallery">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-view" onclick="viewGallery({{ $item->id }})"
                                                title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-delete"
                                                onclick="deleteGallery({{ $item->id }})" title="Hapus Gallery">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="gallery-badges">
                                        <span class="badge badge-urutan">#{{ $item->urutan }}</span>
                                        @if ($item->status)
                                            <span class="badge badge-active">Aktif</span>
                                        @else
                                            <span class="badge badge-inactive">Nonaktif</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="gallery-content">
                                    <h6 class="gallery-title">{{ $item->nama_gallery }}</h6>
                                    <p class="gallery-description">{{ $item->deskripsi_pendek }}</p>
                                    <div class="gallery-meta">
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $item->created_at->format('d M Y') }}
                                        </small>
                                    </div>
                                    <div class="gallery-actions">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-toggle" type="checkbox"
                                                data-gallery-id="{{ $item->id }}"
                                                {{ $item->status ? 'checked' : '' }}>
                                            <label class="form-check-label">Aktif</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="gallery-list d-none" id="galleryListView">
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
                                    @foreach ($galleries as $item)
                                        <tr data-gallery-id="{{ $item->id }}">
                                            <td>
                                                <div class="gallery-thumb">
                                                    <img src="{{ $item->foto_gallery_url }}"
                                                        alt="{{ $item->nama_gallery }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="gallery-info">
                                                    <h6 class="gallery-title">{{ $item->nama_gallery }}</h6>
                                                    <p class="gallery-description">{{ $item->deskripsi_pendek }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        data-gallery-id="{{ $item->id }}"
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
                                                        onclick="editGallery({{ $item->id }})" title="Edit Gallery">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-view"
                                                        onclick="viewGallery({{ $item->id }})" title="Lihat Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-delete"
                                                        onclick="deleteGallery({{ $item->id }})"
                                                        title="Hapus Gallery">
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

    <div class="modal fade" id="tambahGalleryModal" tabindex="-1" aria-labelledby="tambahGalleryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahGalleryModalLabel">
                        <i class="fas fa-plus me-2"></i>Tambah Gallery Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="tambahGalleryForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="gallery-upload-area">
                                    <div class="upload-wrapper" id="tambahUploadWrapper">
                                        <div class="upload-placeholder" id="tambahUploadPreview">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <p>Klik untuk upload gambar</p>
                                            <small>Format: JPG, PNG, GIF, WEBP<br>Maksimal: 5MB</small>
                                        </div>
                                        <input type="file" name="foto_gallery" id="tambahFotoGallery"
                                            class="upload-input" accept="image/*" required>
                                    </div>
                                    <div class="image-preview d-none" id="tambahImagePreview">
                                        <img src="" alt="Preview" id="tambahPreviewImage">
                                        <button type="button" class="btn-remove-preview"
                                            onclick="removePreview('tambah')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="invalid-feedback" id="tambahFotoGallery_error"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tambahNamaGallery" class="form-label">Nama Gallery *</label>
                                    <input type="text" class="form-control" id="tambahNamaGallery"
                                        name="nama_gallery" placeholder="Masukkan nama gallery kegiatan" required>
                                    <div class="invalid-feedback" id="tambahNamaGallery_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="tambahDeskripsiGallery" class="form-label">Deskripsi Gallery *</label>
                                    <textarea class="form-control" id="tambahDeskripsiGallery" name="deskripsi_gallery" rows="4"
                                        placeholder="Masukkan deskripsi gallery kegiatan" required></textarea>
                                    <small class="form-text text-muted">Maksimal 1000 karakter</small>
                                    <div class="invalid-feedback" id="tambahDeskripsiGallery_error"></div>
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
                        <button type="submit" class="btn btn-primary" id="tambahGalleryBtn">
                            <i class="fas fa-save me-2"></i>Simpan Gallery
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editGalleryModal" tabindex="-1" aria-labelledby="editGalleryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGalleryModalLabel">
                        <i class="fas fa-edit me-2"></i>Edit Gallery
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editGalleryForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editGalleryId" name="id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="gallery-upload-area">
                                    <div class="current-image mb-3">
                                        <label class="form-label">Gambar Saat Ini</label>
                                        <div class="current-image-preview">
                                            <img src="" alt="Current Gallery" id="editCurrentImage">
                                        </div>
                                    </div>
                                    <div class="upload-wrapper" id="editUploadWrapper">
                                        <div class="upload-placeholder" id="editUploadPreview">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <p>Klik untuk ubah gambar</p>
                                            <small>Format: JPG, PNG, GIF, WEBP<br>Maksimal: 5MB</small>
                                        </div>
                                        <input type="file" name="foto_gallery" id="editFotoGallery"
                                            class="upload-input" accept="image/*">
                                    </div>
                                    <div class="image-preview d-none" id="editImagePreview">
                                        <img src="" alt="Preview" id="editPreviewImage">
                                        <button type="button" class="btn-remove-preview"
                                            onclick="removePreview('edit')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="invalid-feedback" id="editFotoGallery_error"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editNamaGallery" class="form-label">Nama Gallery *</label>
                                    <input type="text" class="form-control" id="editNamaGallery" name="nama_gallery"
                                        placeholder="Masukkan nama gallery kegiatan" required>
                                    <div class="invalid-feedback" id="editNamaGallery_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="editDeskripsiGallery" class="form-label">Deskripsi Gallery *</label>
                                    <textarea class="form-control" id="editDeskripsiGallery" name="deskripsi_gallery" rows="4"
                                        placeholder="Masukkan deskripsi gallery kegiatan" required></textarea>
                                    <small class="form-text text-muted">Maksimal 1000 karakter</small>
                                    <div class="invalid-feedback" id="editDeskripsiGallery_error"></div>
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
                        <button type="submit" class="btn btn-primary" id="editGalleryBtn">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewGalleryModal" tabindex="-1" aria-labelledby="viewGalleryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewGalleryModalLabel">
                        <i class="fas fa-eye me-2"></i>Detail Gallery
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="gallery-detail-image">
                                <img src="" alt="Gallery Detail" id="viewGalleryImage"
                                    class="img-fluid rounded">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="gallery-detail-info">
                                <h4 id="viewGalleryTitle" class="mb-3"></h4>
                                <div class="detail-item">
                                    <label class="detail-label">Deskripsi:</label>
                                    <p id="viewGalleryDescription" class="detail-content"></p>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <label class="detail-label">Status:</label>
                                            <span id="viewGalleryStatus" class="badge"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <label class="detail-label">Urutan:</label>
                                            <span id="viewGalleryUrutan" class="detail-content"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <label class="detail-label">Dibuat:</label>
                                            <span id="viewGalleryCreated" class="detail-content"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <label class="detail-label">Diperbarui:</label>
                                            <span id="viewGalleryUpdated" class="detail-content"></span>
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
            initManajemenGallery();
        });

        function initManajemenGallery() {
            initGalleryUpload();
            initFormSubmissions();
            initViewToggle();
            initStatusToggle();
            initSearch();
        }

        function initGalleryUpload() {
            const tambahUploadInput = document.getElementById('tambahFotoGallery');
            const tambahUploadWrapper = document.getElementById('tambahUploadWrapper');
            const tambahImagePreview = document.getElementById('tambahImagePreview');
            const tambahPreviewImage = document.getElementById('tambahPreviewImage');

            if (tambahUploadInput) {
                tambahUploadInput.addEventListener('change', function(e) {
                    handleGalleryUpload(e, tambahUploadWrapper, tambahImagePreview, tambahPreviewImage);
                });

                initDragAndDrop(tambahUploadWrapper, tambahUploadInput);
            }
            
            const editUploadInput = document.getElementById('editFotoGallery');
            const editUploadWrapper = document.getElementById('editUploadWrapper');
            const editImagePreview = document.getElementById('editImagePreview');
            const editPreviewImage = document.getElementById('editPreviewImage');

            if (editUploadInput) {
                editUploadInput.addEventListener('change', function(e) {
                    handleGalleryUpload(e, editUploadWrapper, editImagePreview, editPreviewImage);
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

        function handleGalleryUpload(event, uploadWrapper, imagePreview, previewImage) {
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
                const uploadInput = document.getElementById('tambahFotoGallery');

                uploadWrapper.classList.remove('d-none');
                imagePreview.classList.add('d-none');
                uploadInput.value = '';
            } else if (type === 'edit') {
                const uploadWrapper = document.getElementById('editUploadWrapper');
                const imagePreview = document.getElementById('editImagePreview');
                const uploadInput = document.getElementById('editFotoGallery');

                uploadWrapper.classList.remove('d-none');
                imagePreview.classList.add('d-none');
                uploadInput.value = '';
            }
        }

        function initFormSubmissions() {
            const tambahGalleryForm = document.getElementById('tambahGalleryForm');
            if (tambahGalleryForm) {
                tambahGalleryForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    storeGallery();
                });
            }

            const editGalleryForm = document.getElementById('editGalleryForm');
            if (editGalleryForm) {
                editGalleryForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    updateGallery();
                });
            }
        }

        function initViewToggle() {
            const viewButtons = document.querySelectorAll('.view-btn');
            const gridView = document.getElementById('galleryGridView');
            const listView = document.getElementById('galleryListView');

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
                    const galleryId = this.getAttribute('data-gallery-id');
                    const status = this.checked;

                    updateGalleryStatus(galleryId, status);
                });
            });
        }

        function initSearch() {
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    const gridCards = document.querySelectorAll('.gallery-card');
                    const listRows = document.querySelectorAll('.gallery-list tbody tr');
                    gridCards.forEach(card => {
                        const title = card.querySelector('.gallery-title').textContent.toLowerCase();
                        const description = card.querySelector('.gallery-description').textContent
                            .toLowerCase();

                        if (title.includes(searchTerm) || description.includes(searchTerm)) {
                            card.style.display = '';
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    listRows.forEach(row => {
                        const title = row.querySelector('.gallery-title').textContent.toLowerCase();
                        const description = row.querySelector('.gallery-description').textContent
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

        function storeGallery() {
            const form = document.getElementById('tambahGalleryForm');
            const formData = new FormData(form);
            const submitBtn = document.getElementById('tambahGalleryBtn');
            clearErrors('tambah');
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;

            fetch('{{ route('admin.manajemen-gallery.store') }}', {
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
                            bootstrap.Modal.getInstance(document.getElementById('tambahGalleryModal')).hide();
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
                        text: 'Terjadi kesalahan saat menambahkan gallery.'
                    });
                })
                .finally(() => {
                    submitBtn.classList.remove('btn-loading');
                    submitBtn.disabled = false;
                });
        }

        function editGallery(galleryId) {
            // Show loading state
            const editGalleryBtn = document.getElementById('editGalleryBtn');
            editGalleryBtn.classList.add('btn-loading');
            editGalleryBtn.disabled = true;

            fetch(`/admin/manajemen-gallery/${galleryId}`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const gallery = data.gallery;
                        document.getElementById('editGalleryId').value = gallery.id;
                        document.getElementById('editNamaGallery').value = gallery.nama_gallery;
                        document.getElementById('editDeskripsiGallery').value = gallery.deskripsi_gallery;
                        document.getElementById('editUrutan').value = gallery.urutan;
                        document.getElementById('editStatus').checked = gallery.status;
                        document.getElementById('editCurrentImage').src = gallery.foto_gallery_url;
                        removePreview('edit');
                        const modal = new bootstrap.Modal(document.getElementById('editGalleryModal'));
                        modal.show();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal memuat data gallery.'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat memuat data gallery.'
                    });
                })
                .finally(() => {
                    editGalleryBtn.classList.remove('btn-loading');
                    editGalleryBtn.disabled = false;
                });
        }

        function viewGallery(galleryId) {
            fetch(`/admin/manajemen-gallery/${galleryId}`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const gallery = data.gallery;

                        document.getElementById('viewGalleryImage').src = gallery.foto_gallery_url;
                        document.getElementById('viewGalleryTitle').textContent = gallery.nama_gallery;
                        document.getElementById('viewGalleryDescription').textContent = gallery.deskripsi_gallery;
                        document.getElementById('viewGalleryUrutan').textContent = '#' + gallery.urutan;
                        document.getElementById('viewGalleryCreated').textContent = gallery.created_at;
                        document.getElementById('viewGalleryUpdated').textContent = gallery.updated_at;
                        const statusBadge = document.getElementById('viewGalleryStatus');
                        statusBadge.textContent = gallery.status ? 'Aktif' : 'Nonaktif';
                        statusBadge.className = gallery.status ? 'badge badge-active' : 'badge badge-inactive';
                        const modal = new bootstrap.Modal(document.getElementById('viewGalleryModal'));
                        modal.show();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal memuat data gallery.'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat memuat data gallery.'
                    });
                });
        }

        function updateGallery() {
            const form = document.getElementById('editGalleryForm');
            const formData = new FormData(form);
            const galleryId = document.getElementById('editGalleryId').value;
            const submitBtn = document.getElementById('editGalleryBtn');
            clearErrors('edit');
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;

            fetch(`/admin/manajemen-gallery/${galleryId}`, {
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
                            bootstrap.Modal.getInstance(document.getElementById('editGalleryModal')).hide();
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
                        text: 'Terjadi kesalahan saat memperbarui gallery.'
                    });
                })
                .finally(() => {
                    submitBtn.classList.remove('btn-loading');
                    submitBtn.disabled = false;
                });
        }

        function updateGalleryStatus(galleryId, status) {
            fetch(`/admin/manajemen-gallery/${galleryId}/status`, {
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
                        const toggle = document.querySelector(`.status-toggle[data-gallery-id="${galleryId}"]`);
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
                        text: 'Terjadi kesalahan saat memperbarui status gallery.'
                    });
                    const toggle = document.querySelector(`.status-toggle[data-gallery-id="${galleryId}"]`);
                    if (toggle) {
                        toggle.checked = !status;
                    }
                });
        }

        function deleteGallery(galleryId) {
            Swal.fire({
                title: 'Hapus Gallery?',
                text: "Gallery akan dihapus permanen. Tindakan ini tidak dapat dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/manajemen-gallery/${galleryId}`, {
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
                                    const galleryCard = document.querySelector(
                                        `.gallery-card[data-gallery-id="${galleryId}"]`);
                                    const galleryRow = document.querySelector(
                                        `tr[data-gallery-id="${galleryId}"]`);

                                    if (galleryCard) galleryCard.remove();
                                    if (galleryRow) galleryRow.remove();
                                    if (document.querySelectorAll('.gallery-card').length === 0 &&
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
                                text: 'Terjadi kesalahan saat menghapus gallery.'
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

        window.editGallery = editGallery;
        window.viewGallery = viewGallery;
        window.deleteGallery = deleteGallery;
        window.removePreview = removePreview;
    </script>
@endsection
