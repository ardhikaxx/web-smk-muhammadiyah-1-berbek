# Website SMK Muhammadiyah 1 Berbek

Platform profil sekolah berbasis Laravel untuk menampilkan informasi utama sekolah sekaligus menyediakan panel admin untuk mengelola konten publik.

## ✨ Fitur Utama

**Halaman Publik**
- Landing page sekolah.
- Profil sekolah.
- Daftar prestasi.
- Daftar pengumuman.

**Panel Admin**
- Dashboard dengan ringkasan data.
- Manajemen banner.
- Manajemen struktur organisasi.
- Manajemen pengumuman.
- Manajemen fasilitas.
- Manajemen prestasi.
- Manajemen jurusan.
- Manajemen tenaga pendidik.
- Manajemen galeri.
- Manajemen admin.
- Pengaturan profil & password admin.

## 🧰 Teknologi

- Laravel (backend & routing)
- Blade Template (UI)
- Bootstrap 5 + Font Awesome
- Vite (build tools)
- MySQL (database)

## ✅ Prasyarat

- PHP 8.1+
- Composer
- Node.js + npm
- MySQL/MariaDB

## ⚙️ Instalasi & Menjalankan Project

1) Clone repositori dan install dependensi.
```bash
composer install
npm install
```

2) Salin file environment dan generate app key.
```bash
cp .env.example .env
php artisan key:generate
```

3) Atur konfigurasi database pada `.env`.
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=web_smk
DB_USERNAME=root
DB_PASSWORD=
```

4) Jalankan migrasi & seeder.
```bash
php artisan migrate --seed
```

5) Jalankan server aplikasi dan Vite.
```bash
php artisan serve
npm run dev
```

Aplikasi dapat diakses di `http://localhost:8000`.

## 🔑 Akun Admin Default (Seeder)

Gunakan akun berikut setelah menjalankan seeder:
- **Email:** `diva.rahma@smk.com` / **Password:** `password`
- **Email:** `admin@smk.com` / **Password:** `password`

## 🗂️ Rute Utama

- `/` — Landing page
- `/profil` — Profil sekolah
- `/prestasi` — Prestasi
- `/pengumuman` — Pengumuman
- `/admin/dashboard` — Dashboard admin (login terlebih dahulu)

## 🧪 Testing

Belum ada pengujian otomatis yang dikonfigurasi.

## 🤝 Kontribusi

Silakan buat issue/PR jika ingin menambahkan fitur atau perbaikan.
