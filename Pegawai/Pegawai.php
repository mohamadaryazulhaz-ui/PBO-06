<?php
declare(strict_types=1);

class Pegawai
{
    public function __construct(
        protected string $id,
        protected string $nama,
        protected float $gajiPokok
    ) {
        $this->id = trim($id);
        $this->nama = trim($nama);
        if ($this->id === '' || $this->nama === '') {
            throw new InvalidArgumentException('ID dan nama wajib diisi.');
        }
        if (!is_finite($gajiPokok) || $gajiPokok < 0) {
            throw new InvalidArgumentException('Gaji pokok tidak boleh negatif.');
        }
    }

    public function getId(): string { return $this->id; }
    public function getNama(): string { return $this->nama; }
    public function getGajiPokok(): float { return $this->gajiPokok; }

    public function hitungGaji(): float
    {
        return $this->gajiPokok;
    }
}
