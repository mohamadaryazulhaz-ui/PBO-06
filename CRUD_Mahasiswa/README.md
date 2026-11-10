# Tugas 3 — Pengembangan CRUD Mahasiswa (PHP 8+)

Project ini melanjutkan Praktikum 05. Fitur CRUD, pencarian, session, CSRF token, validasi model, dan NIM tetap dipertahankan.

## Pengembangan
- Pilihan jenis mahasiswa: Reguler atau Beasiswa.
- Data tambahan: UKT (angka >= 0) dan potongan (0–100%).
- Tabel menampilkan jenis, UKT, potongan, dan UKT akhir.
- Edit boleh mengubah jenis, UKT, dan potongan, tetapi NIM tetap readonly dan diverifikasi melalui NIM lama.
- `MahasiswaReguler` dan `MahasiswaBeasiswa` merupakan child class dari `Mahasiswa` dan melakukan override `hitungUkt()`.
- Potongan mahasiswa reguler selalu diset 0 oleh model.

## Rumus
- Reguler: UKT akhir = UKT.
- Beasiswa: UKT akhir = UKT × (1 − potongan/100).

## Menjalankan
Salin folder `Task3_CRUD_Mahasiswa` ke `htdocs`, jalankan Apache XAMPP, lalu buka `http://localhost/Task3_CRUD_Mahasiswa/`.

## Pengujian
Jalankan `php tests/test_model.php` untuk tes CRUD Praktikum 05 dan `php tests/test_inheritance.php` untuk tes inheritance, perhitungan, serta validasi UKT/potongan.

Data tetap menggunakan PHP Session sesuai project awal, bukan database permanen.
