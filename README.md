# Tugas Rutin 7 - Sistem Login/Register (PHP Native + JSON)

## Cara menjalankan
1. Pastikan PHP 8.1+ terpasang (XAMPP/Laragon).
2. Salin folder ini ke `htdocs` (XAMPP) atau `www` (Laragon), atau jalankan `php -S localhost:8000` di dalam folder.
3. Buka `http://localhost:8000/register.php`.
4. Pastikan folder `data/` dapat ditulis oleh PHP.

## Pemenuhan requirement
| # | Requirement | Lokasi |
|---|-------------|--------|
| 1 | Form registrasi + validasi | `register.php` |
| 2 | Validasi email `filter_var()` | `register.php`, `login.php` |
| 3 | `password_hash()` / `password_verify()` | `register.php`, `login.php` |
| 4 | Data di file JSON | `data/users.json` |
| 5 | Cek duplikasi email | `find_user_by_email()` di `register.php` |
| 6 | Login dengan session | `login.php` |
| 7 | Dashboard terproteksi | `dashboard.php` + `require_login()` |
| 8 | Logout `session_destroy()` | `logout.php` |
| 9 | Sanitasi `htmlspecialchars()` | fungsi `e()` |
| 10 | Pesan error & sukses | flash message + alert |

Tambahan: token CSRF, `session_regenerate_id()`, CSS rapi, folder `data/` diproteksi `.htaccess`.
