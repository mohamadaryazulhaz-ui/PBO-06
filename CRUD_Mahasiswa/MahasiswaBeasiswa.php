<?php
declare(strict_types=1);
require_once __DIR__ . '/Mahasiswa.php';

final class MahasiswaBeasiswa extends Mahasiswa
{
    public function hitungUkt(): float
    {
        return $this->getUkt() * (1 - $this->getPotongan() / 100);
    }
}
