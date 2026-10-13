<?php
require_once __DIR__ . '/includes/functions.php';

if (is_logged_in()) {
    redirect('dashboard.php');
}

$error = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!csrf_valid()) {
        $error = 'Sesi form tidak valid. Muat ulang halaman.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
        $error = 'Email dan password wajib diisi dengan benar.';
    } else {
        $user = find_user_by_email($email);
        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true); // cegah session fixation
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
            ];
            redirect('dashboard.php');
        }
        $error = 'Email atau password salah.'; // pesan generik
    }
}

$pageTitle = 'Login';
require __DIR__ . '/includes/header.php';
?>
<h1>Masuk</h1>
<?php if ($error): ?>
  <div class="alert error" role="alert"><?= e($error) ?></div>
<?php endif; ?>
<form method="post" novalidate>
  <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
  <label for="email">Email</label>
  <input type="email" id="email" name="email" value="<?= e($email) ?>" required>
  <label for="password">Password</label>
  <input type="password" id="password" name="password" required>
  <button type="submit">Login</button>
</form>
<p class="hint">Belum punya akun? <a href="register.php">Daftar</a></p>
<?php require __DIR__ . '/includes/footer.php'; ?>
