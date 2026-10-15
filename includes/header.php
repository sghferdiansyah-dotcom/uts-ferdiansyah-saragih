<?php
$flash = ambilFlash();
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($judul ?? 'Kantin Kampus') ?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header class="site-header">
    <div class="container header-inner">
        <div>
            <p class="eyebrow">WEB I · 25M11</p>
            <h1>Kantin Kampus</h1>
            <p class="muted">Pemesanan sederhana dengan PHP Native</p>
        </div>
        <nav>
            <a href="index.php">Daftar Menu</a>
            <a href="keranjang.php">Keranjang (<?= array_sum($_SESSION['keranjang'] ?? []) ?>)</a>
        </nav>
    </div>
</header>
<main class="container">
<?php if ($flash): ?>
    <div class="flash <?= e($flash['jenis']) ?>" role="status"><?= e($flash['pesan']) ?></div>
<?php endif; ?>
