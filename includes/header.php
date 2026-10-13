<?php require_once __DIR__ . '/functions.php'; $flash = get_flash(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($pageTitle ?? 'Login System') ?></title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<main class="card">
<?php if ($flash): ?>
  <div class="alert <?= e($flash['type']) ?>" role="alert"><?= e($flash['message']) ?></div>
<?php endif; ?>
