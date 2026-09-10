# Last Test - Laravel Training Project

Aplikasi web dashboard sederhana berbasis Laravel 12 yang dibuat khusus sebagai bahan latihan tim untuk mempelajari workflow Git: **clone, pull, push, branching, dan pull request**.

## Tentang Aplikasi

Aplikasi ini memiliki fitur:

- **Autentikasi** - Login, Register, dan Logout dengan rate limiting
- **Dashboard** - Menampilkan statistik user (total, pendaftar hari ini), tabel user terbaru, info sistem (versi Laravel, PHP, driver database/cache/session), serta panduan singkat workflow Git
- **Database** - PostgreSQL 16, berjalan di Docker
- **Cache / Session / Queue** - Redis 7, berjalan di Docker

### Halaman

| Route        | Akses        | Deskripsi                          |
|--------------|--------------|------------------------------------|
| `/`          | Guest        | Halaman login                      |
| `/register`  | Guest        | Halaman registrasi akun baru       |
| `/dashboard` | Auth         | Dashboard utama setelah login      |
| `/logout`    | Auth (POST)  | Proses logout                      |

## Stack Teknologi

| Komponen        | Teknologi                |
|-----------------|--------------------------|
| Framework       | Laravel 12               |
| PHP             | >= 8.2                   |
| Database        | PostgreSQL 16 (Docker)   |
| Cache/Session   | Redis 7 (Docker)         |
| Frontend        | Tailwind CSS v4 + Vite   |
| Auth            | Custom (tanpa Breeze)    |

## Prasyarat

Pastikan sudah terinstall di komputer kamu:

- **PHP >= 8.2** dengan extension `pdo_pgsql` dan `redis`
- **Composer** (PHP package manager)
- **Node.js >= 18** dan **npm**
- **Docker** dan **Docker Compose**
- **Git**

### Cara cek prasyarat

```bash
php -v                  # Minimal 8.2
composer -V             # Harus terinstall
node -v                 # Minimal 18
npm -v                  # Harus terinstall
docker --version        # Harus terinstall
docker compose version  # Harus terinstall
git --version           # Harus terinstall
```

### Cek PHP extension

```bash
php -m | grep pdo_pgsql   # Harus muncul "pdo_pgsql"
php -m | grep redis        # Harus muncul "redis"
```

Jika belum ada, install:

```bash
# Ubuntu/Debian
sudo apt install php8.2-pgsql php8.2-redis

# macOS (Homebrew)
pecl install redis
```

## Setup Pertama Kali

```bash
# 1. Clone repo
git clone <url-repo> last_test
cd last_test

# 2. Start PostgreSQL & Redis via Docker
docker compose up -d

# 3. Install PHP dependencies
composer install

# 4. Install JS dependencies
npm install

# 5. Copy file environment & generate app key
cp .env.example .env
php artisan key:generate

# 6. Tunggu Docker selesai start (~3 detik), lalu migrate & seed
php artisan migrate --seed

# 7. Build frontend assets
npm run build

# 8. Jalankan development server
make dev
# atau: php artisan serve
```

## Docker Services

Semua service infrastruktur berjalan di Docker. Tidak perlu install PostgreSQL atau Redis di komputer lokal.

| Service    | Image              | Port | Host        | Credentials                 |
|------------|--------------------|------|-------------|-----------------------------|
| PostgreSQL | postgres:16-alpine | 5432 | 127.0.0.1   | user: `last_test_user`, pass: `secret`, db: `last_test` |
| Redis      | redis:7-alpine     | 6379 | 127.0.0.1   | tanpa password              |
| Adminer    | adminer            | 8080 | 127.0.0.1   | Web UI Database Dashboard   |

### Dashboard Database (Adminer)

Akses web dashboard database melalui browser di **http://localhost:8080**:
- **System:** PostgreSQL
- **Server:** `postgres`
- **Username:** `last_test_user`
- **Password:** `secret`
- **Database:** `last_test`

### Docker Commands

```bash
docker compose up -d       # Start containers (background)
docker compose down        # Stop containers
docker compose logs -f     # Lihat logs realtime
docker compose ps          # Lihat status containers
```

## Akun Default

Setelah menjalankan `migrate --seed`, akun berikut tersedia:

| Email               | Password   | Keterangan        |
|---------------------|------------|--------------------|
| admin@example.com   | password   | Akun admin utama   |

Selain itu ada 5 user dummy yang dibuat otomatis oleh seeder.

## Perintah Makefile

Semua perintah bisa dijalankan via `make`:

| Perintah         | Fungsi                                        |
|------------------|-----------------------------------------------|
| `make setup`     | Full setup (Docker + deps + migrate + build)  |
| `make up`        | Start Docker containers                       |
| `make down`      | Stop Docker containers                        |
| `make restart`   | Restart Docker containers                     |
| `make dev`       | Start development server (Laravel + Vite)     |
| `make fresh`     | Reset database + seed ulang                   |
| `make test`      | Jalankan test suite                           |
| `make logs`      | Lihat Docker container logs                   |

