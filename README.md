<<<<<<< HEAD

## Instalasi

1. Clone repo:

```bash
git clone https://github.com/Hilmi27/Booking_Gedung.git
cd Booking_Gedung
```

2. Install dependency:

```bash
composer install
npm install
```

3. Setup environment:

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env`, ganti pengaturan database dari `sqlite` → `mysql`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel-12-venue-booking
DB_USERNAME=root
DB_PASSWORD=
```

Buat database-nya dulu di MySQL:

```sql
CREATE DATABASE 'laravel-12-venue-booking';
```

4. Jalankan migrasi + seeder (membuat semua tabel):

```bash
php artisan migrate --seed
```

5. Link folder storage untuk file uploads:

```bash
php artisan storage:link
```

6. Jalankan aplikasi:

```bash
php artisan serve
```

Buka: http://127.0.0.1:8000

## Admin Dashboard

Login admin dengan melihat di UserSeeder.php :

```bash
php artisan make:filament-user
```

(Masukkan nama, email, dan password saat diminta.)

# Lalu login di: http://localhost:8000/admin
