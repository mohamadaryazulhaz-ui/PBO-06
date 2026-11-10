<?php
declare(strict_types=1);
require_once __DIR__ . '/Mahasiswa.php';

final class MahasiswaReguler extends Mahasiswa
{
    public function hitungUkt(): float { return $this->getUkt(); }
}
