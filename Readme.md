# Buku Online - Panduan Aplikasi

Aplikasi **Buku Online** adalah sistem manajemen perpustakaan digital yang memungkinkan pengguna untuk mengelola buku, kategori, peminjaman, pengembalian, dan laporan. Berikut adalah panduan fitur-fitur yang tersedia di aplikasi ini.

---

## Fitur Utama

### 1. **Manajemen Buku**
- **Tambah Buku**: Admin dapat menambahkan buku baru dengan informasi seperti judul, penulis, penerbit, tahun terbit, deskripsi, kategori, stok, dan sampul buku.
- **Ubah Buku**: Admin dapat mengedit informasi buku yang sudah ada.
- **Hapus Buku**: Admin dapat menghapus buku dari sistem. Buku yang terkait dengan peminjaman tidak dapat dihapus.
- **Detail Buku**: Pengguna dapat melihat detail lengkap buku, termasuk deskripsi dan informasi penerbit.

### 2. **Manajemen Kategori**
- **Tambah Kategori**: Admin dapat menambahkan kategori baru untuk buku.
- **Ubah Kategori**: Admin dapat mengedit nama kategori.
- **Hapus Kategori**: Admin dapat menghapus kategori yang tidak digunakan oleh buku.

### 3. **Peminjaman Buku**
- **Pinjam Buku**: Pengguna dapat meminjam buku dengan memilih tanggal peminjaman dan pengembalian (maksimal 5 hari).
- **Konfirmasi Peminjaman**: Admin dapat menyetujui atau menolak permintaan peminjaman buku.
- **Riwayat Peminjaman**: Pengguna dapat melihat riwayat peminjaman mereka, termasuk status peminjaman (disetujui, ditolak, dipinjam, atau dikembalikan).

### 4. **Pengembalian Buku**
- **Kembalikan Buku**: Pengguna dapat mengembalikan buku yang sedang dipinjam. Admin akan memperbarui status peminjaman menjadi "dikembalikan".

### 5. **Laporan Peminjaman**
- **Lihat Laporan**: Admin dapat melihat laporan lengkap peminjaman buku, termasuk informasi pengguna, buku, tanggal peminjaman, tanggal pengembalian, dan status.
- **Cetak Laporan**: Admin dapat mencetak laporan peminjaman dalam format tabel.

### 6. **Autentikasi Pengguna**
- **Login**: Pengguna dapat login menggunakan username dan password. Terdapat tiga level pengguna:
  - **Admin**: Memiliki akses penuh ke semua fitur.
  - **Petugas**: Memiliki akses terbatas untuk mengelola peminjaman dan pengembalian.
  - **Peminjam**: Hanya dapat meminjam dan mengembalikan buku.

### 7. **Dashboard**
- **Discover**: Halaman utama untuk mencari dan menjelajahi buku berdasarkan judul.
- **Navigasi Cepat**: Menu navigasi untuk mengakses fitur-fitur utama sesuai dengan level pengguna.

---

## Teknologi yang Digunakan
- **Frontend**: HTML, CSS, JavaScript, Bootstrap
- **Backend**: PHP
- **Database**: MySQL

---

## Cara Menjalankan Aplikasi
1. Clone repository ini ke server lokal Anda.
2. Import file database `database/ujikom.sql` ke MySQL.
3. Konfigurasi file `koneksi.php` untuk menyesuaikan dengan pengaturan database Anda.
4. Jalankan aplikasi melalui server lokal (contoh: XAMPP atau WAMP).
5. Akses aplikasi melalui browser di `http://localhost/ujikom`.

---

## Catatan
- Pastikan semua dependensi telah diinstal sesuai dengan file `package.json`.
- Gunakan akun admin untuk mengakses fitur manajemen.

---

## Kontak
Jika Anda memiliki pertanyaan atau masalah, silakan hubungi tim pengembang melalui email: **admin@gmail.com**.
