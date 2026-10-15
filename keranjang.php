<?php
require_once __DIR__ . '/includes/fungsi.php';
$judul = 'Keranjang — Kantin Kampus';
$keranjang = $_SESSION['keranjang'];
$subtotal = hitungSubtotalKeranjang($keranjang, $menu);
$diskon = hitungDiskon($subtotal);
$totalAkhir = $subtotal - $diskon;
require __DIR__ . '/includes/header.php';
?>
<section class="intro">
    <div>
        <p class="eyebrow">RINGKASAN PESANAN</p>
        <h2>Keranjang belanja</h2>
        <p>Pesanan disimpan dalam session selama sesi browser/server masih berlaku.</p>
    </div>
</section>

<?php if (!$keranjang): ?>
    <div class="empty-state">
        <h3>Keranjang masih kosong</h3>
        <p>Silakan pilih menu dari halaman daftar menu.</p>
        <a class="button" href="index.php">Lihat menu</a>
    </div>
<?php else: ?>
    <div class="panel table-wrap">
        <table>
            <thead>
                <tr><th>Menu</th><th>Harga</th><th>Jumlah</th><th>Subtotal</th><th>Aksi</th></tr>
            </thead>
            <tbody>
            <?php foreach ($keranjang as $kode => $jumlah): ?>
                <?php if (isset($menu[$kode])): $item = $menu[$kode]; ?>
                <tr>
                    <td><strong><?= e($item['nama']) ?></strong><small><?= e($kode) ?> · <?= e($item['kategori']) ?></small></td>
                    <td><?= rupiah((int)$item['harga']) ?></td>
                    <td><?= (int)$jumlah ?></td>
                    <td><?= rupiah(hitungSubtotalItem((int)$item['harga'], (int)$jumlah)) ?></td>
                    <td>
                        <form method="post" action="proses.php" onsubmit="return confirm('Hapus item ini?')">
                            <input type="hidden" name="aksi" value="hapus">
                            <input type="hidden" name="kode" value="<?= e($kode) ?>">
                            <button class="danger small" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endif; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="totals">
            <div><span>Subtotal pesanan</span><strong><?= rupiah($subtotal) ?></strong></div>
            <div><span>Diskon (10% jika subtotal ≥ Rp50.000)</span><strong>− <?= rupiah($diskon) ?></strong></div>
            <div class="grand-total"><span>Total akhir</span><strong><?= rupiah($totalAkhir) ?></strong></div>
        </div>
        <div class="cart-actions">
            <a class="button secondary" href="index.php">Tambah menu lain</a>
            <form method="post" action="proses.php" onsubmit="return confirm('Kosongkan semua keranjang?')">
                <input type="hidden" name="aksi" value="kosongkan">
                <button class="danger" type="submit">Kosongkan keranjang</button>
            </form>
        </div>
    </div>
<?php endif; ?>
<?php require __DIR__ . '/includes/footer.php'; ?>
