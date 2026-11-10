<?php
declare(strict_types=1);

/** Model: state private; perubahan hanya lewat method tervalidasi. */
class Mahasiswa
{
    private string $nim; // Identitas tetap: sengaja tidak ada setNim().
    private string $nama;
    private string $fakultas;
    private string $prodi;
    private string $asalSekolah;
    private int $semester;
    private string $hobi;
    private string $agama;

    private string $jenis;
    private float $ukt;
    private float $potongan;

    public const AGAMA = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];

    public function __construct(
        string $nim, string $nama, string $fakultas, string $prodi,
        string $asalSekolah, int $semester, string $hobi, string $agama,
        string $jenis = 'Reguler', float $ukt = 0, float $potongan = 0
    ) {
        $nim = trim($nim);
        if ($nim === '' || strlen($nim) > 30 || !preg_match('/^[A-Za-z0-9-]+$/', $nim)) {
            throw new InvalidArgumentException('NIM wajib diisi (huruf/angka/tanda hubung, maks. 30 karakter).');
        }
        $this->nim = $nim;
        $this->ubahProfil($nama, $fakultas, $prodi, $asalSekolah, $semester, $hobi, $agama, $jenis, $ukt, $potongan);
    }

    // Getter: cara resmi membaca property private.
    public function getNim(): string { return $this->nim; }
    public function getNama(): string { return $this->nama; }
    public function getFakultas(): string { return $this->fakultas; }
    public function getProdi(): string { return $this->prodi; }
    public function getAsalSekolah(): string { return $this->asalSekolah; }
    public function getSemester(): int { return $this->semester; }
    public function getHobi(): string { return $this->hobi; }
    public function getAgama(): string { return $this->agama; }
    public function getJenis(): string { return $this->jenis; }
    public function getUkt(): float { return $this->ukt; }
    public function getPotongan(): float { return $this->potongan; }
    public function hitungUkt(): float { return $this->ukt - ($this->ukt * $this->potongan / 100); }

    /** Perubahan profil terkontrol: semua input diperiksa sebelum ada property diubah. */
    public function ubahProfil(
        string $nama, string $fakultas, string $prodi, string $asalSekolah,
        int $semester, string $hobi, string $agama,
        string $jenis = 'Reguler', float $ukt = 0, float $potongan = 0
    ): void {
        $nama = self::wajib($nama, 'Nama', 100);
        $fakultas = self::wajib($fakultas, 'Fakultas', 100);
        $prodi = self::wajib($prodi, 'Program studi', 100);
        $asalSekolah = self::wajib($asalSekolah, 'Asal sekolah', 120);
        $hobi = trim($hobi);
        if (strlen($hobi) > 120) {
            throw new InvalidArgumentException('Hobi maksimal 120 karakter.');
        }
        if ($semester < 1 || $semester > 14) {
            throw new InvalidArgumentException('Semester harus antara 1 dan 14.');
        }
        if (!in_array($jenis, ['Reguler', 'Beasiswa'], true)) {
            throw new InvalidArgumentException('Jenis mahasiswa tidak valid.');
        }
        if (!is_finite($ukt) || $ukt < 0) {
            throw new InvalidArgumentException('UKT harus berupa angka dan tidak boleh negatif.');
        }
        if (!is_finite($potongan) || $potongan < 0 || $potongan > 100) {
            throw new InvalidArgumentException('Potongan harus antara 0 dan 100 persen.');
        }
        if (!in_array($agama, self::AGAMA, true)) {
            throw new InvalidArgumentException('Pilihan agama tidak valid.');
        }
        // Semua valid: barulah state object diperbarui bersama-sama.
        $this->nama = $nama;
        $this->fakultas = $fakultas;
        $this->prodi = $prodi;
        $this->asalSekolah = $asalSekolah;
        $this->semester = $semester;
        $this->hobi = $hobi;
        $this->agama = $agama;
        $this->jenis = $jenis;
        $this->ukt = $ukt;
        $this->potongan = $jenis === 'Beasiswa' ? $potongan : 0.0;
    }

    private static function wajib(string $nilai, string $label, int $maks): string
    {
        $nilai = trim($nilai);
        if ($nilai === '' || strlen($nilai) > $maks) {
            throw new InvalidArgumentException("{$label} wajib diisi dan maksimal {$maks} byte.");
        }
        return $nilai;
    }
}
