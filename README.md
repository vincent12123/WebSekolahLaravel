# Website Sekolah Laravel

Website sekolah yang dibangun dengan Laravel 12, Filament Admin Panel v3, dan Tailwind CSS. Aplikasi ini menyediakan fitur lengkap untuk mengelola konten sekolah termasuk pengumuman, artikel, galeri, ekstrakurikuler, lowongan pekerjaan, dan banyak lagi.

## 🚀 Fitur Utama

### Frontend (User)
- **Homepage** - Halaman utama dengan tampilan berita terkini
- **Announcements** - Pengumuman sekolah dengan fitur penting/urgent
- **Articles** - Sistem blog dengan kategori dan komentar
- **Gallery** - Album foto kegiatan sekolah dengan lightbox
- **Downloads** - Manajemen file download berdasarkan kategori
- **Extracurriculars** - Informasi kegiatan ekstrakurikuler
- **Job Listings** - Lowongan pekerjaan dengan sistem aplikasi online
- **Staff Directory** - Profil guru dan staff sekolah
- **Complaint Form** - Form pengaduan untuk siswa/orangtua

### Backend (Admin Panel - Filament v3)
- **Dashboard** - Overview statistik website
- **Content Management**
  - Announcements Management
  - Articles & Categories Management
  - Comments Moderation
- **Media Management**
  - Gallery Albums & Photos
  - File Downloads by Category
- **School Management**
  - Extracurriculars
  - Staff Profiles
  - Job Listings & Applications
  - Complaints/Feedback
- **Blog System** (Filament Blog Plugin)
  - Posts Management
  - Categories & Tags
- **User Management**
  - Admin users with roles

## 🛠️ Tech Stack

- **Framework**: Laravel 12.36.1
- **PHP**: 8.4.14
- **Admin Panel**: Filament v3
- **Database**: MySQL 8.x
- **Frontend**: 
  - Blade Templates
  - Tailwind CSS v4
  - Vanilla JavaScript
- **Additional Packages**:
  - Filament Blog Plugin
  - Laravel Debugbar (development)

## 📋 Requirements

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL/MariaDB
- Apache/Nginx

## ⚙️ Installation

### 1. Clone Repository
```bash
git clone https://github.com/vincent12123/WebSekolahLaravel.git
cd WebSekolahLaravel
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Configuration
Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blogweb
DB_USERNAME=root
DB_PASSWORD=your_password

# Timezone
APP_TIMEZONE=Asia/Jakarta
```

### 5. Run Migrations & Seeders
```bash
php artisan migrate:fresh --seed
```

Seeder akan membuat:
- 1 Admin user (email: `admin@example.com`, password: `password`)
- 5 Categories
- 6 Sample Articles
- 5 Announcements
- 5 Gallery Albums
- 4 Download Categories dengan files
- 6 Extracurriculars
- 4 Job Listings
- 8 Staff Members

### 6. Storage Link
```bash
php artisan storage:link
```

### 7. Build Assets
```bash
npm run build
# atau untuk development
npm run dev
```

### 8. Run Development Server
```bash
php artisan serve
```

Akses aplikasi di `http://localhost:8000`

## 👤 Default Login

**Admin Panel** (`/admin`)
- Email: `admin@example.com`
- Password: `password`

## 📁 Project Structure

```
app/
├── Filament/          # Filament admin resources
│   └── Resources/     # CRUD resources untuk setiap model
├── Http/
│   └── Controllers/   # Frontend controllers
├── Models/            # Eloquent models
└── Observers/         # Model observers (auto slug)

database/
├── migrations/        # Database migrations
└── seeders/          # Sample data seeders

resources/
├── views/
│   ├── layouts/      # Master layouts
│   ├── components/   # Blade components
│   └── [modules]/    # Module views
└── css/              # Tailwind CSS

routes/
└── web.php           # Frontend routes
```

## 🎨 Modules

### 1. Announcements
- CRUD pengumuman
- Filter berdasarkan prioritas (penting/biasa)
- Attachment files (PDF/DOC/Images)
- Published date management

### 2. Articles
- Multi-category blog system
- Rich text editor
- Featured images
- Comment system
- View counter
- Author attribution

### 3. Gallery
- Album-based photo management
- Cover images
- Event date tracking
- Vanilla JS lightbox dengan keyboard navigation

### 4. Downloads
- Category-based file organization
- File type detection
- File size tracking
- Download counter

### 5. Extracurriculars
- Activity information
- Instructor details
- Schedule management
- Gallery album integration

### 6. Job Listings
- Position management
- Job type (Full-time/Part-time/Contract)
- Application deadline
- Online application form
- Application tracking

### 7. Staff Directory
- Staff profiles
- Position hierarchy
- Contact information
- Display order management

### 8. Complaints/Feedback
- Anonymous submission support
- Category selection
- Status tracking (pending/reviewed/resolved)
- Admin response system

## 🔧 Development

### Clear Cache
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### Run Tests
```bash
php artisan test
```

### Code Style
```bash
./vendor/bin/pint
```

## 📝 Additional Features

- **Auto Slug Generation** - Otomatis membuat slug dari title menggunakan Observer
- **Timezone Support** - Sudah dikonfigurasi untuk Asia/Jakarta (WIB)
- **Responsive Design** - Mobile-friendly dengan Tailwind CSS
- **SEO Friendly** - Meta tags dan clean URLs
- **Form Validation** - Client & server-side validation
- **Image Upload** - Dengan preview dan validation
- **Search & Filter** - Pada list pages
- **Pagination** - Untuk semua listing pages

## 🤝 Contributing

Contributions, issues, and feature requests are welcome!

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Author

**Vincent**
- GitHub: [@vincent12123](https://github.com/vincent12123)

## 🙏 Acknowledgments

- [Laravel](https://laravel.com)
- [Filament](https://filamentphp.com)
- [Tailwind CSS](https://tailwindcss.com)
