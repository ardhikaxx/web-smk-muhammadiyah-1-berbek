@extends('layouts.app')

@section('title', 'Manajemen Prestasi')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/manajemen-prestasi.css') }}">

    <div class="manajemen-prestasi-container">
        <div class="page-header mb-2">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-title">Manajemen Prestasi</h1>
                    <p class="page-subtitle">Kelola prestasi siswa SMK Muhammadiyah 1 Berbek</p>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPrestasiModal">
                        <i class="fas fa-plus me-2"></i>Tambah Prestasi
                    </button>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stat-card primary">
                    <div class="stat-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $prestasis->count() }}</h3>
                        <p class="stat-label">Total Prestasi</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card success">
                    <div class="stat-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $prestasis->where('status', true)->count() }}</h3>
                        <p class="stat-label">Prestasi Aktif</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card warning">
                    <div class="stat-icon">
                        <i class="fas fa-eye-slash"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $prestasis->where('status', false)->count() }}</h3>
                        <p class="stat-label">Prestasi Nonaktif</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card info">
                    <div class="stat-icon">
                        <i class="fas fa-sort"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $prestasis->max('urutan') ?? 0 }}</h3>
                        <p class="stat-label">Urutan Tertinggi</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="prestasi-grid-card">
            <div class="card-header">
                <div class="header-content">
                    <i class="fas fa-trophy header-icon"></i>
                    <div>
                        <h3 class="card-title">Daftar Prestasi</h3>
                        <p class="card-subtitle">Kelola semua prestasi siswa yang ditampilkan di website</p>
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
                        <input type="text" id="searchInput" placeholder="Cari prestasi...">
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if ($prestasis->isEmpty())
                    <div class="empty-state">
                        <i class="fas fa-trophy fa-4x text-muted mb-4"></i>
                        <h4>Belum ada prestasi</h4>
                        <p class="text-muted">Tambahkan prestasi pertama untuk menampilkan pencapaian siswa.</p>
                        <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#tambahPrestasiModal">
                            <i class="fas fa-plus me-2"></i>Tambah Prestasi Pertama
                        </button>
                    </div>
                @else
                    <div class="prestasi-grid" id="prestasiGridView">
                        @foreach ($prestasis as $item)
                            <div class="prestasi-card" data-prestasi-id="{{ $item->id }}">
                                <div class="prestasi-image">
                                    <img src="{{ $item->foto_prestasi_url }}" alt="{{ $item->nama_prestasi }}">
                                    <div class="prestasi-overlay">
                                        <div class="action-buttons">
                                            <button class="btn btn-sm btn-edit" onclick="editPrestasi({{ $item->id }})"
                                                title="Edit Prestasi">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-view" onclick="viewPrestasi({{ $item->id }})"
                                                title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-delete"
                                                onclick="deletePrestasi({{ $item->id }})" title="Hapus Prestasi">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="prestasi-badges">
                                        <span class="badge badge-urutan">#{{ $item->urutan }}</span>
                                        @if ($item->status)
                                            <span class="badge badge-active">Aktif</span>
                                        @else
                                            <span class="badge badge-inactive">Nonaktif</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="prestasi-content">
                                    <h6 class="prestasi-title">{{ $item->nama_prestasi }}</h6>
                                    <div class="prestasi-info">
                                        <div class="info-item">
                                            <i class="fas fa-user"></i>
                                            <span>{{ $item->nama_siswa }}</span>
                                        </div>
                                        <div class="info-item">
                                            <i class="fas fa-graduation-cap"></i>
                                            <span>{{ $item->jurusan }}</span>
                                        </div>
                                        <div class="info-item">
                                            <i class="fas fa-medal"></i>
                                            <span>{{ $item->peringkat }}</span>
                                        </div>
                                        <div class="info-item">
                                            <i class="fas fa-calendar"></i>
                                            <span>{{ $item->tahun_prestasi }}</span>
                                        </div>
                                    </div>
                                    <div class="prestasi-actions">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-toggle" type="checkbox"
                                                data-prestasi-id="{{ $item->id }}"
                                                {{ $item->status ? 'checked' : '' }}>
                                            <label class="form-check-label">Aktif</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="prestasi-list d-none" id="prestasiListView">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Informasi Prestasi</th>
                                        <th>Siswa & Jurusan</th>
                                        <th>Peringkat & Tahun</th>
                                        <th>Status</th>
                                        <th>Urutan</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prestasis as $item)
                                        <tr data-prestasi-id="{{ $item->id }}">
                                            <td>
                                                <div class="prestasi-thumb">
                                                    <img src="{{ $item->foto_prestasi_url }}"
                                                        alt="{{ $item->nama_prestasi }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="prestasi-info-list">
                                                    <h6 class="prestasi-title">{{ $item->nama_prestasi }}</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="student-info">
                                                    <strong>{{ $item->nama_siswa }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ $item->jurusan }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="achievement-info">
                                                    <span class="badge bg-warning">{{ $item->peringkat }}</span>
                                                    <br>
                                                    <small class="text-muted">{{ $item->tahun_prestasi }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        data-prestasi-id="{{ $item->id }}"
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
                                                <div class="action-buttons">
                                                    <button class="btn btn-sm btn-edit"
                                                        onclick="editPrestasi({{ $item->id }})" title="Edit Prestasi">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-view"
                                                        onclick="viewPrestasi({{ $item->id }})" title="Lihat Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-delete"
                                                        onclick="deletePrestasi({{ $item->id }})"
                                                        title="Hapus Prestasi">
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

    <!-- Modal Tambah Prestasi -->
    <div class="modal fade" id="tambahPrestasiModal" tabindex="-1" aria-labelledby="tambahPrestasiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPrestasiModalLabel">
                        <i class="fas fa-plus me-2"></i>Tambah Prestasi Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="tambahPrestasiForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="prestasi-upload-area">
                                    <div class="upload-wrapper" id="tambahUploadWrapper">
                                        <div class="upload-placeholder" id="tambahUploadPreview">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <p>Klik untuk upload gambar</p>
                                            <small>Format: JPG, PNG, GIF, WEBP<br>Maksimal: 5MB</small>
                                        </div>
                                        <input type="file" name="foto_prestasi" id="tambahFotoPrestasi"
                                            class="upload-input" accept="image/*" required>
                                    </div>
                                    <div class="image-preview d-none" id="tambahImagePreview">
                                        <img src="" alt="Preview" id="tambahPreviewImage">
                                        <button type="button" class="btn-remove-preview"
                                            onclick="removePreview('tambah')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="invalid-feedback" id="tambahFotoPrestasi_error"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tambahNamaSiswa" class="form-label">Nama Siswa *</label>
                                    <input type="text" class="form-control" id="tambahNamaSiswa"
                                        name="nama_siswa" placeholder="Masukkan nama siswa" required>
                                    <div class="invalid-feedback" id="tambahNamaSiswa_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="tambahJurusan" class="form-label">Jurusan *</label>
                                    <input type="text" class="form-control" id="tambahJurusan"
                                        name="jurusan" placeholder="Masukkan jurusan siswa" required>
                                    <div class="invalid-feedback" id="tambahJurusan_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="tambahNamaPrestasi" class="form-label">Nama Prestasi *</label>
                                    <input type="text" class="form-control" id="tambahNamaPrestasi"
                                        name="nama_prestasi" placeholder="Masukkan nama prestasi" required>
                                    <div class="invalid-feedback" id="tambahNamaPrestasi_error"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tambahPeringkat" class="form-label">Peringkat *</label>
                                            <input type="text" class="form-control" id="tambahPeringkat"
                                                name="peringkat" placeholder="Contoh: Juara 1" required>
                                            <div class="invalid-feedback" id="tambahPeringkat_error"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tambahTahunPrestasi" class="form-label">Tahun Prestasi *</label>
                                            <input type="number" class="form-control" id="tambahTahunPrestasi"
                                                name="tahun_prestasi" 
                                                min="2000" 
                                                max="{{ date('Y') + 1 }}"
                                                value="{{ date('Y') }}"
                                                required>
                                            <div class="invalid-feedback" id="tambahTahunPrestasi_error"></div>
                                        </div>
                                    </div>
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
                        <button type="submit" class="btn btn-primary" id="tambahPrestasiBtn">
                            <i class="fas fa-save me-2"></i>Simpan Prestasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Prestasi -->
    <div class="modal fade" id="editPrestasiModal" tabindex="-1" aria-labelledby="editPrestasiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPrestasiModalLabel">
                        <i class="fas fa-edit me-2"></i>Edit Prestasi
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editPrestasiForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editPrestasiId" name="id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="prestasi-upload-area">
                                    <div class="current-image mb-3">
                                        <label class="form-label">Gambar Saat Ini</label>
                                        <div class="current-image-preview">
                                            <img src="" alt="Current Prestasi" id="editCurrentImage">
                                        </div>
                                    </div>
                                    <div class="upload-wrapper" id="editUploadWrapper">
                                        <div class="upload-placeholder" id="editUploadPreview">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <p>Klik untuk ubah gambar</p>
                                            <small>Format: JPG, PNG, GIF, WEBP<br>Maksimal: 5MB</small>
                                        </div>
                                        <input type="file" name="foto_prestasi" id="editFotoPrestasi"
                                            class="upload-input" accept="image/*">
                                    </div>
                                    <div class="image-preview d-none" id="editImagePreview">
                                        <img src="" alt="Preview" id="editPreviewImage">
                                        <button type="button" class="btn-remove-preview"
                                            onclick="removePreview('edit')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="invalid-feedback" id="editFotoPrestasi_error"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editNamaSiswa" class="form-label">Nama Siswa *</label>
                                    <input type="text" class="form-control" id="editNamaSiswa" name="nama_siswa"
                                        placeholder="Masukkan nama siswa" required>
                                    <div class="invalid-feedback" id="editNamaSiswa_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="editJurusan" class="form-label">Jurusan *</label>
                                    <input type="text" class="form-control" id="editJurusan" name="jurusan"
                                        placeholder="Masukkan jurusan siswa" required>
                                    <div class="invalid-feedback" id="editJurusan_error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="editNamaPrestasi" class="form-label">Nama Prestasi *</label>
                                    <input type="text" class="form-control" id="editNamaPrestasi" name="nama_prestasi"
                                        placeholder="Masukkan nama prestasi" required>
                                    <div class="invalid-feedback" id="editNamaPrestasi_error"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editPeringkat" class="form-label">Peringkat *</label>
                                            <input type="text" class="form-control" id="editPeringkat"
                                                name="peringkat" placeholder="Contoh: Juara 1" required>
                                            <div class="invalid-feedback" id="editPeringkat_error"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editTahunPrestasi" class="form-label">Tahun Prestasi *</label>
                                            <input type="number" class="form-control" id="editTahunPrestasi"
                                                name="tahun_prestasi" 
                                                min="2000" 
                                                max="{{ date('Y') + 1 }}"
                                                required>
                                            <div class="invalid-feedback" id="editTahunPrestasi_error"></div>
                                        </div>
                                    </div>
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
                        <button type="submit" class="btn btn-primary" id="editPrestasiBtn">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal View Prestasi -->
    <div class="modal fade" id="viewPrestasiModal" tabindex="-1" aria-labelledby="viewPrestasiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewPrestasiModalLabel">
                        <i class="fas fa-eye me-2"></i>Detail Prestasi
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="prestasi-detail-image">
                                <img src="" alt="Prestasi Detail" id="viewPrestasiImage"
                                    class="img-fluid rounded">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="prestasi-detail-info">
                                <h4 id="viewPrestasiTitle" class="mb-3"></h4>
                                <div class="detail-item">
                                    <label class="detail-label">Nama Siswa:</label>
                                    <p id="viewPrestasiSiswa" class="detail-content"></p>
                                </div>
                                <div class="detail-item">
                                    <label class="detail-label">Jurusan:</label>
                                    <p id="viewPrestasiJurusan" class="detail-content"></p>
                                </div>
                                <div class="detail-item">
                                    <label class="detail-label">Peringkat:</label>
                                    <p id="viewPrestasiPeringkat" class="detail-content"></p>
                                </div>
                                <div class="detail-item">
                                    <label class="detail-label">Tahun Prestasi:</label>
                                    <p id="viewPrestasiTahun" class="detail-content"></p>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <label class="detail-label">Status:</label>
                                            <span id="viewPrestasiStatus" class="badge"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <label class="detail-label">Urutan:</label>
                                            <span id="viewPrestasiUrutan" class="detail-content"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <label class="detail-label">Dibuat:</label>
                                            <span id="viewPrestasiCreated" class="detail-content"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <label class="detail-label">Diperbarui:</label>
                                            <span id="viewPrestasiUpdated" class="detail-content"></span>
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
            initManajemenPrestasi();
        });

        function initManajemenPrestasi() {
            initPrestasiUpload();
            initFormSubmissions();
            initViewToggle();
            initStatusToggle();
            initSearch();
        }

        function initPrestasiUpload() {
            const tambahUploadInput = document.getElementById('tambahFotoPrestasi');
            const tambahUploadWrapper = document.getElementById('tambahUploadWrapper');
            const tambahImagePreview = document.getElementById('tambahImagePreview');
            const tambahPreviewImage = document.getElementById('tambahPreviewImage');

            if (tambahUploadInput) {
                tambahUploadInput.addEventListener('change', function(e) {
                    handlePrestasiUpload(e, tambahUploadWrapper, tambahImagePreview, tambahPreviewImage);
                });

                initDragAndDrop(tambahUploadWrapper, tambahUploadInput);
            }
            
            const editUploadInput = document.getElementById('editFotoPrestasi');
            const editUploadWrapper = document.getElementById('editUploadWrapper');
            const editImagePreview = document.getElementById('editImagePreview');
            const editPreviewImage = document.getElementById('editPreviewImage');

            if (editUploadInput) {
                editUploadInput.addEventListener('change', function(e) {
                    handlePrestasiUpload(e, editUploadWrapper, editImagePreview, editPreviewImage);
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

        function handlePrestasiUpload(event, uploadWrapper, imagePreview, previewImage) {
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
                const uploadInput = document.getElementById('tambahFotoPrestasi');

                uploadWrapper.classList.remove('d-none');
                imagePreview.classList.add('d-none');
                uploadInput.value = '';
            } else if (type === 'edit') {
                const uploadWrapper = document.getElementById('editUploadWrapper');
                const imagePreview = document.getElementById('editImagePreview');
                const uploadInput = document.getElementById('editFotoPrestasi');

                uploadWrapper.classList.remove('d-none');
                imagePreview.classList.add('d-none');
                uploadInput.value = '';
            }
        }

        function initFormSubmissions() {
            const tambahPrestasiForm = document.getElementById('tambahPrestasiForm');
            if (tambahPrestasiForm) {
                tambahPrestasiForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    storePrestasi();
                });
            }

            const editPrestasiForm = document.getElementById('editPrestasiForm');
            if (editPrestasiForm) {
                editPrestasiForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    updatePrestasi();
                });
            }
        }

        function initViewToggle() {
            const viewButtons = document.querySelectorAll('.view-btn');
            const gridView = document.getElementById('prestasiGridView');
            const listView = document.getElementById('prestasiListView');

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
                    const prestasiId = this.getAttribute('data-prestasi-id');
                    const status = this.checked;

                    updatePrestasiStatus(prestasiId, status);
                });
            });
        }

        function initSearch() {
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    const gridCards = document.querySelectorAll('.prestasi-card');
                    const listRows = document.querySelectorAll('.prestasi-list tbody tr');
                    
                    gridCards.forEach(card => {
                        const title = card.querySelector('.prestasi-title').textContent.toLowerCase();
                        const siswa = card.querySelector('.info-item:nth-child(1) span').textContent.toLowerCase();
                        const jurusan = card.querySelector('.info-item:nth-child(2) span').textContent.toLowerCase();

                        if (title.includes(searchTerm) || siswa.includes(searchTerm) || jurusan.includes(searchTerm)) {
                            card.style.display = '';
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    listRows.forEach(row => {
                        const title = row.querySelector('.prestasi-title').textContent.toLowerCase();
                        const siswa = row.querySelector('.student-info strong').textContent.toLowerCase();
                        const jurusan = row.querySelector('.student-info small').textContent.toLowerCase();

                        if (title.includes(searchTerm) || siswa.includes(searchTerm) || jurusan.includes(searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }
        }

        function storePrestasi() {
            const form = document.getElementById('tambahPrestasiForm');
            const formData = new FormData(form);
            const submitBtn = document.getElementById('tambahPrestasiBtn');
            clearErrors('tambah');
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;

            fetch('{{ route('admin.manajemen-prestasi.store') }}', {
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
                            bootstrap.Modal.getInstance(document.getElementById('tambahPrestasiModal')).hide();
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
                        text: 'Terjadi kesalahan saat menambahkan prestasi.'
                    });
                })
                .finally(() => {
                    submitBtn.classList.remove('btn-loading');
                    submitBtn.disabled = false;
                });
        }

        function editPrestasi(prestasiId) {
            const editPrestasiBtn = document.getElementById('editPrestasiBtn');
            editPrestasiBtn.classList.add('btn-loading');
            editPrestasiBtn.disabled = true;

            fetch(`/admin/manajemen-prestasi/${prestasiId}`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const prestasi = data.prestasi;
                        document.getElementById('editPrestasiId').value = prestasi.id;
                        document.getElementById('editNamaSiswa').value = prestasi.nama_siswa;
                        document.getElementById('editJurusan').value = prestasi.jurusan;
                        document.getElementById('editNamaPrestasi').value = prestasi.nama_prestasi;
                        document.getElementById('editPeringkat').value = prestasi.peringkat;
                        document.getElementById('editTahunPrestasi').value = prestasi.tahun_prestasi;
                        document.getElementById('editUrutan').value = prestasi.urutan;
                        document.getElementById('editStatus').checked = prestasi.status;
                        document.getElementById('editCurrentImage').src = prestasi.foto_prestasi_url;
                        removePreview('edit');
                        const modal = new bootstrap.Modal(document.getElementById('editPrestasiModal'));
                        modal.show();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal memuat data prestasi.'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat memuat data prestasi.'
                    });
                })
                .finally(() => {
                    editPrestasiBtn.classList.remove('btn-loading');
                    editPrestasiBtn.disabled = false;
                });
        }

        function viewPrestasi(prestasiId) {
            fetch(`/admin/manajemen-prestasi/${prestasiId}`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const prestasi = data.prestasi;

                        document.getElementById('viewPrestasiImage').src = prestasi.foto_prestasi_url;
                        document.getElementById('viewPrestasiTitle').textContent = prestasi.nama_prestasi;
                        document.getElementById('viewPrestasiSiswa').textContent = prestasi.nama_siswa;
                        document.getElementById('viewPrestasiJurusan').textContent = prestasi.jurusan;
                        document.getElementById('viewPrestasiPeringkat').textContent = prestasi.peringkat;
                        document.getElementById('viewPrestasiTahun').textContent = prestasi.tahun_prestasi;
                        document.getElementById('viewPrestasiUrutan').textContent = '#' + prestasi.urutan;
                        document.getElementById('viewPrestasiCreated').textContent = prestasi.created_at;
                        document.getElementById('viewPrestasiUpdated').textContent = prestasi.updated_at;
                        const statusBadge = document.getElementById('viewPrestasiStatus');
                        statusBadge.textContent = prestasi.status ? 'Aktif' : 'Nonaktif';
                        statusBadge.className = prestasi.status ? 'badge badge-active' : 'badge badge-inactive';
                        const modal = new bootstrap.Modal(document.getElementById('viewPrestasiModal'));
                        modal.show();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal memuat data prestasi.'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat memuat data prestasi.'
                    });
                });
        }

        function updatePrestasi() {
            const form = document.getElementById('editPrestasiForm');
            const formData = new FormData(form);
            const prestasiId = document.getElementById('editPrestasiId').value;
            const submitBtn = document.getElementById('editPrestasiBtn');
            clearErrors('edit');
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;

            fetch(`/admin/manajemen-prestasi/${prestasiId}`, {
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
                            bootstrap.Modal.getInstance(document.getElementById('editPrestasiModal')).hide();
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
                        text: 'Terjadi kesalahan saat memperbarui prestasi.'
                    });
                })
                .finally(() => {
                    submitBtn.classList.remove('btn-loading');
                    submitBtn.disabled = false;
                });
        }

        function updatePrestasiStatus(prestasiId, status) {
            fetch(`/admin/manajemen-prestasi/${prestasiId}/status`, {
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
                        const toggle = document.querySelector(`.status-toggle[data-prestasi-id="${prestasiId}"]`);
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
                        text: 'Terjadi kesalahan saat memperbarui status prestasi.'
                    });
                    const toggle = document.querySelector(`.status-toggle[data-prestasi-id="${prestasiId}"]`);
                    if (toggle) {
                        toggle.checked = !status;
                    }
                });
        }

        function deletePrestasi(prestasiId) {
            Swal.fire({
                title: 'Hapus Prestasi?',
                text: "Prestasi akan dihapus permanen. Tindakan ini tidak dapat dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/manajemen-prestasi/${prestasiId}`, {
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
                                    const prestasiCard = document.querySelector(
                                        `.prestasi-card[data-prestasi-id="${prestasiId}"]`);
                                    const prestasiRow = document.querySelector(
                                        `tr[data-prestasi-id="${prestasiId}"]`);

                                    if (prestasiCard) prestasiCard.remove();
                                    if (prestasiRow) prestasiRow.remove();
                                    if (document.querySelectorAll('.prestasi-card').length === 0 &&
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
                                text: 'Terjadi kesalahan saat menghapus prestasi.'
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

        window.editPrestasi = editPrestasi;
        window.viewPrestasi = viewPrestasi;
        window.deletePrestasi = deletePrestasi;
        window.removePreview = removePreview;
    </script>
@endsection