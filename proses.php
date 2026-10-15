<?php
require_once __DIR__ . '/includes/fungsi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirectKe('index.php');
}

$aksi = $_POST['aksi'] ?? '';

if ($aksi === 'tambah') {
    $kode = $_POST['kode'] ?? null;
    $jumlahRaw = $_POST['jumlah'] ?? null;

    if (!is_string($kode) || !isset($menu[$kode])) {
        setFlash('error', 'Kode menu tidak valid. Keranjang tidak diubah.');
        redirectKe('index.php');
    }

    // Validasi bentuk bilangan bulat secara ketat, termasuk menolak kosong, pecahan, nol, dan negatif.
    if (!is_string($jumlahRaw) || !preg_match('/^(?:[1-9]|10)$/', $jumlahRaw)) {
        setFlash('error', 'Jumlah harus bilangan bulat antara 1 sampai 10. Keranjang tidak diubah.');
        redirectKe('index.php');
    }

    $jumlah = (int)$jumlahRaw;
    $jumlahLama = (int)($_SESSION['keranjang'][$kode] ?? 0);
    if ($jumlahLama + $jumlah > 10) {
        setFlash('error', 'Penambahan ditolak: jumlah menu ini maksimal 10. Keranjang tetap seperti sebelumnya.');
        redirectKe('index.php');
    }

    $_SESSION['keranjang'][$kode] = $jumlahLama + $jumlah;
    setFlash('success', 'Menu berhasil ditambahkan ke keranjang.');
    redirectKe('keranjang.php');
}

if ($aksi === 'hapus') {
    $kode = $_POST['kode'] ?? null;
    if (is_string($kode) && isset($_SESSION['keranjang'][$kode])) {
        unset($_SESSION['keranjang'][$kode]);
        setFlash('success', 'Item berhasil dihapus dari keranjang.');
    } else {
        setFlash('error', 'Item tidak ditemukan di keranjang.');
    }
    redirectKe('keranjang.php');
}

if ($aksi === 'kosongkan') {
    $_SESSION['keranjang'] = [];
    setFlash('success', 'Keranjang berhasil dikosongkan.');
    redirectKe('keranjang.php');
}

if ($aksi === 'simpan_kategori') {
    $kategori = $_POST['kategori'] ?? null;
    if (!is_string($kategori) || !in_array($kategori, $kategoriTersedia, true)) {
        setFlash('error', 'Kategori tidak valid.');
        redirectKe('index.php');
    }

    setcookie('kategori_favorit', $kategori, [
        'expires' => time() + (7 * 24 * 60 * 60),
        'path' => '/',
        'httponly' => true,
        'samesite' => 'Lax',
        'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
    ]);
    // Cookie baru akan tersedia pada request berikutnya, jadi redirect diperlukan.
    setFlash('success', 'Preferensi kategori berhasil disimpan selama 7 hari.');
    redirectKe('index.php');
}

setFlash('error', 'Aksi tidak dikenali.');
redirectKe('index.php');
