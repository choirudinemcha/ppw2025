<div align="center">
  <img src="https://laravel.com/img/logomark.min.svg" width="80" alt="Laravel Logo" />
  <h1>Laravel Job Portal</h1>
  <p><em>Portal Lowongan Kerja berbasis Laravel – Praktikum Pemrograman Web</em></p>

  <p>
    <a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-11.x-red?logo=laravel" alt="Laravel Badge" /></a>
    <a href="https://www.php.net/"><img src="https://img.shields.io/badge/PHP-8.2-blue?logo=php" alt="PHP Badge" /></a>
    <a href="https://www.mysql.com/"><img src="https://img.shields.io/badge/MySQL-8.0-orange?logo=mysql" alt="MySQL Badge" /></a>
    <a href="https://www.docker.com/"><img src="https://img.shields.io/badge/Docker-Compose-2496ED?logo=docker" alt="Docker Badge" /></a>
    <a href="https://github.com/"><img src="https://img.shields.io/badge/CI/CD-GitHub%20Actions-black?logo=github" alt="CI/CD Badge" /></a>
  </p>
</div>

---

## 📘 Deskripsi Proyek
**Laravel Job Portal** adalah aplikasi berbasis web yang dikembangkan dalam rangka **Praktikum Pemrograman Web menggunakan Laravel**.
Mahasiswa akan belajar membangun aplikasi web **real-world** mulai dari **autentikasi**, **CRUD**, **upload file**, **email notifikasi**, hingga **deployment** menggunakan Docker & CI/CD.

Aplikasi ini mensimulasikan sistem rekrutmen online sederhana, di mana:
- **Admin** dapat menambahkan dan mengelola lowongan pekerjaan.
- **User (Pelamar)** dapat mendaftar, melamar pekerjaan, dan mengunggah CV.
- Setiap lamaran akan mengirimkan notifikasi **email otomatis** ke admin.

---

## 🎯 Tujuan Pembelajaran
- Memahami konsep **MVC (Model–View–Controller)** pada Laravel.
- Mengimplementasikan fitur web modern (Auth, CRUD, Upload, API, Mail).
- Memahami integrasi sistem menggunakan **Docker** dan **CI/CD**.
- Melatih keterampilan debugging, dokumentasi, dan kolaborasi dengan Git.

---

## ⚙️ Instalasi dan Konfigurasi

### 1️⃣ Clone Repository
```bash
git clone https://github.com/username/job-portal.git
cd job-portal
```

### 2️⃣ Install Dependency
```composer install
npm install
```

### 3️⃣ Konfigurasi `.env`
```
cp .env.example .env
```

Ubah sesuai setup lokal:
```
APP_NAME="Job Portal"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jobportal
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@jobportal.test
MAIL_FROM_NAME="Job Portal"
```
### 4️⃣ Jalankan Migrasi dan Key Generator
```
php artisan key:generate
php artisan migrate
```

### 5️⃣ Jalankan Server
```
php artisan serve
npm run dev
```


## 🧩 Struktur Folder Penting
| Folder                  | Fungsi                              |
| ----------------------- | ----------------------------------- |
| `/routes/web.php`       | Menyimpan definisi route aplikasi   |
| `/app/Http/Controllers` | Logika aplikasi (Controller)        |
| `/app/Models`           | Representasi tabel database (Model) |
| `/resources/views`      | Template tampilan (Blade)           |
| `/database/migrations`  | Skrip pembuat tabel database        |
| `.env`                  | File konfigurasi environment        |


## 🧱 Fitur Utama
| Fitur                        | Deskripsi                                                 |
| ---------------------------- | --------------------------------------------------------- |
| 🔐 **Authentication**        | Login, register, logout dengan Laravel Breeze atau manual |
| 💼 **Job CRUD**              | Admin dapat menambah, mengedit, dan menghapus lowongan    |
| 🧾 **Lamaran Pekerjaan**     | User melamar dan mengunggah CV (PDF)                      |
| 📬 **Email Notifikasi**      | Mengirim email ke admin saat ada lamaran baru             |
| 📤 **Export & Import Excel** | Menggunakan package Laravel Excel                         |
| 🔗 **API Laravel Sanctum**   | Akses data lowongan dan lamaran via token                 |
| 🐳 **Docker Environment**    | Laravel, MySQL, Redis, dan Mail service dalam container   |
| ⚙️ **CI/CD Pipeline**        | Build & Deploy otomatis dari GitHub/GitLab                |


## GitLab
### 🐳 Menjalankan dengan Docker
```
docker compose up -d
```

### Konfigurasi Container
Pastikan `docker-compose.yml` berisi:
```
version: '3.8'
services:
  app:
    build: .
    ports:
      - "8000:8000"
    volumes:
      - .:/var/www/html
    depends_on:
      - db

  db:
    image: mysql:8
    environment:
      MYSQL_DATABASE: jobportal
      MYSQL_ROOT_PASSWORD: root
    ports:
      - "3306:3306"
```