## Workflow Git untuk Tim

### 1. Clone & Setup (pertama kali)

```bash
git clone <url-repo> last_test
cd last_test
make setup
```

### 2. Buat Branch Baru (setiap mulai kerja)

```bash
# Pastikan di branch main terbaru
git checkout main
git pull origin main

# Buat branch fitur baru
git checkout -b fitur/nama-fitur
```

Contoh nama branch:
- `fitur/halaman-profil`
- `fix/login-error`
- `style/perbaiki-dashboard`

### 3. Kerjakan & Commit

```bash
# Cek file yang berubah
git status

# Lihat detail perubahan
git diff

# Stage semua perubahan
git add .

# Commit dengan pesan yang jelas
git commit -m "feat: tambah halaman profil user"
```

### 4. Push ke Remote

```bash
git push origin fitur/nama-fitur
```

### 5. Buka Pull Request

1. Buka halaman repo di GitHub/GitLab
2. Klik **"New Pull Request"** atau **"Create Merge Request"**
3. Pilih branch `fitur/nama-fitur` -> `main`
4. Isi judul dan deskripsi perubahan
5. Assign reviewer (minta teman review)
6. Tunggu review & approval
7. Setelah di-approve, klik **Merge**

### 6. Setelah PR di-merge

```bash
git checkout main
git pull origin main

# Hapus branch lokal yang sudah di-merge
git branch -d fitur/nama-fitur
```

## Konvensi Commit Message

Format: `<type>: <deskripsi singkat>`

| Type       | Kapan dipakai                    | Contoh                                |
|------------|----------------------------------|---------------------------------------|
| `feat`     | Fitur baru                       | `feat: tambah halaman profil`         |
| `fix`      | Perbaikan bug                    | `fix: login gagal saat email kosong`  |
| `refactor` | Refaktor kode tanpa ubah logic   | `refactor: pisah controller auth`     |
| `style`    | Perubahan UI/CSS                 | `style: perbaiki warna tombol login`  |
| `docs`     | Perubahan dokumentasi            | `docs: update README setup`           |
| `test`     | Tambah/ubah test                 | `test: tambah test login`             |
| `chore`    | Maintenance (deps, config)       | `chore: update laravel ke v12.1`      |

## Struktur Project

```
last_test/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── LoginController.php       # Login & Logout
│   │   │   │   └── RegisterController.php    # Registrasi user baru
│   │   │   └── DashboardController.php       # Halaman dashboard
│   │   └── Requests/
│   │       └── Auth/
│   │           └── LoginRequest.php          # Validasi + rate limit login
│   └── Models/
│       └── User.php                          # Model user
│
├── database/
│   ├── factories/
│   │   └── UserFactory.php                   # Factory untuk generate user dummy
│   ├── migrations/                           # Skema database
│   └── seeders/
│       └── DatabaseSeeder.php                # Seed admin + 5 dummy users
│
├── resources/views/
│   ├── auth/
│   │   ├── login.blade.php                   # Form login
│   │   └── register.blade.php                # Form registrasi
│   ├── dashboard/
│   │   └── index.blade.php                   # Halaman dashboard
│   └── layouts/
│       ├── base.blade.php                    # HTML skeleton
│       ├── app.blade.php                     # Layout untuk user login (navbar)
│       └── guest.blade.php                   # Layout untuk halaman auth
│
├── routes/
│   └── web.php                               # Semua route web
│
├── docker-compose.yml                        # PostgreSQL & Redis containers
├── Makefile                                  # Shortcut commands
├── .env.example                              # Template environment variables
└── README.md                                 # Dokumentasi ini
```

## Troubleshooting

### Port 5432 sudah dipakai

```bash
# Cek proses yang pakai port 5432
sudo lsof -i :5432

# Atau ganti port di docker-compose.yml
ports:
  - "5433:5432"
# Lalu update DB_PORT=5433 di .env
```

### Port 6379 sudah dipakai

```bash
# Cek proses yang pakai port 6379
sudo lsof -i :6379

# Atau ganti port di docker-compose.yml
ports:
  - "6380:6379"
# Lalu update REDIS_PORT=6380 di .env
```

### PHP extension tidak ditemukan

```bash
# Cek extension yang terinstall
php -m

# Install yang kurang (Ubuntu/Debian)
sudo apt install php8.2-pgsql php8.2-redis
sudo systemctl restart php8.2-fpm
```

### Migration gagal

```bash
# Pastikan Docker container PostgreSQL sudah running
docker compose ps

# Cek koneksi database
php artisan db:show

# Coba migrate ulang
php artisan migrate:fresh --seed
```
