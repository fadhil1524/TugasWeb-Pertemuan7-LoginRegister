<?php
require_once __DIR__ . '/includes/functions.php';

if (is_logged_in()) {
    redirect('dashboard.php');
}

$errors = [];
$old = ['name' => '', 'email' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';
    $old = ['name' => $name, 'email' => $email];

    if (!csrf_valid()) {
        $errors[] = 'Sesi form tidak valid. Muat ulang halaman.';
    }
    if ($name === '' || mb_strlen($name) < 3) {
        $errors[] = 'Nama minimal 3 karakter.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Format email tidak valid.';
    }
    if (strlen($password) < 8) {
        $errors[] = 'Password minimal 8 karakter.';
    }
    if ($password !== $confirm) {
        $errors[] = 'Konfirmasi password tidak sama.';
    }
    if (!$errors && find_user_by_email($email)) {
        $errors[] = 'Email sudah terdaftar.';
    }

    if (!$errors) {
        $users = load_users();
        $users[] = [
            'id' => count($users) + 1,
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
        ];
        if (save_users($users)) {
            set_flash('success', 'Registrasi berhasil. Silakan login.');
            redirect('login.php');
        }
        $errors[] = 'Gagal menyimpan data. Cek izin tulis folder data/.';
    }
}

$pageTitle = 'Registrasi';
require __DIR__ . '/includes/header.php';
?>
<h1>Buat akun</h1>
<?php foreach ($errors as $err): ?>
  <div class="alert error" role="alert"><?= e($err) ?></div>
<?php endforeach; ?>
<form method="post" novalidate>
  <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
  <label for="name">Nama</label>
  <input type="text" id="name" name="name" value="<?= e($old['name']) ?>" required>
  <label for="email">Email</label>
  <input type="email" id="email" name="email" value="<?= e($old['email']) ?>" required>
  <label for="password">Password</label>
  <input type="password" id="password" name="password" required>
  <label for="confirm">Konfirmasi password</label>
  <input type="password" id="confirm" name="confirm" required>
  <button type="submit">Daftar</button>
</form>
<p class="hint">Sudah punya akun? <a href="login.php">Login</a></p>
<?php require __DIR__ . '/includes/footer.php'; ?>
