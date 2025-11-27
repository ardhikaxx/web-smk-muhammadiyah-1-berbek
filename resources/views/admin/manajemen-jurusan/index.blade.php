@extends('layouts.app')

@section('title', 'Manajemen Jurusan')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/manajemen-jurusan.css') }}">

    <div class="manajemen-jurusan-container">
        <div class="page-header mb-2">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-title">Manajemen Jurusan</h1>
                    <p class="page-subtitle">Kelola program jurusan yang tersedia di SMK Muhammadiyah 1 Berbek</p>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahJurusanModal">
                        <i class="fas fa-plus me-2"></i>Tambah Jurusan
                    </button>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stat-card primary">
                    <div class="stat-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $jurusans->count() }}</h3>
                        <p class="stat-label">Total Jurusan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card success">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $jurusans->where('status', true)->count() }}</h3>
                        <p class="stat-label">Jurusan Aktif</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card warning">
                    <div class="stat-icon">
                        <i class="fas fa-pause-circle"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $jurusans->where('status', false)->count() }}</h3>
                        <p class="stat-label">Jurusan Nonaktif</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card info">
                    <div class="stat-icon">
                        <i class="fas fa-sort"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $jurusans->max('urutan') ?? 0 }}</h3>
                        <p class="stat-label">Urutan Tertinggi</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="jurusan-grid-card">
            <div class="card-header">
                <div class="header-content">
                    <i class="fas fa-th-large header-icon"></i>
                    <div>
                        <h3 class="card-title">Daftar Jurusan</h3>
                        <p class="card-subtitle">Kelola semua program jurusan yang ditawarkan</p>
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
                        <input type="text" id="searchInput" placeholder="Cari jurusan...">
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if ($jurusans->isEmpty())
                    <div class="empty-state">
                        <i class="fas fa-graduation-cap fa-4x text-muted mb-4"></i>
                        <h4>Belum ada jurusan</h4>
                        <p class="text-muted">Tambahkan jurusan pertama untuk ditampilkan di website.</p>
                        <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#tambahJurusanModal">
                            <i class="fas fa-plus me-2"></i>Tambah Jurusan Pertama
                        </button>
                    </div>
                @else
                    <div class="jurusan-grid" id="jurusanGridView">
                        @foreach ($jurusans as $jurusan)
                            <div class="jurusan-card" data-jurusan-id="{{ $jurusan->id }}">
                                <div class="jurusan-header">
                                    <div class="jurusan-kode">
                                        {{ $jurusan->kode_formatted }}
                                    </div>
                                    <div class="jurusan-badges">
                                        <span class="badge badge-urutan">#{{ $jurusan->urutan }}</span>
                                        @if ($jurusan->status)
                                            <span class="badge badge-active">Aktif</span>
                                        @else
                                            <span class="badge badge-inactive">Nonaktif</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="jurusan-content">
                                    <h6 class="jurusan-title">{{ $jurusan->nama_jurusan }}</h6>
                                    <p class="jurusan-description">{{ $jurusan->deskripsi_pendek }}</p>
                                    <div class="jurusan-meta">
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $jurusan->created_at->format('d M Y') }}
                                        </small>
                                    </div>
                                </div>
                                <div class="jurusan-actions">
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-edit" onclick="editJurusan({{ $jurusan->id }})"
                                            title="Edit Jurusan">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-view" onclick="viewJurusan({{ $jurusan->id }})"
                                            title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-delete" onclick="deleteJurusan({{ $jurusan->id }})"
                                            title="Hapus Jurusan">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input status-toggle" type="checkbox"
                                            data-jurusan-id="{{ $jurusan->id }}"
                                            {{ $jurusan->status ? 'checked' : '' }}>
                                        <label class="form-check-label">Aktif</label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="jurusan-list d-none" id="jurusanListView">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama Jurusan</th>
                                        <th>Deskripsi</th>
                                        <th>Status</th>
                                        <th>Urutan</th>
                                        <th>Tanggal</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jurusans as $jurusan)
                                        <tr data-jurusan-id="{{ $jurusan->id }}">
                                            <td>
                                                <span class="kode-badge">{{ $jurusan->kode_formatted }}</span>
                                            </td>
                                            <td>
                                                <div class="jurusan-info">
                                                    <h6 class="jurusan-title">{{ $jurusan->nama_jurusan }}</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="jurusan-description">{{ $jurusan->deskripsi_pendek }}</p>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        data-jurusan-id="{{ $jurusan->id }}"
                                                        {{ $jurusan->status ? 'checked' : '' }}>
                                                    <label class="form-check-label">
                                                        {{ $jurusan->status ? 'Aktif' : 'Nonaktif' }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="urutan-badge">#{{ $jurusan->urutan }}</span>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $jurusan->created_at->format('d M Y') }}
                                                </small>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-sm btn-edit"
                                                        onclick="editJurusan({{ $jurusan->id }})" title="Edit Jurusan">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-view"
                                                        onclick="viewJurusan({{ $jurusan->id }})" title="Lihat Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-delete"
                                                        onclick="deleteJurusan({{ $jurusan->id }})"
                                                        title="Hapus Jurusan">
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

    <div class="modal fade" id="tambahJurusanModal" tabindex="-1" aria-labelledby="tambahJurusanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahJurusanModalLabel">
                        <i class="fas fa-plus me-2"></i>Tambah Jurusan Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="tambahJurusanForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tambahNamaJurusan" class="form-label">Nama Jurusan *</label>
                                    <input type="text" class="form-control" id="tambahNamaJurusan"
                                        name="nama_jurusan" placeholder="Masukkan nama jurusan" required>
                                    <div class="invalid-feedback" id="tambahNamaJurusan_error"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tambahKodeJurusan" class="form-label">Kode Jurusan *</label>
                                    <input type="text" class="form-control" id="tambahKodeJurusan"
                                        name="kode_jurusan" placeholder="Contoh: TKJ, RPL, MM" maxlength="10" required>
                                    <small class="form-text text-muted">Maksimal 10 karakter (akan diubah menjadi huruf
                                        besar)</small>
                                    <div class="invalid-feedback" id="tambahKodeJurusan_error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tambahDeskripsiJurusan" class="form-label">Deskripsi Jurusan *</label>
                            <textarea class="form-control" id="tambahDeskripsiJurusan" name="deskripsi_jurusan" rows="4"
                                placeholder="Masukkan deskripsi lengkap tentang jurusan ini" required></textarea>
                            <small class="form-text text-muted">Maksimal 1000 karakter</small>
                            <div class="invalid-feedback" id="tambahDeskripsiJurusan_error"></div>
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
                                        <input class="form-check-input" type="checkbox" id="tambahStatus" name="status"
                                            checked>
                                        <label class="form-check-label" for="tambahStatus">Aktif</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="tambahJurusanBtn">
                            <i class="fas fa-save me-2"></i>Simpan Jurusan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editJurusanModal" tabindex="-1" aria-labelledby="editJurusanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editJurusanModalLabel">
                        <i class="fas fa-edit me-2"></i>Edit Jurusan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editJurusanForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editJurusanId" name="id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editNamaJurusan" class="form-label">Nama Jurusan *</label>
                                    <input type="text" class="form-control" id="editNamaJurusan" name="nama_jurusan"
                                        placeholder="Masukkan nama jurusan" required>
                                    <div class="invalid-feedback" id="editNamaJurusan_error"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editKodeJurusan" class="form-label">Kode Jurusan *</label>
                                    <input type="text" class="form-control" id="editKodeJurusan" name="kode_jurusan"
                                        placeholder="Contoh: TKJ, RPL, MM" maxlength="10" required>
                                    <small class="form-text text-muted">Maksimal 10 karakter (akan diubah menjadi huruf
                                        besar)</small>
                                    <div class="invalid-feedback" id="editKodeJurusan_error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editDeskripsiJurusan" class="form-label">Deskripsi Jurusan *</label>
                            <textarea class="form-control" id="editDeskripsiJurusan" name="deskripsi_jurusan" rows="4"
                                placeholder="Masukkan deskripsi lengkap tentang jurusan ini" required></textarea>
                            <small class="form-text text-muted">Maksimal 1000 karakter</small>
                            <div class="invalid-feedback" id="editDeskripsiJurusan_error"></div>
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
                                        <input class="form-check-input" type="checkbox" id="editStatus" name="status">
                                        <label class="form-check-label" for="editStatus">Aktif</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="editJurusanBtn">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewJurusanModal" tabindex="-1" aria-labelledby="viewJurusanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewJurusanModalLabel">
                        <i class="fas fa-eye me-2"></i>Detail Jurusan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="jurusan-detail">
                        <div class="detail-header mb-4">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 id="viewJurusanTitle" class="mb-2"></h4>
                                    <div class="kode-display">
                                        <span class="kode-badge-large" id="viewJurusanKode"></span>
                                        <span id="viewJurusanStatus" class="badge ms-2"></span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <span class="urutan-display" id="viewJurusanUrutan"></span>
                                </div>
                            </div>
                        </div>

                        <div class="detail-section">
                            <label class="detail-label">Deskripsi Jurusan:</label>
                            <p id="viewJurusanDescription" class="detail-content"></p>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label class="detail-label">Dibuat:</label>
                                    <span id="viewJurusanCreated" class="detail-content"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label class="detail-label">Diperbarui:</label>
                                    <span id="viewJurusanUpdated" class="detail-content"></span>
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
            initManajemenJurusan();
        });

        function initManajemenJurusan() {
            initFormSubmissions();
            initViewToggle();
            initStatusToggle();
            initSearch();
            initKodeUppercase();
        }

        function initFormSubmissions() {
            const tambahJurusanForm = document.getElementById('tambahJurusanForm');
            if (tambahJurusanForm) {
                tambahJurusanForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    storeJurusan();
                });
            }

            const editJurusanForm = document.getElementById('editJurusanForm');
            if (editJurusanForm) {
                editJurusanForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    updateJurusan();
                });
            }
        }

        function initViewToggle() {
            const viewButtons = document.querySelectorAll('.view-btn');
            const gridView = document.getElementById('jurusanGridView');
            const listView = document.getElementById('jurusanListView');

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
                    const jurusanId = this.getAttribute('data-jurusan-id');
                    const status = this.checked;

                    updateJurusanStatus(jurusanId, status);
                });
            });
        }

        function initSearch() {
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    const gridCards = document.querySelectorAll('.jurusan-card');
                    const listRows = document.querySelectorAll('.jurusan-list tbody tr');
                    gridCards.forEach(card => {
                        const title = card.querySelector('.jurusan-title').textContent.toLowerCase();
                        const kode = card.querySelector('.jurusan-kode').textContent.toLowerCase();
                        const description = card.querySelector('.jurusan-description').textContent
                            .toLowerCase();

                        if (title.includes(searchTerm) || kode.includes(searchTerm) || description.includes(
                                searchTerm)) {
                            card.style.display = '';
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    listRows.forEach(row => {
                        const title = row.querySelector('.jurusan-title').textContent.toLowerCase();
                        const kode = row.querySelector('.kode-badge').textContent.toLowerCase();
                        const description = row.querySelector('.jurusan-description').textContent
                            .toLowerCase();

                        if (title.includes(searchTerm) || kode.includes(searchTerm) || description.includes(
                                searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }
        }

        function initKodeUppercase() {
            const kodeInputs = document.querySelectorAll('input[name="kode_jurusan"]');

            kodeInputs.forEach(input => {
                input.addEventListener('input', function(e) {
                    this.value = this.value.toUpperCase();
                });
            });
        }

        function storeJurusan() {
            const form = document.getElementById('tambahJurusanForm');
            const formData = new FormData(form);
            const submitBtn = document.getElementById('tambahJurusanBtn');
            clearErrors('tambah');
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;

            fetch('{{ route('admin.manajemen-jurusan.store') }}', {
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
                            bootstrap.Modal.getInstance(document.getElementById('tambahJurusanModal')).hide();
                            form.reset();
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
                        text: 'Terjadi kesalahan saat menambahkan jurusan.'
                    });
                })
                .finally(() => {
                    submitBtn.classList.remove('btn-loading');
                    submitBtn.disabled = false;
                });
        }

        function editJurusan(jurusanId) {
            const editJurusanBtn = document.getElementById('editJurusanBtn');
            editJurusanBtn.classList.add('btn-loading');
            editJurusanBtn.disabled = true;

            fetch(`/admin/manajemen-jurusan/${jurusanId}`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const jurusan = data.jurusan;
                        document.getElementById('editJurusanId').value = jurusan.id;
                        document.getElementById('editNamaJurusan').value = jurusan.nama_jurusan;
                        document.getElementById('editKodeJurusan').value = jurusan.kode_jurusan;
                        document.getElementById('editDeskripsiJurusan').value = jurusan.deskripsi_jurusan;
                        document.getElementById('editUrutan').value = jurusan.urutan;
                        document.getElementById('editStatus').checked = jurusan.status;
                        const modal = new bootstrap.Modal(document.getElementById('editJurusanModal'));
                        modal.show();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal memuat data jurusan.'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat memuat data jurusan.'
                    });
                })
                .finally(() => {
                    editJurusanBtn.classList.remove('btn-loading');
                    editJurusanBtn.disabled = false;
                });
        }

        function viewJurusan(jurusanId) {
            fetch(`/admin/manajemen-jurusan/${jurusanId}`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const jurusan = data.jurusan;
                        document.getElementById('viewJurusanTitle').textContent = jurusan.nama_jurusan;
                        document.getElementById('viewJurusanKode').textContent = jurusan.kode_jurusan;
                        document.getElementById('viewJurusanDescription').textContent = jurusan.deskripsi_jurusan;
                        document.getElementById('viewJurusanUrutan').textContent = 'Urutan: #' + jurusan.urutan;
                        document.getElementById('viewJurusanCreated').textContent = jurusan.created_at;
                        document.getElementById('viewJurusanUpdated').textContent = jurusan.updated_at;
                        const statusBadge = document.getElementById('viewJurusanStatus');
                        statusBadge.textContent = jurusan.status ? 'Aktif' : 'Nonaktif';
                        statusBadge.className = jurusan.status ? 'badge badge-active' : 'badge badge-inactive';
                        const modal = new bootstrap.Modal(document.getElementById('viewJurusanModal'));
                        modal.show();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal memuat data jurusan.'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat memuat data jurusan.'
                    });
                });
        }

        function updateJurusan() {
            const form = document.getElementById('editJurusanForm');
            const formData = new FormData(form);
            const jurusanId = document.getElementById('editJurusanId').value;
            const submitBtn = document.getElementById('editJurusanBtn');
            clearErrors('edit');
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;

            fetch(`/admin/manajemen-jurusan/${jurusanId}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-HTTP-Method-Override': 'PUT',
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
                            bootstrap.Modal.getInstance(document.getElementById('editJurusanModal')).hide();
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
                        text: 'Terjadi kesalahan saat memperbarui jurusan.'
                    });
                })
                .finally(() => {
                    submitBtn.classList.remove('btn-loading');
                    submitBtn.disabled = false;
                });
        }

        function updateJurusanStatus(jurusanId, status) {
            fetch(`/admin/manajemen-jurusan/${jurusanId}/status`, {
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
                        const toggle = document.querySelector(`.status-toggle[data-jurusan-id="${jurusanId}"]`);
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
                        text: 'Terjadi kesalahan saat memperbarui status jurusan.'
                    });
                    const toggle = document.querySelector(`.status-toggle[data-jurusan-id="${jurusanId}"]`);
                    if (toggle) {
                        toggle.checked = !status;
                    }
                });
        }

        function deleteJurusan(jurusanId) {
            Swal.fire({
                title: 'Hapus Jurusan?',
                text: "Data jurusan akan dihapus permanen. Tindakan ini tidak dapat dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/manajemen-jurusan/${jurusanId}`, {
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
                                    const jurusanCard = document.querySelector(
                                        `.jurusan-card[data-jurusan-id="${jurusanId}"]`);
                                    const jurusanRow = document.querySelector(
                                        `tr[data-jurusan-id="${jurusanId}"]`);

                                    if (jurusanCard) jurusanCard.remove();
                                    if (jurusanRow) jurusanRow.remove();

                                    if (document.querySelectorAll('.jurusan-card').length === 0 &&
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
                                text: 'Terjadi kesalahan saat menghapus jurusan.'
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

        window.editJurusan = editJurusan;
        window.viewJurusan = viewJurusan;
        window.deleteJurusan = deleteJurusan;
    </script>
@endsection
