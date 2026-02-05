# SI-MTS-NFS

Sistem Informasi MTs Nurul Falaah Soreang

## 🛠️ Teknologi Utama
- **Backend**: Laravel 12
- **Styling**: Tailwind CSS 4
- **Interactivity**: Alpine.js
- **Bundler**: Vite

## 📋 Requirements
- **PHP**: 8.2+
- **Database**: MySQL/MariaDB
- **Node.js**: 18+ (Recommended)
- **Composer**

## 📂 Struktur Views
Aplikasi dibagi menjadi dua bagian utama di `resources/views/`:
- **Website** (`/website`): Halaman publik (Beranda, Profil, Berita, Galeri, PPDB, dll).
- **Admin** (`/admin`): Panel pengelolaan konten & pengaturan sistem.

## 🚀 Quick Start (Installation)

```bash
# 1. Install Dependencies
composer install
npm install

# 2. Setup Environment
cp .env.example .env
php artisan key:generate

# 3. Setup Database (Fresh Install)
php artisan migrate:fresh --seed

# 4. Build Assets
npm run build

# 5. Link Storage
php artisan storage:link

# 6. Run Server
php artisan serve
```

## 🔧 Production / Deployment

Untuk performa maksimal di server production, jalankan perintah ini setelah pull code:

```bash
# Install tanpa dev dependencies
composer install --optimize-autoloader --no-dev

# Cache Config & Routes
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Build Assets
npm run build
```

## 🔐 Default Login
- **Username**: `admin`
- **Password**: `admin` (Default dari seeder)

---
**Versi**: 1.0.0
