# UTS Web I — Pemesanan Kantin Kampus

**Nama:** Ferdiansyah Saragih  
**NIM:** 25012029  
**Kelas:** 25M11  

## Deskripsi
Aplikasi pemesanan kantin kampus berbasis PHP Native. Fitur: daftar dan pencarian menu, filter kategori dengan cookie, keranjang berbasis session, validasi pesanan, subtotal, diskon 10% untuk subtotal minimal Rp50.000, hapus item, kosongkan keranjang, serta flash message dengan pola Post/Redirect/Get.

## Kebutuhan
- PHP 8.x (PHP 7.4+ umumnya kompatibel)
- Visual Studio Code
- Browser
- Git dan akun GitHub untuk pengumpulan

Tidak menggunakan framework maupun database. Data menu disimpan dalam array PHP.

## Cara menjalankan
1. Buka folder project ini di Visual Studio Code.
2. Pastikan PHP tersedia di terminal dengan `php -v`.
3. Dari terminal VS Code, jalankan `php -S localhost:8000`.
4. Buka `http://localhost:8000` di browser.
5. Untuk menghentikan server, tekan `Ctrl+C` pada terminal.

Alternatif: letakkan folder di direktori server lokal yang mendukung PHP, lalu akses melalui localhost.

## Struktur folder
```text
uts-web1-25012029/
├── README.md
├── index.php
├── keranjang.php
├── proses.php
├── data/menu.php
├── includes/fungsi.php
├── includes/header.php
├── includes/footer.php
├── assets/style.css
└── dokumentasi/pengujian/
    └── README.md
```

## Identitas dan pengumpulan
Buat repository GitHub bernama `uts-web1-25012029` dan pastikan repository dapat diakses dosen. Commit secara bertahap sesuai panduan pada dokumentasi/pengujian/README.md. Screenshot pengujian harus berasal dari aplikasi yang benar-benar dijalankan.

## Catatan keamanan
Input divalidasi di server dan output pengguna di-escape dengan `htmlspecialchars`. Cookie kategori hanya menyimpan kategori yang dikenal. Aplikasi ini untuk kebutuhan praktik, bukan aplikasi produksi.
