<?php
declare(strict_types=1);
require_once __DIR__ . '/../MahasiswaReguler.php';
require_once __DIR__ . '/../MahasiswaBeasiswa.php';
function cek(bool $ok, string $pesan): void { if (!$ok) throw new RuntimeException('GAGAL: '.$pesan); echo "OK: $pesan\n"; }
function gagal(callable $fn, string $pesan): void { try { $fn(); } catch (InvalidArgumentException) { echo "OK: $pesan\n"; return; } throw new RuntimeException('Seharusnya gagal: '.$pesan); }
$args = ['23001','Andi','FST','Informatika','SMAN 1',4,'Musik','Islam'];
$reg = new MahasiswaReguler(...array_merge($args, ['Reguler', 2000000, 0]));
$bea = new MahasiswaBeasiswa(...array_merge($args, ['Beasiswa', 2000000, 50]));
cek($reg instanceof Mahasiswa && $bea instanceof Mahasiswa, 'Kedua jenis mewarisi Mahasiswa');
cek($reg->hitungUkt() === 2000000.0, 'UKT reguler tanpa potongan');
cek($bea->hitungUkt() === 1000000.0, 'UKT beasiswa setelah potongan 50%');
gagal(fn() => new MahasiswaReguler(...array_merge($args, ['Reguler', -1, 0])), 'UKT negatif ditolak');
gagal(fn() => new MahasiswaBeasiswa(...array_merge($args, ['Beasiswa', 1000000, 101])), 'Potongan di atas 100 ditolak');
echo "Semua tes inheritance selesai.\n";
