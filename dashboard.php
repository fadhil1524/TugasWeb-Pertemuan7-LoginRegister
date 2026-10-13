<?php
require_once __DIR__ . '/includes/functions.php';
require_login();

$user = $_SESSION['user'];
$pageTitle = 'Dashboard';
require __DIR__ . '/includes/header.php';
?>
<h1>Dashboard</h1>
<p>Halo, <strong><?= e($user['name']) ?></strong>.</p>
<dl>
  <dt>Email</dt><dd><?= e($user['email']) ?></dd>
  <dt>ID pengguna</dt><dd><?= e((string) $user['id']) ?></dd>
</dl>
<form method="post" action="logout.php">
  <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
  <button type="submit" class="secondary">Logout</button>
</form>
<?php require __DIR__ . '/includes/footer.php'; ?>
