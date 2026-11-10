<?php
declare(strict_types=1);
require_once __DIR__ . '/PegawaiTetap.php';
require_once __DIR__ . '/PegawaiKontrak.php';

$pegawaiTetap = new PegawaiTetap('PG001', 'Andi', 5000000);
$pegawaiKontrak = new PegawaiKontrak('PG002', 'Budi', 4000000);
$daftar = [$pegawaiTetap, $pegawaiKontrak];
function rupiah(float $angka): string { return 'Rp ' . number_format($angka, 0, ',', '.'); }
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><title>Contoh Inheritance Pegawai</title></head><body>
<h1>Hasil Perhitungan Gaji Pegawai</h1>
<table border="1" cellpadding="8" cellspacing="0"><tr><th>ID</th><th>Nama</th><th>Jenis</th><th>Gaji Pokok</th><th>Gaji Akhir</th></tr>
<?php foreach ($daftar as $pegawai): ?>
<tr><td><?= htmlspecialchars($pegawai->getId()) ?></td><td><?= htmlspecialchars($pegawai->getNama()) ?></td>
<td><?= $pegawai instanceof PegawaiTetap ? 'Tetap' : 'Kontrak' ?></td>
<td><?= rupiah($pegawai->getGajiPokok()) ?></td><td><?= rupiah($pegawai->hitungGaji()) ?></td></tr>
<?php endforeach; ?></table></body></html>
