# Sistem Pengelolaan Objek Wisata Air Terjun Lubuk Hitam

> Sebuah sistem web terintegrasi yang dirancang untuk mengelola seluruh aspek operasional objek wisata Air Terjun Lubuk Hitam.

Proyek ini dikembangkan oleh **OneVision - Kelompok 1 (TRPL 2D)**.

## 👥 Anggota Kelompok

| Nama                          | NIM          |
| :---------------------------- | :----------- |
| Nauval Alpen Perdana          | `2311083024` |
| Atika Naira                   | `2311081006` |
| Meilashinta Putri Yuliantoni  | `2311081024` |
| Dimas Ghazial Ghifari         | `2311082012` |

## 📖 Deskripsi Proyek

Sistem Pengelolaan Objek Wisata Air Terjun Lubuk Hitam adalah sebuah web terintegrasi yang dirancang untuk menggantikan sistem manual yang ada saat ini. Produk ini menyediakan platform tunggal bagi pengelola untuk mengatur semua aspek operasional, mulai dari pendaftaran pengunjung, penjualan tiket, manajemen fasilitas, pengelolaan jasa tour guide, promosi produk UMKM, hingga pelaporan keuangan.

Bagi wisatawan, sistem ini berfungsi sebagai portal informasi dan layanan, yang memungkinkan mereka untuk merencanakan kunjungan, melakukan pemesanan, dan berinteraksi dengan ekosistem wisata secara digital.

## ✨ Fitur Utama

*   **Manajemen Pengunjung**: Pendaftaran digital untuk semua pengunjung.
*   **Tiket Online**: Pembelian tiket online yang aman dan mudah.
*   **Manajemen Fasilitas**: Pemesanan dan pengelolaan fasilitas yang tersedia.
*   **Layanan Pemandu Wisata**: Pemesanan dan penjadwalan pemandu wisata lokal.
*   **Pasar UMKM**: Platform untuk mempromosikan dan menjual produk dari UMKM lokal.
*   **Laporan Keuangan**: Laporan keuangan otomatis untuk manajemen yang transparan.
*   **Portal Informasi**: Menyediakan informasi terkini, termasuk ramalan cuaca.

## 🛠️ Teknologi & Library yang Digunakan

### Backend
*   **Laravel Framework 11** (`laravel/framework`)
*   **Bacon QR Code** (`bacon/bacon-qr-code`): Untuk membuat kode QR.
*   **Laravel DOMPDF** (`barryvdh/laravel-dompdf`): Untuk membuat file PDF dari HTML.
*   **Laravel Socialite** (`laravel/socialite`): Untuk otentikasi OAuth (Google).
*   **Pragmarx Google2FA** (`pragmarx/google2fa-laravel`): Untuk Otentikasi Dua Faktor.
*   **Maatwebsite/Laravel-Excel**: Untuk mengelola impor dan ekspor file Excel.

### Frontend
*   **Bootstrap**
*   **Tailwind CSS**
*   **Vite**
*   **JavaScript**

### API & Layanan Pihak Ketiga
*   **Google OAuth**: Untuk otentikasi pengguna melalui akun Google.
*   **Google Verification**: Untuk verifikasi kepemilikan situs.
*   **Open-Meteo API**: Untuk data ramalan cuaca.

---

## 🚀 Panduan Instalasi & Menjalankan Proyek

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di mesin lokal Anda.

### Kebutuhan Sistem
Pastikan perangkat lunak berikut sudah terpasang di sistem Anda:
*   **PHP**: versi `8.1` atau lebih tinggi
*   **Composer**: [Download & Install](https://getcomposer.org/download/)
*   **Node.js & npm**: versi `18.x` atau lebih tinggi
*   **Git**: [Download & Install](https://git-scm.com/)
*   **Database Server**: MySQL atau MariaDB

### Langkah-langkah Instalasi

1.  **Clone repositori ini:**
    ```bash
    git clone https://github.com/nauvalalpen/Agile-D.git
    ```

2.  **Masuk ke direktori proyek:**
    ```bash
    cd Agile-D/src
    ```
    *(Catatan: Proyek Laravel berada di dalam folder `src`)*.

3.  **Install dependensi PHP:**
    ```bash
    composer install
    ```

4.  **Install dependensi JavaScript:**
    ```bash
    npm install
    ```

5.  **Buat file environment Anda:**
    ```bash
    cp .env.example .env
    ```

6.  **Generate kunci aplikasi:**
    ```bash
    php artisan key:generate
    ```

7.  **Konfigurasi file `.env`:**
    Buka file `.env` dan atur koneksi database Anda.
    ```ini
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_anda # <-- Ganti ini
    DB_USERNAME=username_anda     # <-- Ganti ini
    DB_PASSWORD=password_anda     # <-- Ganti ini (bisa dikosongkan)
    ```

8.  **Buat database baru:**
    Masuk ke klien MySQL Anda dan buat database baru dengan nama yang sama seperti yang Anda tentukan di file `.env`.
    ```sql
    -- Contoh menggunakan command line MySQL
    mysql -u root -p
    CREATE DATABASE nama_database_anda;
    EXIT;
    ```

9.  **Jalankan migrasi dan seeder database:**
    Perintah ini akan membuat semua tabel yang dibutuhkan dan mengisinya dengan data awal (termasuk akun sampel).
    ```bash
    php artisan migrate --seed
    ```

10. **Buat symbolic link untuk storage:**
    ```bash
    php artisan storage:link
    ```

### Menjalankan Aplikasi

Anda perlu menjalankan dua proses di dua terminal terpisah:

1.  **Jalankan server development PHP:**
    ```bash
    php artisan serve
    ```

2.  **Jalankan server development Vite (untuk aset frontend):**
    ```bash
    npm run dev
    ```

Sekarang, aplikasi dapat diakses melalui **`http://127.0.0.1:8000`**.

---

## 🔐 Akun untuk Akses Login

Anda dapat menggunakan akun berikut yang sudah tersedia di database untuk login.

| Role        | Username          | Password |
| :---------- | :---------------- | :------- |
| 👑 **Admin** | `admin@gmail.com` | `admin`  |
| 👤 **User**  | `user@gmail.com`  | `user`   |

### ⚠️ Catatan Penting: Verifikasi Email Manual

Untuk pengembangan lokal, pengiriman email mungkin tidak dikonfigurasi. Agar bisa login, Anda harus **memverifikasi akun pengguna secara manual** di database setelah menjalankan seeder.

1.  Buka aplikasi manajemen database Anda (misalnya: phpMyAdmin, TablePlus, DBeaver).
2.  Buka tabel `users`.
3.  Cari baris untuk `admin@gmail.com` dan `user@gmail.com`.
4.  Untuk setiap pengguna, ubah kolom berikut:
    *   Isi kolom `email_verified_at` dengan tanggal dan waktu saat ini (contoh: `2024-05-22 10:00:00`).
    *   Isi kolom `is_verified` dengan nilai `1`.

Setelah langkah ini selesai, Anda akan dapat login menggunakan akun di atas.
