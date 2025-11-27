@extends('layouts.app')

@section('title', 'Manajemen Tenaga Pendidik')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/manajemen-tenaga-pendidik.css') }}">

    <div class="manajemen-tenaga-pendidik-container">
        <div class="page-header mb-2">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-title">Manajemen Tenaga Pendidik</h1>
                    <p class="page-subtitle">Kelola data guru dan tenaga pendidik SMK Muhammadiyah 1 Berbek</p>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPengajarModal">
                        <i class="fas fa-plus me-2"></i>Tambah Pengajar
                    </button>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stat-card primary">
                    <div class="stat-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $pengajars->count() }}</h3>
                        <p class="stat-label">Total Pengajar</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card success">
                    <div class="stat-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $pengajars->where('status', true)->count() }}</h3>
                        <p class="stat-label">Pengajar Aktif</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card warning">
                    <div class="stat-icon">
                        <i class="fas fa-user-clock"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $pengajars->where('status', false)->count() }}</h3>
                        <p class="stat-label">Pengajar Nonaktif</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card info">
                    <div class="stat-icon">
                        <i class="fas fa-sort"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $pengajars->max('urutan') ?? 0 }}</h3>
                        <p class="stat-label">Urutan Tertinggi</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="pengajar-grid-card">
            <div class="card-header">
                <div class="header-content">
                    <i class="fas fa-users header-icon"></i>
                    <div>
                        <h3 class="card-title">Daftar Tenaga Pendidik</h3>
                        <p class="card-subtitle">Kelola semua guru dan tenaga pendidik yang aktif mengajar</p>
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
                        <input type="text" id="searchInput" placeholder="Cari pengajar...">
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if ($pengajars->isEmpty())
                    <div class="empty-state">
                        <i class="fas fa-chalkboard-teacher fa-4x text-muted mb-4"></i>
                        <h4>Belum ada tenaga pendidik</h4>
                        <p class="text-muted">Tambahkan tenaga pendidik pertama untuk ditampilkan di website.</p>
                        <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#tambahPengajarModal">
                            <i class="fas fa-plus me-2"></i>Tambah Pengajar Pertama
                        </button>
                    </div>
                @else
                    <div class="pengajar-grid" id="pengajarGridView">
                        @foreach ($pengajars as $pengajar)
                            <div class="pengajar-card" data-pengajar-id="{{ $pengajar->id }}">
                                <div class="pengajar-image">
                                    <img src="{{ $pengajar->foto_pengajar_url }}" alt="{{ $pengajar->nama_pengajar }}">
                                    <div class="pengajar-overlay">
                                        <div class="action-buttons">
                                            <button class="btn btn-sm btn-edit" onclick="editPengajar({{ $pengajar->id }})"
                                                title="Edit Pengajar">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-view" onclick="viewPengajar({{ $pengajar->id }})"
                                                title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-delete"
                                                onclick="deletePengajar({{ $pengajar->id }})" title="Hapus Pengajar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="pengajar-badges">
                                        <span class="badge badge-urutan">#{{ $pengajar->urutan }}</span>
                                        @if ($pengajar->status)
                                            <span class="badge badge-active">Aktif</span>
                                        @else
                                            <span class="badge badge-inactive">Nonaktif</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="pengajar-content">
                                    <h6 class="pengajar-title">{{ $pengajar->nama_pengajar }}</h6>
                                    <div class="pengajar-details">
                                        @if ($pengajar->nip)
                                            <div class="detail-item">
                                                <i class="fas fa-id-card"></i>
                                                <span>{{ $pengajar->nip }}</span>
                                            </div>
                                        @endif
                                        <div class="detail-item">
                                            <i class="fas fa-briefcase"></i>
                                            <span>{{ $pengajar->jabatan_pendek }}</span>
                                        </div>
                                    </div>
                                    <div class="pengajar-meta">
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $pengajar->created_at->format('d M Y') }}
                                        </small>
                                    </div>
                                    <div class="pengajar-actions">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-toggle" type="checkbox"
                                                data-pengajar-id="{{ $pengajar->id }}"
                                                {{ $pengajar->status ? 'checked' : '' }}>
                                            <label class="form-check-label">Aktif</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="pengajar-list d-none" id="pengajarListView">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Informasi</th>
                                        <th>Jabatan</th>
                                        <th>Status</th>
                                        <th>Urutan</th>
                                        <th>Tanggal</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengajars as $pengajar)
                                        <tr data-pengajar-id="{{ $pengajar->id }}">
                                            <td>
                                                <div class="pengajar-thumb">
                                                    <img src="{{ $pengajar->foto_pengajar_url }}"
                                                        alt="{{ $pengajar->nama_pengajar }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="pengajar-info">
                                                    <h6 class="pengajar-title">{{ $pengajar->nama_pengajar }}</h6>
                                                    @if ($pengajar->nip)
                                                        <p class="pengajar-nip">{{ $pengajar->nip }}</p>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <span class="pengajar-jabatan">{{ $pengajar->jabatan }}</span>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        data-pengajar-id="{{ $pengajar->id }}"
                                                        {{ $pengajar->status ? 'checked' : '' }}>
                                                    <label class="form-check-label">
                                                        {{ $pengajar->status ? 'Aktif' : 'Nonaktif' }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="urutan-badge">#{{ $pengajar->urutan }}</span>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $pengajar->created_at->format('d M Y') }}
                                                </small>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-sm btn-edit"
                                                        onclick="editPengajar({{ $pengajar->id }})"
                                                        title="Edit Pengajar">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-view"
                                                        onclick="viewPengajar({{ $pengajar->id }})" title="Lihat Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-delete"
                                                        onclick="deletePengajar({{ $pengajar->id }})"
                                                        title="Hapus Pengajar">
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

    <div class="modal fade" id="tambahPengajarModal" tabindex="-1" aria-labelledby="tambahPengajarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPengajarModalLabel">
                        <i class="fas fa-plus me-2"></i>Tambah Tenaga Pendidik
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="tambahPengajarForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="pengajar-upload-area">
                                    <div class="upload-wrapper" id="tambahUploadWrapper">
                                        <div class="upload-placeholder" id="tambahUploadPreview">
                                            <i class="fas fa-user-plus"></i>
                                            <p>Klik untuk upload foto</p>
                                            <small>Format: JPG, PNG, GIF, WEBP<br>Maksimal: 5MB</small>
                                        </div>
                                        <input type="file" name="foto_pengajar" id="tambahFotoPengajar"
                                            class="upload-input" accept="image/*">
                                    </div>
                                    <div class="image-preview d-none" id="tambahImagePreview">
                                        <img src="" alt="Preview" id="tambahPreviewImage">
                                        <button type="button" class="btn-remove-preview"
                                            onclick="removePreview('tambah')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <small class="text-muted mt-2 d-block">Opsional. Jika tidak diisi akan menggunakan foto
                                        default.</small>
                                    <div class="invalid-feedback" id="tambahFotoPengajar_error"></div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="tambahNamaPengajar" class="form-label">Nama Lengkap *</label>
                                    <input type="text" class="form-control" id="tambahNamaPengajar"
                                        name="nama_pengajar" placeholder="Masukkan nama lengkap pengajar" required>
                                    <div class="invalid-feedback" id="tambahNamaPengajar_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="tambahNip" class="form-label">NIP</label>
                                    <input type="text" class="form-control" id="tambahNip" name="nip"
                                        placeholder="Masukkan NIP pengajar (opsional)">
                                    <div class="invalid-feedback" id="tambahNip_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="tambahJabatan" class="form-label">Jabatan *</label>
                                    <input type="text" class="form-control" id="tambahJabatan" name="jabatan"
                                        placeholder="Contoh: Guru Matematika, Wali Kelas, dll" required>
                                    <div class="invalid-feedback" id="tambahJabatan_error"></div>
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
                        <button type="submit" class="btn btn-primary" id="tambahPengajarBtn">
                            <i class="fas fa-save me-2"></i>Simpan Pengajar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editPengajarModal" tabindex="-1" aria-labelledby="editPengajarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPengajarModalLabel">
                        <i class="fas fa-edit me-2"></i>Edit Tenaga Pendidik
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editPengajarForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editPengajarId" name="id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="pengajar-upload-area">
                                    <div class="current-image mb-3">
                                        <label class="form-label">Foto Saat Ini</label>
                                        <div class="current-image-preview">
                                            <img src="" alt="Current Pengajar" id="editCurrentImage">
                                        </div>
                                    </div>
                                    <div class="upload-wrapper" id="editUploadWrapper">
                                        <div class="upload-placeholder" id="editUploadPreview">
                                            <i class="fas fa-camera"></i>
                                            <p>Klik untuk ubah foto</p>
                                            <small>Format: JPG, PNG, GIF, WEBP<br>Maksimal: 5MB</small>
                                        </div>
                                        <input type="file" name="foto_pengajar" id="editFotoPengajar"
                                            class="upload-input" accept="image/*">
                                    </div>
                                    <div class="image-preview d-none" id="editImagePreview">
                                        <img src="" alt="Preview" id="editPreviewImage">
                                        <button type="button" class="btn-remove-preview"
                                            onclick="removePreview('edit')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <small class="text-muted mt-2 d-block">Kosongkan jika tidak ingin mengubah
                                        foto.</small>
                                    <div class="invalid-feedback" id="editFotoPengajar_error"></div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="editNamaPengajar" class="form-label">Nama Lengkap *</label>
                                    <input type="text" class="form-control" id="editNamaPengajar"
                                        name="nama_pengajar" placeholder="Masukkan nama lengkap pengajar" required>
                                    <div class="invalid-feedback" id="editNamaPengajar_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="editNip" class="form-label">NIP</label>
                                    <input type="text" class="form-control" id="editNip" name="nip"
                                        placeholder="Masukkan NIP pengajar (opsional)">
                                    <div class="invalid-feedback" id="editNip_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="editJabatan" class="form-label">Jabatan *</label>
                                    <input type="text" class="form-control" id="editJabatan" name="jabatan"
                                        placeholder="Contoh: Guru Matematika, Wali Kelas, dll" required>
                                    <div class="invalid-feedback" id="editJabatan_error"></div>
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
                        <button type="submit" class="btn btn-primary" id="editPengajarBtn">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewPengajarModal" tabindex="-1" aria-labelledby="viewPengajarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewPengajarModalLabel">
                        <i class="fas fa-eye me-2"></i>Detail Tenaga Pendidik
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="pengajar-detail-image">
                                <img src="" alt="Pengajar Detail" id="viewPengajarImage"
                                    class="img-fluid rounded">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="pengajar-detail-info">
                                <h4 id="viewPengajarTitle" class="mb-3"></h4>
                                <div class="detail-item">
                                    <label class="detail-label">NIP:</label>
                                    <span id="viewPengajarNip" class="detail-content">-</span>
                                </div>
                                <div class="detail-item">
                                    <label class="detail-label">Jabatan:</label>
                                    <span id="viewPengajarJabatan" class="detail-content"></span>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <label class="detail-label">Status:</label>
                                            <span id="viewPengajarStatus" class="badge"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <label class="detail-label">Urutan:</label>
                                            <span id="viewPengajarUrutan" class="detail-content"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <label class="detail-label">Dibuat:</label>
                                            <span id="viewPengajarCreated" class="detail-content"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <label class="detail-label">Diperbarui:</label>
                                            <span id="viewPengajarUpdated" class="detail-content"></span>
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
            initManajemenTenagaPendidik();
        });

        function initManajemenTenagaPendidik() {
            initPengajarUpload();
            initFormSubmissions();
            initViewToggle();
            initStatusToggle();
            initSearch();
        }

        function initPengajarUpload() {
            const tambahUploadInput = document.getElementById('tambahFotoPengajar');
            const tambahUploadWrapper = document.getElementById('tambahUploadWrapper');
            const tambahImagePreview = document.getElementById('tambahImagePreview');
            const tambahPreviewImage = document.getElementById('tambahPreviewImage');

            if (tambahUploadInput) {
                tambahUploadInput.addEventListener('change', function(e) {
                    handlePengajarUpload(e, tambahUploadWrapper, tambahImagePreview, tambahPreviewImage);
                });

                initDragAndDrop(tambahUploadWrapper, tambahUploadInput);
            }

            const editUploadInput = document.getElementById('editFotoPengajar');
            const editUploadWrapper = document.getElementById('editUploadWrapper');
            const editImagePreview = document.getElementById('editImagePreview');
            const editPreviewImage = document.getElementById('editPreviewImage');

            if (editUploadInput) {
                editUploadInput.addEventListener('change', function(e) {
                    handlePengajarUpload(e, editUploadWrapper, editImagePreview, editPreviewImage);
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

        function handlePengajarUpload(event, uploadWrapper, imagePreview, previewImage) {
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
                const uploadInput = document.getElementById('tambahFotoPengajar');

                uploadWrapper.classList.remove('d-none');
                imagePreview.classList.add('d-none');
                uploadInput.value = '';
            } else if (type === 'edit') {
                const uploadWrapper = document.getElementById('editUploadWrapper');
                const imagePreview = document.getElementById('editImagePreview');
                const uploadInput = document.getElementById('editFotoPengajar');

                uploadWrapper.classList.remove('d-none');
                imagePreview.classList.add('d-none');
                uploadInput.value = '';
            }
        }

        function initFormSubmissions() {
            const tambahPengajarForm = document.getElementById('tambahPengajarForm');
            if (tambahPengajarForm) {
                tambahPengajarForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    storePengajar();
                });
            }

            const editPengajarForm = document.getElementById('editPengajarForm');
            if (editPengajarForm) {
                editPengajarForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    updatePengajar();
                });
            }
        }

        function initViewToggle() {
            const viewButtons = document.querySelectorAll('.view-btn');
            const gridView = document.getElementById('pengajarGridView');
            const listView = document.getElementById('pengajarListView');

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
                    const pengajarId = this.getAttribute('data-pengajar-id');
                    const status = this.checked;

                    updatePengajarStatus(pengajarId, status);
                });
            });
        }

        function initSearch() {
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    const gridCards = document.querySelectorAll('.pengajar-card');
                    const listRows = document.querySelectorAll('.pengajar-list tbody tr');
                    gridCards.forEach(card => {
                        const title = card.querySelector('.pengajar-title').textContent.toLowerCase();
                        const nip = card.querySelector('.pengajar-nip') ? card.querySelector(
                            '.pengajar-nip').textContent.toLowerCase() : '';
                        const jabatan = card.querySelector('.pengajar-jabatan') ? card.querySelector(
                            '.pengajar-jabatan').textContent.toLowerCase() : '';

                        if (title.includes(searchTerm) || nip.includes(searchTerm) || jabatan.includes(
                                searchTerm)) {
                            card.style.display = '';
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    listRows.forEach(row => {
                        const title = row.querySelector('.pengajar-title').textContent.toLowerCase();
                        const nip = row.querySelector('.pengajar-nip') ? row.querySelector('.pengajar-nip')
                            .textContent.toLowerCase() : '';
                        const jabatan = row.querySelector('.pengajar-jabatan').textContent.toLowerCase();

                        if (title.includes(searchTerm) || nip.includes(searchTerm) || jabatan.includes(
                                searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }
        }

        function storePengajar() {
            const form = document.getElementById('tambahPengajarForm');
            const formData = new FormData(form);
            const submitBtn = document.getElementById('tambahPengajarBtn');
            clearErrors('tambah');
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;

            fetch('{{ route('admin.tenaga-pendidik.store') }}', {
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
                            bootstrap.Modal.getInstance(document.getElementById('tambahPengajarModal')).hide();
                            form.reset();
                            // Reset preview
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
                        text: 'Terjadi kesalahan saat menambahkan tenaga pendidik.'
                    });
                })
                .finally(() => {
                    submitBtn.classList.remove('btn-loading');
                    submitBtn.disabled = false;
                });
        }

        function editPengajar(pengajarId) {
            const editPengajarBtn = document.getElementById('editPengajarBtn');
            editPengajarBtn.classList.add('btn-loading');
            editPengajarBtn.disabled = true;

            fetch(`/admin/tenaga-pendidik/${pengajarId}`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const pengajar = data.pengajar;
                        document.getElementById('editPengajarId').value = pengajar.id;
                        document.getElementById('editNamaPengajar').value = pengajar.nama_pengajar;
                        document.getElementById('editNip').value = pengajar.nip || '';
                        document.getElementById('editJabatan').value = pengajar.jabatan;
                        document.getElementById('editUrutan').value = pengajar.urutan;
                        document.getElementById('editStatus').checked = pengajar.status;
                        document.getElementById('editCurrentImage').src = pengajar.foto_pengajar_url;
                        removePreview('edit');
                        const modal = new bootstrap.Modal(document.getElementById('editPengajarModal'));
                        modal.show();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal memuat data tenaga pendidik.'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat memuat data tenaga pendidik.'
                    });
                })
                .finally(() => {
                    editPengajarBtn.classList.remove('btn-loading');
                    editPengajarBtn.disabled = false;
                });
        }

        function viewPengajar(pengajarId) {
            fetch(`/admin/tenaga-pendidik/${pengajarId}`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const pengajar = data.pengajar;
                        document.getElementById('viewPengajarImage').src = pengajar.foto_pengajar_url;
                        document.getElementById('viewPengajarTitle').textContent = pengajar.nama_pengajar;
                        document.getElementById('viewPengajarNip').textContent = pengajar.nip || '-';
                        document.getElementById('viewPengajarJabatan').textContent = pengajar.jabatan;
                        document.getElementById('viewPengajarUrutan').textContent = '#' + pengajar.urutan;
                        document.getElementById('viewPengajarCreated').textContent = pengajar.created_at;
                        document.getElementById('viewPengajarUpdated').textContent = pengajar.updated_at;
                        const statusBadge = document.getElementById('viewPengajarStatus');
                        statusBadge.textContent = pengajar.status ? 'Aktif' : 'Nonaktif';
                        statusBadge.className = pengajar.status ? 'badge badge-active' : 'badge badge-inactive';
                        const modal = new bootstrap.Modal(document.getElementById('viewPengajarModal'));
                        modal.show();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal memuat data tenaga pendidik.'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat memuat data tenaga pendidik.'
                    });
                });
        }

        function updatePengajar() {
            const form = document.getElementById('editPengajarForm');
            const formData = new FormData(form);
            const pengajarId = document.getElementById('editPengajarId').value;
            const submitBtn = document.getElementById('editPengajarBtn');
            clearErrors('edit');
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;

            fetch(`/admin/tenaga-pendidik/${pengajarId}`, {
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
                            bootstrap.Modal.getInstance(document.getElementById('editPengajarModal')).hide();
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
                        text: 'Terjadi kesalahan saat memperbarui tenaga pendidik.'
                    });
                })
                .finally(() => {
                    submitBtn.classList.remove('btn-loading');
                    submitBtn.disabled = false;
                });
        }

        function updatePengajarStatus(pengajarId, status) {
            fetch(`/admin/tenaga-pendidik/${pengajarId}/status`, {
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
                        const toggle = document.querySelector(`.status-toggle[data-pengajar-id="${pengajarId}"]`);
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
                        text: 'Terjadi kesalahan saat memperbarui status tenaga pendidik.'
                    });

                    const toggle = document.querySelector(`.status-toggle[data-pengajar-id="${pengajarId}"]`);
                    if (toggle) {
                        toggle.checked = !status;
                    }
                });
        }

        function deletePengajar(pengajarId) {
            Swal.fire({
                title: 'Hapus Tenaga Pendidik?',
                text: "Data tenaga pendidik akan dihapus permanen. Tindakan ini tidak dapat dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/tenaga-pendidik/${pengajarId}`, {
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
                                    const pengajarCard = document.querySelector(
                                        `.pengajar-card[data-pengajar-id="${pengajarId}"]`);
                                    const pengajarRow = document.querySelector(
                                        `tr[data-pengajar-id="${pengajarId}"]`);
                                    if (pengajarCard) pengajarCard.remove();
                                    if (pengajarRow) pengajarRow.remove();
                                    if (document.querySelectorAll('.pengajar-card').length === 0 &&
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
                                text: 'Terjadi kesalahan saat menghapus tenaga pendidik.'
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

        window.editPengajar = editPengajar;
        window.viewPengajar = viewPengajar;
        window.deletePengajar = deletePengajar;
        window.removePreview = removePreview;
    </script>
@endsection
