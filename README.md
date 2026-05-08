# E-Lib40

Sistem Manajemen Buku Perpustakaan Mini berbasis Laravel untuk tugas project Pemrograman Web Berbasis Framework kelas XII RPL.

## Ringkasan

Project ini dibuat dengan:

- Laravel Breeze (Blade)
- Tailwind CSS
- MySQL
- Laravel ORM Eloquent

Fitur utama:

- Login dan logout
- Daftar buku
- Tambah buku
- Edit buku
- Hapus buku dengan konfirmasi
- Validasi input form
- Flash message setelah aksi CRUD
- Tampilan responsif

## Struktur Data Buku

Tabel `buku` memiliki kolom:

- `id`
- `judul`
- `pengarang`
- `tahun_terbit`
- `stok`
- `created_at`
- `updated_at`

## Cara Menjalankan Project

1. Pastikan Laragon, PHP, Composer, Node.js, dan MySQL sudah aktif.
2. Masuk ke folder project:

```powershell
cd D:\laragon\www\E-Lib40
```

3. Install dependency jika belum:

```powershell
composer install
npm install
```

4. Salin file environment jika perlu:

```powershell
copy .env.example .env
```

5. Generate key aplikasi:

```powershell
php artisan key:generate
```

6. Buat database MySQL bernama `e_lib40`.
7. Jalankan migrasi dan seeder:

```powershell
php artisan migrate:fresh --seed
```

8. Jalankan Vite:

```powershell
npm run dev
```

9. Jalankan server Laravel:

```powershell
php artisan serve
```

10. Buka aplikasi di:

```text
http://127.0.0.1:8000
```

## Konfigurasi Database

File `.env` project ini disiapkan untuk MySQL Laragon:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=e_lib40
DB_USERNAME=root
DB_PASSWORD=
```

## Akun Demo

Seeder membuat akun berikut:

- Email: `admin@elib40.test`
- Password: `password`

## File Pengumpulan

Artefak yang sudah disiapkan:

- Source code project: folder `D:\laragon\www\E-Lib40`
- Export database MySQL: `database_buku.sql`
- Screenshot aplikasi: folder `screenshots`

Daftar screenshot:

- `01-login.png`
- `02-daftar-buku.png`
- `03-tambah-buku.png`
- `04-edit-buku.png`
- `05-setelah-hapus.png`

## Pengujian

Untuk menjalankan test:

```powershell
php artisan test
```

Status terakhir saat diverifikasi:

- `28 passed`

## Catatan

- Project ini memakai Laravel framework versi yang terpasang pada environment saat pembuatan project.
- Secara fitur, implementasi sudah mengikuti kebutuhan tugas CRUD perpustakaan mini.
