---

## 🏥 Sisfo Klinik  

**Sisfo Klinik** adalah sistem informasi klinik untuk mengelola data pasien, rekam medis, jadwal dokter, dan transaksi pembayaran. Dibangun menggunakan **Laravel, Vue.js, dan Inertia.js** untuk mendukung efisiensi dalam operasional klinik.  

### 🚀 Fitur Utama  
- **Manajemen Pasien**: Pendaftaran, pencatatan, dan pengelolaan data pasien.  
- **Rekam Medis**: Penyimpanan riwayat pemeriksaan dan pengobatan pasien.  
- **Jadwal Dokter**: Manajemen jadwal praktek dokter dan janji temu pasien.  
- **Transaksi & Pembayaran**: Pencatatan biaya pemeriksaan dan pembayaran pasien.  
- **Autentikasi & Hak Akses**: Sistem login untuk dokter, perawat, dan admin.  

### 🛠️ Teknologi yang Digunakan  
- **Backend**: Laravel  
- **Frontend**: Vue.js dengan Inertia.js  
- **Database**: MySQL   
- **Lainnya**: Tailwind CSS  

### ⚙️ Cara Instalasi  

1. **Clone repository ini**  
   ```sh
   git clone https://github.com/agustiawan5209/sisfo-klinik.git
   cd sisfo-klinik
   ```

2. **Instal dependensi backend**  
   ```sh
   composer install
   cp .env.example .env
   php artisan key:generate
   ```

3. **Instal dependensi frontend**  
   ```sh
   npm install
   npm run dev
   ```

4. **Migrasi database**  
   ```sh
   php artisan migrate --seed
   ```

5. **Jalankan server**  
   ```sh
   php artisan serve
   ```

6. **Akses aplikasi**  
   Buka browser dan masuk ke `http://localhost:8000`.  

### 📜 Lisensi  
Proyek ini menggunakan lisensi **MIT**.  

---
😊
