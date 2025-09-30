# 🏷️ Manajemen UMKM Wanea

Website Kecamatan Wanea, Sulawesi Utara. Dirancang untuk sistem manajemen UMKM.

## ✨ Fitur

-   👤 Manajemen Pengguna (CRUD User)
-   🗺️ Manajemen Kelurahan (CRUD Urban Village)
-   🏪 Manajemen UMKM (CRUD Business)
-   🖨️ Cetak PDF Data UMKM
-   📊 Dashboard Admin dan Statistik

## ⚙️ Teknologi

-   Laravel 12
-   PHP 8.3
-   Tailwind CSS
-   Alpine.js
-   MySQL
-   LangCommon
-   Sluggable
-   DOM PDF
-   Hero Icon

## 🛠️ Instalasi & Setup

1. Clone repository:

    ```bash
    git clone https://github.com/theowongkar/manajemen-umkm-wanea.git
    cd manajemen-umkm-wanea
    ```

2. Install dependency:

    ```bash
    composer install
    npm install && npm run build
    ```

3. Salin file `.env`:

    ```bash
    cp .env.example .env
    ```

4. Atur konfigurasi `.env` (database, mail, dsb)

5. Generate key dan migrasi database:

    ```bash
    php artisan key:generate
    php artisan storage:link
    php artisan migrate:fresh --seed
    ```

6. Jalankan server lokal:

    ```bash
    php artisan serve
    ```

7. Buka browser dan akses http://127.0.0.1:8000

## 👥 Role & Akses

| Role  | Akses                                   |
| ----- | --------------------------------------- |
| Admin | CRUD data user, urban village, business |

## 📎 Catatan Tambahan

-   Pastikan folder `storage` dan `bootstrap/cache` writable.
