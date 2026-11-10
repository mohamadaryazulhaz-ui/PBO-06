<?php
declare(strict_types=1);
require_once __DIR__ . '/Pegawai.php';

class PegawaiTetap extends Pegawai
{
    public function __construct(string $id, string $nama, float $gajiPokok)
    {
        parent::__construct($id, $nama, $gajiPokok);
    }

    public function hitungGaji(): float
    {
        return $this->gajiPokok + 500000; // tunjangan tetap
    }
}
