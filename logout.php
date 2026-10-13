<?php
require_once __DIR__ . '/includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_valid()) {
    $_SESSION = [];
    session_destroy();
    session_start();
    set_flash('success', 'Anda berhasil logout.');
}
redirect('login.php');
