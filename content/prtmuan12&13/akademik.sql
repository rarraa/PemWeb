CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nim` VARCHAR(15) NOT NULL,
  `nama` VARCHAR(100) NOT NULL,
  `prodi` VARCHAR(50) NOT NULL,
  `angkatan` INT(4) NOT NULL
);

-- Contoh isi data awal (opsional, biar tabel tidak kosong)
INSERT INTO `mahasiswa` (`nim`, `nama`, `prodi`, `angkatan`) VALUES
('23010101', 'Budi Santoso', 'Teknik Informatika', 2023),
('23010102', 'Siti Aminah', 'Sistem Informasi', 2023);