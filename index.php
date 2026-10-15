<?php
require_once __DIR__ . '/includes/fungsi.php';

$judul = 'Daftar Menu — Kantin Kampus';
$q = $_GET['q'] ?? '';
if (!is_string($q)) {
    $q = '';
}
$kategoriAktif = kategoriAktif($kategoriTersedia);
$hasil = [];

foreach ($menu as $item) {
    $cocokNama = $q === '' || stripos($item['nama'], $q) !== false;
    $cocokKategori = $kategoriAktif === 'Semua' || $item['kategori'] === $kategoriAktif;
    if ($cocokNama && $cocokKategori) {
        $hasil[] = $item;
    }
}

require __DIR__ . '/includes/header.php';
?>
<section class="intro">
    <div>
        <p class="eyebrow">PESAN • BAYAR • NIKMATI</p>
        <h2>Menu hari ini</h2>
        <p>Pilih menu, tentukan jumlah, lalu tambahkan ke keranjang.</p>
    </div>
</section>

<section class="panel">
    <form method="get" action="index.php" class="search-form">
        <label for="q">Cari nama menu</label>
        <input id="q" type="text" name="q" value="<?= e($q) ?>" placeholder="Contoh: nasi">
        <?php if (isset($_GET['kategori']) && in_array($kategoriAktif, $kategoriTersedia, true)): ?>
            <input type="hidden" name="kategori" value="<?= e($kategoriAktif) ?>">
        <?php endif; ?>
        <button type="submit">Cari</button>
        <a class="button secondary" href="index.php">Reset</a>
    </form>

    <form method="post" action="proses.php" class="category-form">
        <input type="hidden" name="aksi" value="simpan_kategori">
        <label for="kategori">Kategori favorit (disimpan 7 hari)</label>
        <select name="kategori" id="kategori" required>
            <?php foreach ($kategoriTersedia as $kat): ?>
                <option value="<?= e($kat) ?>" <?= $kategoriAktif === $kat ? 'selected' : '' ?>><?= e($kat) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="secondary">Simpan preferensi</button>
        <span class="hint">Kategori GET akan mengesampingkan cookie untuk permintaan tersebut.</span>
    </form>
</section>

<?php if (!$hasil): ?>
    <div class="empty-state">
        <h3>Menu tidak ditemukan</h3>
        <p>Tidak ada menu yang cocok dengan pencarian “<?= e($q) ?>” dan kategori “<?= e($kategoriAktif) ?>”.</p>
    </div>
<?php else: ?>
    <div class="menu-grid">
    <?php foreach ($hasil as $item): ?>
        <article class="menu-card">
            <div class="menu-card-top">
                <span class="category-tag"><?= e($item['kategori']) ?></span>
                <span class="menu-code"><?= e($item['kode']) ?></span>
            </div>
            <h3><?= e($item['nama']) ?></h3>
            <p class="price"><?= rupiah((int)$item['harga']) ?></p>
            <form method="post" action="proses.php" class="order-form">
                <input type="hidden" name="aksi" value="tambah">
                <input type="hidden" name="kode" value="<?= e($item['kode']) ?>">
                <label for="jumlah-<?= e($item['kode']) ?>">Jumlah (1–10)</label>
                <input id="jumlah-<?= e($item['kode']) ?>" type="number" name="jumlah" min="1" max="10" step="1" value="1" required>
                <button type="submit">Tambah ke keranjang</button>
            </form>
        </article>
    <?php endforeach; ?>
    </div>
<?php endif; ?>
<?php require __DIR__ . '/includes/footer.php'; ?>
