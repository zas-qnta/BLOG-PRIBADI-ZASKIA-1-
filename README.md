# 🌊 Ocean Personal Blog - Zaskia Qanita

Proyek ini adalah blog pribadi interaktif dengan tema estetika laut ("Ocean Theme"). Dikembangkan sebagai bagian dari tugas pemrograman web untuk menampilkan identitas mahasiswa, daftar keahlian, serta implementasi interaksi dinamis menggunakan JavaScript, PHP, dan MySQL.

## 🚀 Fitur Utama

* **Desain Responsif**: Tampilan yang menyesuaikan dengan perangkat mobile maupun desktop menggunakan palet warna biru laut, oranye, dan cokelat.
* **Integrasi Database**: Kemampuan untuk menyimpan data pengunjung (nama, email, alamat) langsung ke database MySQL melalui PHP.
* **Interaksi DOM**: Manipulasi elemen HTML secara real-time seperti salam dinamis ("Selamat Pagi/Siang/Malam") berdasarkan waktu.
* **Modal Kontak Interaktif**: Pop-up khusus untuk memudahkan pengunjung menghubungi pemilik blog via WhatsApp atau Instagram.
* **Tabel Data Dinamis**: Menampilkan daftar pengunjung terbaru yang diambil langsung dari database `db_blog_zaskia`.

## 🛠️ Teknologi yang Digunakan

* **Frontend**: 
    * **HTML5 & CSS3**: Struktur semantik dan desain variabel warna (`--ocean-dark`, `--coral`, dll).
    * **JavaScript (ES6+)**: Logika interaksi, fungsi arrow, dan manajemen event handling.
* **Backend**:
    * **PHP**: Pemrosesan formulir, manajemen sesi untuk pesan status, dan koneksi database.
    * **MySQL**: Penyimpanan data relasional pada tabel `kontak_masuk`.

## 📂 Struktur File

* `index.php`: File utama yang berisi logika backend PHP dan tampilan blog terintegrasi.
* `script.js`: Logika interaksi JavaScript untuk fitur salam dan validasi.
* `style.css`: Kumpulan gaya desain ocean theme (backup/eksternal).
* `test.html`: Prototipe tampilan statis awal.
* `zaskia1.jpeg`: Aset gambar profil.

## ⚙️ Persiapan Database

Untuk menjalankan fitur form, pastikan kamu memiliki tabel berikut di phpMyAdmin:

```sql
CREATE DATABASE db_blog_zaskia;

USE db_blog_zaskia;

CREATE TABLE kontak_masuk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    email VARCHAR(100),
    alamat TEXT,
    waktu_kirim TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);