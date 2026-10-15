<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . '/../data/menu.php';

if (!isset($_SESSION['keranjang']) || !is_array($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

function e($value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function rupiah(int $angka): string {
    return 'Rp' . number_format($angka, 0, ',', '.');
}

function hitungSubtotalItem(int $harga, int $jumlah): int {
    return $harga * $jumlah;
}

function hitungSubtotalKeranjang(array $keranjang, array $menu): int {
    $subtotal = 0;
    foreach ($keranjang as $kode => $jumlah) {
        if (isset($menu[$kode]) && is_int($jumlah) && $jumlah > 0) {
            $subtotal += hitungSubtotalItem((int)$menu[$kode]['harga'], $jumlah);
        }
    }
    return $subtotal;
}

function hitungDiskon(int $subtotal): int {
    return $subtotal >= 50000 ? (int) round($subtotal * 0.10) : 0;
}

function ambilFlash(): ?array {
    if (!isset($_SESSION['flash'])) {
        return null;
    }
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $flash;
}

function setFlash(string $jenis, string $pesan): void {
    $_SESSION['flash'] = ['jenis' => $jenis, 'pesan' => $pesan];
}

function redirectKe(string $lokasi): void {
    header('Location: ' . $lokasi);
    exit;
}

function kategoriAktif(array $kategoriTersedia): string {
    $dariGet = $_GET['kategori'] ?? null;
    if (is_string($dariGet) && in_array($dariGet, $kategoriTersedia, true)) {
        return $dariGet;
    }

    $dariCookie = $_COOKIE['kategori_favorit'] ?? 'Semua';
    if (is_string($dariCookie) && in_array($dariCookie, $kategoriTersedia, true)) {
        return $dariCookie;
    }
    return 'Semua';
}
