#  Flo-demi - Platform Pembelajaran Kursus Online

**Flo-demi** adalah platform berbasis web modern yang dirancang untuk mempertemukan pencari kursus online (mentee) dengan mentor profesional. Sistem ini menyediakan katalog kursus digital yang terstruktur, proses pendaftaran/pembayaran yang transparan, modul materi pembelajaran berbasis PDF, serta penerbitan sertifikat kelulusan secara otomatis.

---

##  Fitur Utama

1. **Katalog Kursus Dinamis**: Pencarian dan filter kursus berdasarkan kategori digital populer (UI/UX Design, Web Dev, Mobile Dev, Data Science, dll).
2. **Sistem Alur Belajar Modul**: Mentee dapat belajar secara bertahap. Modul selanjutnya hanya dapat dibuka jika modul sebelumnya telah ditandai selesai.
3. **Pendaftaran & Checkout**: Mendukung kelas gratis (akses langsung) dan kelas berbayar (melalui upload bukti transfer).
4. **Verifikasi Pembayaran & Pendaftaran**: Panel admin untuk menyetujui (*approve*) atau menolak (*reject*) bukti transfer dan pendaftaran mentee.
5. **E-Sertifikat Otomatis**: Generate sertifikat kelulusan berformat PDF secara otomatis setelah mentee menyelesaikan seluruh modul kelas.
6. **Notifikasi Push Real-Time**: Integrasi notifikasi web push untuk memberi tahu mentee tentang status pembayaran dan pendaftaran mereka.

---

## Tools

* **PHP**
* **Composer**
* **Laravel**
* **Node.js** & **NPM**
* **MySQL**
* **TailwindCSS**
* **Vite**

---

## Menjalankan projek Flo-demi di *local Environment* (*development*):

### 1. Persiapan Projek
Clone atau unduh projek ini, lalu buka terminal di direktori utama projek.

### 2. Install Dependensi PHP
```bash
composer install
```

### 3. Install Dependensi Javascript (Vite)
Unduh library frontend untuk kompilasi asset:
```bash
npm install
```

### 4. Konfigurasi Environment (`.env`)
Salin berkas `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
Buka file `.env` yang baru dibuat dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=username_database
DB_PASSWORD=password_database
```
*Catatan: Pastikan nama database pada server lokal sesuai atau sama dengan nama database yang ada di file .env*

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Migrasi & Seed Database
Jalankan migrasi untuk membuat tabel-tabel dan mengisi data awal (seperti kategori, kursus dummy, dan akun pengguna):
```bash
php artisan migrate --seed
```

### 7. Buat Link Storage
Agar gambar kursus, gambar profile user dan modul PDF dapat diakses secara publik oleh browser:
```bash
php artisan storage:link
```

### 8. Menjalankan Server Utama (Laravel)
```bash
php artisan serve
```

### 9. Jalankan Compiler Asset (Vite)
Buka terminal baru di folder projek yang sama, lalu jalankan perintah berikut untuk mengaktifkan hot-reload aset CSS/JS:
```bash
npm run dev
```
Atau build asset dengan menjalankan:
```bash
npm run build
```

### 10. Jalankan Queue Worker (Untuk Push Notifikasi)
```bash
php artisan queue:work
```

---

## Akun Testing Default

Seluruh password default adalah `password123`

* **Super Admin**
  * Email: `superadmin@example.com`
  * Sandi: `password123`
* **Mentee**
  * Email: `mentee@example.com`
  * Sandi: `password123`