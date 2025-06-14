# Instruksi Import Database ke XAMPP

## Langkah-langkah Import Database:

### 1. Persiapan XAMPP
- Pastikan XAMPP sudah terinstall dan berjalan
- Start Apache dan MySQL dari XAMPP Control Panel
- Buka phpMyAdmin di browser: `http://localhost/phpmyadmin`

### 2. Import Database
1. **Buka phpMyAdmin**
   - Akses `http://localhost/phpmyadmin`
   - Login dengan username: `root` (password kosong secara default)

2. **Import File SQL**
   - Klik tab "Import" di menu atas
   - Klik "Choose File" atau "Browse"
   - Pilih file: `database_export_mysql.sql`
   - Pastikan format: "SQL"
   - Klik "Go" atau "Import"

### 3. Verifikasi Import
Setelah import berhasil, Anda akan melihat:
- Database baru bernama: `websitejwpku`
- Tabel-tabel berikut:
  - `migrations` - Riwayat migrasi Laravel
  - `users` - Data pengguna
  - `admins` - Data administrator
  - `layanan` - Data layanan/service
  - `requests` - Data permintaan layanan
  - `sessions` - Data sesi pengguna
  - `cache` - Data cache aplikasi
  - `jobs` - Antrian pekerjaan
  - `failed_jobs` - Pekerjaan yang gagal
  - Dan tabel sistem lainnya

### 4. Konfigurasi Laravel
Setelah database berhasil diimport, update file `.env` di project Laravel:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=websitejwpku
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Troubleshooting

**Jika terjadi error saat import:**
- Pastikan MySQL berjalan di XAMPP
- Cek ukuran file SQL tidak melebihi batas upload phpMyAdmin
- Jika file terlalu besar, gunakan MySQL command line:
  ```bash
  mysql -u root -p websitejwpku < database_export_mysql.sql
  ```

**Jika foreign key error:**
- File SQL sudah mengatur `SET FOREIGN_KEY_CHECKS = 0` di awal
- Dan `SET FOREIGN_KEY_CHECKS = 1` di akhir
- Ini akan mengatasi masalah foreign key saat import

### 6. Catatan Penting
- File `database_export_mysql.sql` sudah dioptimasi untuk MySQL/XAMPP
- Semua tabel menggunakan engine InnoDB
- Character set: utf8mb4 dengan collation utf8mb4_unicode_ci
- Auto increment sudah diatur dengan benar
- Foreign key constraints sudah diterapkan

### 7. Setelah Import Berhasil
1. Jalankan Laravel development server:
   ```bash
   php artisan serve
   ```
2. Akses aplikasi di: `http://localhost:8000`
3. Database siap digunakan!

---

**File yang tersedia:**
- `database_export_mysql.sql` - File SQL untuk import ke XAMPP/MySQL
- `database_export_fixed.sql` - File SQL original (SQLite format)
- `database.sqlite` - Database SQLite original

**Rekomendasi:** Gunakan `database_export_mysql.sql` untuk import ke XAMPP.