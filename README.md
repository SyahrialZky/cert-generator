

# 🧾 Certificate Generator & Validator using Laravel & Tailwind CSS

A fullstack web application developed with **Laravel 10**, **Tailwind CSS**, and **Preline UI components**, designed to automate the creation and validation of event certificates. The system enables efficient certificate management and public validation using unique certificate numbers.

---

## 🚀 Features

- ✅ CRUD Certificate Templates
- ✅ CRUD Event Management
- ✅ Participant Management (Add / Import Excel)
- ✅ Automatic Certificate Image Generation
- ✅ Public Certificate Validation
- ✅ RESTful Laravel API Routing
- ✅ Frontend UI with Tailwind + Preline
- ✅ Deployed with CWP Panel (CentOS Web Panel)

---

## 🛠️ Tech Stack

| Layer        | Tools / Frameworks                     |
|--------------|-----------------------------------------|
| Backend      | Laravel 10, MySQL, GD Library           |
| Frontend     | Blade, Tailwind CSS, Preline UI         |
| Utilities    | Laravel Routing API, ZipArchive, Carbon |

---

## ⚙️ Local Development Setup

### ✅ Requirements

- PHP 8.1+
- Composer
- Node.js (v18+)
- Laravel 10
- MySQL / MariaDB
- GD Library (image processing)
- Font: `poppins.medium.ttf` in `public/font/`

### 📥 Installation Steps

```bash
# 1. Clone the repository
git clone https://github.com/your-username/certificate-generator.git
cd certificate-generator

# 2. Install backend dependencies
composer install

# 3. Copy environment configuration
cp .env.example .env
php artisan key:generate

# 4. Setup DB in .env
DB_DATABASE=your_db
DB_USERNAME=your_user
DB_PASSWORD=your_pass

# 5. Run DB migrations
php artisan migrate

# 6. Install frontend assets
npm install
npm run dev   # for development
# or npm run build   # for production

# 7. Serve the application
php artisan serve
```
### 📁 Project Structure

```bash
├── app/
│   └── Http/
│       └── Controllers/          # Laravel Controllers
│
├── resources/
│   └── views/
│       ├── layouts/              # Blade layouts (TailwindCSS + Preline)
│       └── pages/                # UI pages (Dashboard, Validator, etc.)
│
├── public/
│   ├── certificates/             # Generated certificate image files
│   └── font/                     # Custom fonts (e.g., Poppins)
│
├── routes/
│   ├── web.php                   # Web routes (Blade-based views)
│   └── api.php                   # API routes (RESTful endpoints)
│
├── tailwind.config.js            # TailwindCSS configuration
├── vite.config.js                # Vite build tool configuration
└── .env                          # Environment variables
```


### 🔑 API Endpoint
| Method | Endpoint                        | Function                    |
| ------ | ------------------------------- | --------------------------- |
| GET    | `/api/data`                     | List all certificates       |
| POST   | `/api/store`                    | Create new certificate      |
| POST   | `/api/generate-certificate`     | Generate certificates (zip) |
| POST   | `/api/check-certificate-number` | Validate by unique code     |
| POST   | `/peserta/import`               | Import participant via CSV  |



