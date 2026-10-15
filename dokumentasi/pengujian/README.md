# Dokumentasi Pengujian — UTS Web I

Nama: Ferdiansyah Saragih  
NIM: 25012029  
Kelas: 25M11

## Petunjuk
Jalankan aplikasi terlebih dahulu. Untuk setiap variasi, ambil screenshot asli yang menampilkan URL dan kondisi aplikasi. Simpan file PNG/JPG di folder ini. Catat hasil aktual dan ubah status menjadi **Lulus** atau **Gagal** berdasarkan pengujian nyata. Jangan mengarang screenshot atau hasil aktual.

| ID | Langkah/input | Hasil yang diharapkan | Hasil aktual | Status | Bukti screenshot |
|---|---|---|---|---|---|
| U01 | Buka `index.php` | Minimal 5 menu dengan kode, nama, kategori, harga tampil | Isi setelah uji | Belum diuji | `U01-daftar-menu.png` |
| U02a | Cari `nasi` | Menu yang cocok tampil | Isi setelah uji | Belum diuji | `U02a-cari-ditemukan.png` |
| U02b | Cari `menu-tidak-ada` | Pesan menu tidak ditemukan tampil | Isi setelah uji | Belum diuji | `U02b-cari-kosong.png` |
| U03a | Kirim jumlah kosong lewat POST/DevTools | Ditolak, keranjang tidak berubah | Isi setelah uji | Belum diuji | `U03a-jumlah-kosong.png` |
| U03b | Kirim jumlah `-1` | Ditolak, keranjang tidak berubah | Isi setelah uji | Belum diuji | `U03b-jumlah-negatif.png` |
| U03c | Kirim jumlah `1.5` | Ditolak, keranjang tidak berubah | Isi setelah uji | Belum diuji | `U03c-jumlah-pecahan.png` |
| U03d | Kirim jumlah `0` | Ditolak, keranjang tidak berubah | Isi setelah uji | Belum diuji | `U03d-jumlah-nol.png` |
| U03e | Kirim jumlah `11` | Ditolak, keranjang tidak berubah | Isi setelah uji | Belum diuji | `U03e-jumlah-11.png` |
| U04 | Kirim kode menu `XXX` | Ditolak, keranjang tidak berubah | Isi setelah uji | Belum diuji | `U04-kode-tidak-valid.png` |
| U05a | Tambah menu yang sama hingga jumlah 10 | Jumlah digabung dan tepat 10 | Isi setelah uji | Belum diuji | `U05a-jumlah-10.png` |
| U05b | Tambah lagi hingga melewati 10 | Ditolak, jumlah tetap 10 | Isi setelah uji | Belum diuji | `U05b-melebihi-10.png` |
| U06a | Isi keranjang lalu buka halaman keranjang | Isi tetap tersedia | Isi setelah uji | Belum diuji | `U06a-keranjang.png` |
| U06b | Refresh dan kembali ke daftar menu | Isi keranjang tetap ada | Isi setelah uji | Belum diuji | `U06b-refresh-pindah-halaman.png` |
| U07a | Tambah menu dengan POST valid | Redirect dan flash tampil satu kali | Isi setelah uji | Belum diuji | `U07a-post-redirect.png` |
| U07b | Refresh setelah redirect | Jumlah tidak bertambah dan flash hilang | Isi setelah uji | Belum diuji | `U07b-refresh.png` |
| U08a | Buat subtotal Rp49.000 | Diskon Rp0, total Rp49.000 | Isi setelah uji | Belum diuji | `U08a-subtotal-49000.png` |
| U08b | Buat subtotal Rp50.000 | Diskon Rp5.000, total Rp45.000 | Isi setelah uji | Belum diuji | `U08b-subtotal-50000.png` |
| U09a | Hapus satu item | Item hilang dan total menyesuaikan | Isi setelah uji | Belum diuji | `U09a-hapus-item.png` |
| U09b | Kosongkan keranjang | Keranjang kosong dan pesan tampil | Isi setelah uji | Belum diuji | `U09b-kosongkan.png` |
| U10a | Simpan kategori favorit lalu buka tanpa GET kategori | Kategori mengikuti cookie; masa berlaku 7 hari | Isi setelah uji | Belum diuji | `U10a-cookie-7-hari.png` |
| U10b | Buka dengan `?kategori=Minuman` saat cookie kategori lain | GET menjadi prioritas untuk permintaan tersebut | Isi setelah uji | Belum diuji | `U10b-prioritas-get.png` |
| U11 | Cari teks `<b>uji</b>` | Teks ditampilkan aman, bukan elemen HTML | Isi setelah uji | Belum diuji | `U11-escaping-pencarian.png` |

## Catatan pengujian batas diskon
Menu Paket Hemat berharga Rp49.000. Untuk menguji Rp50.000, tambahkan kombinasi menu yang menghasilkan subtotal tepat Rp50.000, misalnya Nasi Goreng Rp20.000 + Ayam Geprek Rp25.000 + Es Teh Rp5.000.

## Panduan commit bertahap
Lakukan commit setelah setiap tahap selesai dan uji terkait telah dicatat. Jangan membuat semua commit sekaligus di akhir.

1. `chore: inisialisasi project UTS`
2. `feat: daftar menu dan pencarian`
3. `feat: pemesanan dan validasi input`
4. `feat: pengelolaan keranjang session`
5. `feat: perhitungan total dan diskon`
6. `feat: redirect dan flash message`
7. `feat: preferensi kategori dan finalisasi pengujian`

Catat bukti screenshot dalam commit fitur terkait dan push ke GitHub setelah tiap tahap jika koneksi tersedia.
