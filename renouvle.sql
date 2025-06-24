-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jun 2025 pada 16.24
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `renouvle`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun_pengguna`
--

CREATE TABLE `akun_pengguna` (
  `id_karyawan` varchar(25) NOT NULL,
  `email_pengguna` varchar(100) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password_pengguna` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akun_pengguna`
--

INSERT INTO `akun_pengguna` (`id_karyawan`, `email_pengguna`, `username`, `password_pengguna`) VALUES
('CO-003', 'christianoctavianus72@gmail.com', 'christoct', 'christ203'),
('H-004', 'handoko-hr@gmail.com', 'handoko', 'handoko23'),
('ME-002', 'michaeleka25@gmail.com', 'eka', 'ekaaja');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bidang_kemampuan`
--

CREATE TABLE `bidang_kemampuan` (
  `id_bidang_kemampuan` varchar(25) NOT NULL,
  `nama_bidang_kemampuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bidang_kemampuan`
--

INSERT INTO `bidang_kemampuan` (`id_bidang_kemampuan`, `nama_bidang_kemampuan`) VALUES
('BK/DS/001', 'Designing Skill'),
('BK/DS/002', 'Database Skill'),
('BK/KB/004', 'Kemampuan Bahasa'),
('BK/KM/004', 'Management Skill'),
('BK/SS/003', 'Soft Skill');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pribadi`
--

CREATE TABLE `data_pribadi` (
  `id_karyawan` varchar(25) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `umur` varchar(5) NOT NULL,
  `status_kawin` varchar(25) NOT NULL,
  `email_pribadi` varchar(80) NOT NULL,
  `jenis_kelamin` varchar(5) NOT NULL,
  `jumlah_anak` varchar(5) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon_pribadi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_pribadi`
--

INSERT INTO `data_pribadi` (`id_karyawan`, `nik`, `umur`, `status_kawin`, `email_pribadi`, `jenis_kelamin`, `jumlah_anak`, `alamat`, `telepon_pribadi`) VALUES
('CO-003', '4764798754', '21', 'Belum Menikah', 'christianoctavianus200@gmail.com', 'L', '0', 'Jl.Pungkur', '08524203637'),
('H-004', '8687548746736', '21', 'Sudah Menikah', 'christianooo@gmail.com', 'L', '1', 'Jl.Baleendah', '9e7128969863982'),
('KA-004', '921797328328621', '18', 'Belum Menikah', '', 'L', '1', 'Jl. Garut No 22', '087254907171'),
('ME-002', '8687548746736', '19', 'Belum Menikah', 'michael-aja@gmail.com', 'L', '2', 'Jl.Baleendah', '9e71289698639824'),
('T-003', '1289763128963981264', '26', 'Sudah Menikah', 'opikkopik@gmail.com', 'L', '1', 'Jl.Pasteur', '087724362215');

-- --------------------------------------------------------

--
-- Struktur dari tabel `departemen`
--

CREATE TABLE `departemen` (
  `id_departemen` varchar(25) NOT NULL,
  `nama_departemen` varchar(150) NOT NULL,
  `id_direktur` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `departemen`
--

INSERT INTO `departemen` (`id_departemen`, `nama_departemen`, `id_direktur`) VALUES
('D-HR-002', 'Human Resource', 'CO-003'),
('D-I-003', 'Informasi Teknologi', 'T-003'),
('D-M-001', 'Marketing', 'KA-004'),
('D-O-002', 'Operasional', 'ME-002'),
('D-P-003', 'Produksi', 'ME-002'),
('D-PR-004', 'Public Relation', 'CO-003');

-- --------------------------------------------------------

--
-- Struktur dari tabel `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` varchar(25) NOT NULL,
  `id_departemen` varchar(100) NOT NULL,
  `nama_divisi` varchar(100) NOT NULL,
  `id_manager` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `id_departemen`, `nama_divisi`, `id_manager`) VALUES
('DIV-HT-001', 'D-I-003', 'Technology Analytical', 'KA-004'),
('DIV-HT-004', 'D-HR-002', 'HR Training', 'ME-002'),
('DIV-OR-004', 'D-PR-004', 'Outsourcing Relation', 'ME-002'),
('DIV-S-002', 'D-M-001', 'SEO', 'ME-002');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kemampuan`
--

CREATE TABLE `kemampuan` (
  `id_kemampuan` varchar(25) NOT NULL,
  `id_bidang_kemampuan` varchar(100) NOT NULL,
  `jenis_kemampuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kemampuan`
--

INSERT INTO `kemampuan` (`id_kemampuan`, `id_bidang_kemampuan`, `jenis_kemampuan`) VALUES
('SKILL/BJ/001', 'BK/KB/004', 'Bahasa Jepang'),
('SKILL/DA/001', 'BK/KM/004', 'Management Database'),
('SKILL/DA/002', 'BK/DS/002', 'Database Analysis'),
('SKILL/GD/001', 'BK/DS/001', 'Graphic Designer'),
('SKILL/MC/001', 'BK/KM/004', 'Managenment CRM'),
('SKILL/PS/001', 'BK/SS/003', 'Public Speaking');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kemampuan_karyawan`
--

CREATE TABLE `kemampuan_karyawan` (
  `id_karyawan` varchar(150) NOT NULL,
  `id_jenis_kemampuan` varchar(150) NOT NULL,
  `tingkat_kemampuan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kemampuan_karyawan`
--

INSERT INTO `kemampuan_karyawan` (`id_karyawan`, `id_jenis_kemampuan`, `tingkat_kemampuan`) VALUES
('CO-003', 'SKILL/BJ/001', 'Rata-Rata'),
('CO-003', 'SKILL/DA/001', 'Rata-Rata'),
('CO-003', 'SKILL/GD/001', 'Rata-Rata'),
('H-004', 'SKILL/GD/001', 'Pemula'),
('KA-004', 'SKILL/DA/001', 'Pemula'),
('KA-004', 'SKILL/MC/001', 'Sangat Handal'),
('ME-002', 'SKILL/DA/001', 'Pemula'),
('ME-002', 'SKILL/GD/001', 'Pemula'),
('T-003', 'SKILL/GD/001', 'Handal'),
('T-003', 'SKILL/PS/001', 'Sangat Handal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kemampuan_kerja`
--

CREATE TABLE `kemampuan_kerja` (
  `id_pekerjaan` varchar(25) NOT NULL,
  `id_jenis_kemampuan` varchar(25) NOT NULL,
  `tingkat_kemampuan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kemampuan_kerja`
--

INSERT INTO `kemampuan_kerja` (`id_pekerjaan`, `id_jenis_kemampuan`, `tingkat_kemampuan`) VALUES
('JOB/AS/004', 'SKILL/BJ/001', 'Pemula'),
('JOB/AS/004', 'SKILL/DA/001', 'Rata-Rata'),
('JOB/AS/004', 'SKILL/DA/002', 'Handal'),
('JOB/HJWT/000', 'SKILL/GD/001', 'Rata-Rata'),
('JOB/HJWT/000', 'SKILL/MC/001', 'Rata-Rata'),
('JOB/JSA/000', 'SKILL/DA/001', 'Handal'),
('JOB/JSA/000', 'SKILL/GD/001', 'Handal'),
('JOB/JSA/000', 'SKILL/MC/001', 'Rata-Rata'),
('JOB/JUA/004', 'SKILL/DA/001', 'Pemula'),
('JOB/JUA/004', 'SKILL/MC/001', 'Handal'),
('JOB/SOO/002', 'SKILL/GD/001', 'Pemula'),
('JOB/SSS/001', 'SKILL/DA/001', 'Handal'),
('JOB/SSS/001', 'SKILL/GD/001', 'Pemula'),
('JOB/SUA/003', 'SKILL/DA/001', 'Sangat Handal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontrak_kerja`
--

CREATE TABLE `kontrak_kerja` (
  `id_kontrak` varchar(25) NOT NULL,
  `nama_kontrak` varchar(100) NOT NULL,
  `id_karyawan` varchar(150) NOT NULL,
  `id_struktur_gaji` varchar(100) NOT NULL,
  `id_penanggung_jawab` varchar(150) NOT NULL,
  `tanggal_mulai_kontrak` date NOT NULL,
  `tanggal_akhir_kontrak` date NOT NULL,
  `status_kontrak` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kontrak_kerja`
--

INSERT INTO `kontrak_kerja` (`id_kontrak`, `nama_kontrak`, `id_karyawan`, `id_struktur_gaji`, `id_penanggung_jawab`, `tanggal_mulai_kontrak`, `tanggal_akhir_kontrak`, `status_kontrak`) VALUES
('CON/CO/001', 'Kontrak Kerja untuk Christian', 'CO-003', 'SG-SF-001', 'H-004', '2025-06-27', '2025-06-27', 'Berjalan'),
('CON/KA/002', 'Kontrak Kerja untuk Kevin Alfa', 'KA-004', 'SG-SF2-003', 'H-004', '2025-06-19', '2026-06-30', 'Berjalan'),
('CON/ME/004', 'Kontrak Kerja Eka', 'ME-002', 'SG-SF2-003', 'CO-003', '2025-06-26', '2029-07-19', 'Berjalan'),
('CON/T/003', 'Kontak Untuk Taufiqurrahman', 'T-003', 'SG-I-003', 'ME-002', '2025-06-20', '2025-12-31', 'Berakhir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lowongan`
--

CREATE TABLE `lowongan` (
  `id_lowongan` varchar(25) NOT NULL,
  `nama_lowongan` varchar(100) NOT NULL,
  `id_pekerjaan` varchar(100) NOT NULL,
  `tenggat_akhir` date NOT NULL,
  `status_lowongan` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lowongan`
--

INSERT INTO `lowongan` (`id_lowongan`, `nama_lowongan`, `id_pekerjaan`, `tenggat_akhir`, `status_lowongan`) VALUES
('LAS-005', 'Lowongan Auditor SEO', 'JOB/AS/004', '2025-12-03', 'Non-Aktif'),
('LJWT-001', 'Lowongan Junior UX', 'JOB/JUA/004', '2025-06-25', 'Aktif'),
('LOM-004', 'Lowongan Outsourcing Management', 'JOB/SOO/002', '2025-06-26', 'Non-Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_akhir`
--

CREATE TABLE `nilai_akhir` (
  `id_nilai_akhir` varchar(25) NOT NULL,
  `nama_nilai_akhir` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nilai_akhir`
--

INSERT INTO `nilai_akhir` (`id_nilai_akhir`, `nama_nilai_akhir`) VALUES
('NA-001', 'Sangat Buruk'),
('NA-002', 'Perlu Ditindaklanjuti'),
('NA-003', 'Dibawah Ekspektasi'),
('NA-004', 'Sesuai Ekspektasi'),
('NA-005', 'Diatas Ekspektasi'),
('NA-006', 'Sangat Baik'),
('NA-007', 'Rekomendasi Promosi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `id_pekerjaan` varchar(25) NOT NULL,
  `nama_pekerjaan` varchar(100) NOT NULL,
  `id_spesifikasi_kerja` varchar(150) NOT NULL,
  `id_penanggung_jawab` varchar(150) NOT NULL,
  `deskripsi_pekerjaan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pekerjaan`
--

INSERT INTO `pekerjaan` (`id_pekerjaan`, `nama_pekerjaan`, `id_spesifikasi_kerja`, `id_penanggung_jawab`, `deskripsi_pekerjaan`) VALUES
('JOB/AS/004', 'Auditor SEO', 'SP-SS-001', 'ME-002', 'qwilhciuqgbcuqbwoubc'),
('JOB/HJWT/000', 'Junior SEO Auditor', 'SP-SA-002', 'H-004', 'Mengaudit bla bla'),
('JOB/JSA/000', 'Junior HR Waitress Training', 'SP-HWT-002', 'KA-004', ''),
('JOB/JUA/004', 'Junior UX Analytics', 'SP-UA-002', 'H-004', ''),
('JOB/SOO/002', 'Senior SEO Auditor', 'SP-SA-002', 'H-004', 'Mengaudit bla bla'),
('JOB/SSS/001', 'Senior SEO Specialist', 'SP-SS-001', 'ME-002', 'Mengaudit bla bla'),
('JOB/SUA/003', 'Senior UX Analytics', 'SP-UA-002', 'H-004', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelamar`
--

CREATE TABLE `pelamar` (
  `id_pelamar` varchar(25) NOT NULL,
  `nama_pelamar` varchar(150) NOT NULL,
  `id_lowongan` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `id_rekruiter` varchar(150) NOT NULL,
  `id_status_lamaran` varchar(80) NOT NULL,
  `alamat_email` varchar(80) NOT NULL,
  `id_interviewer` varchar(150) NOT NULL,
  `profile_linkedln` varchar(150) NOT NULL,
  `foto_profile` varchar(255) NOT NULL,
  `file_cv` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelamar`
--

INSERT INTO `pelamar` (`id_pelamar`, `nama_pelamar`, `id_lowongan`, `no_telp`, `id_rekruiter`, `id_status_lamaran`, `alamat_email`, `id_interviewer`, `profile_linkedln`, `foto_profile`, `file_cv`) VALUES
('PL--001', 'Jojon', 'LAS-005', '087724363002', 'CO-003', 'SL-006', 'jojonaja@gmail.com', 'H-004', 'wejncuencubewiocbiew', 'foto_685aa9e4dc7180.21263380.jpg', 'cv_Jojon_6691218.pdf'),
('PL-J-003', 'Julian', 'LOM-004', '087724363002', 'H-004', 'SL-007', 'julianfiqri@gmial.com', 'H-004', 'wejncuencubewiocbiew', 'foto_685821ae1eba57.66778821.jpg', 'cv_Julian_8845596.docx'),
('PL-LS-002', 'Laurentius Stephen', 'LJWT-001', '087724363002', 'H-004', 'SL-012', 'laurentius@gmail.com', 'CO-003', 'wejncuencubewiocbiew', 'foto_6856c62201b0b3.04886197.jpg', 'cv_LaurentiusStephen_1177601.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pencapaian_karyawan`
--

CREATE TABLE `pencapaian_karyawan` (
  `id_pencapaian` varchar(25) NOT NULL,
  `nama_pencapaian` varchar(100) NOT NULL,
  `id_karyawan` varchar(150) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status_pencapaian` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pencapaian_karyawan`
--

INSERT INTO `pencapaian_karyawan` (`id_pencapaian`, `nama_pencapaian`, `id_karyawan`, `tanggal_mulai`, `tanggal_selesai`, `status_pencapaian`) VALUES
('GOAL-MLT-001', 'Mengikuti Leadership Training', 'T-003', '2025-06-26', '2025-06-30', 'Selesai (100%)'),
('GOAL-MMW-002', 'Mengikuti Management Workshop', 'CO-003', '2025-06-26', '2025-07-02', 'Separuh Jalan (50%)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian_karyawan`
--

CREATE TABLE `penilaian_karyawan` (
  `id_penilaian` varchar(25) NOT NULL,
  `id_karyawan` varchar(150) NOT NULL,
  `id_penilai` varchar(150) NOT NULL,
  `tanggal_penilaian` date NOT NULL,
  `id_akhir` varchar(100) NOT NULL,
  `status_penilaian` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penilaian_karyawan`
--

INSERT INTO `penilaian_karyawan` (`id_penilaian`, `id_karyawan`, `id_penilai`, `tanggal_penilaian`, `id_akhir`, `status_penilaian`) VALUES
('CO/KA/001', 'CO-003', 'ME-002', '2025-06-27', 'NA-006', 'Selesai'),
('ME/CO/002', 'ME-002', 'CO-003', '2025-06-26', 'NA-005', 'Selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil_karyawan`
--

CREATE TABLE `profil_karyawan` (
  `id_karyawan` varchar(25) NOT NULL,
  `nama_karyawan` varchar(150) NOT NULL,
  `id_pekerjaan` varchar(150) NOT NULL,
  `telepon_kerja` varchar(20) NOT NULL,
  `email` varchar(80) NOT NULL,
  `id_atasan` varchar(150) NOT NULL,
  `foto_karyawan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `profil_karyawan`
--

INSERT INTO `profil_karyawan` (`id_karyawan`, `nama_karyawan`, `id_pekerjaan`, `telepon_kerja`, `email`, `id_atasan`, `foto_karyawan`) VALUES
('CO-003', 'Christian Octavianus Wieharja', 'JOB/HJWT/000', '087724362455', 'christianoctavianus72@gmail.com', 'H-004', 'foto_685aa3a15ba24.jpg'),
('H-004', 'Handoko', 'JOB/HJWT/000', '76785453535', 'handoko-hr@gmail.com', 'H-004', 'foto_685a939022e3b.jpg'),
('KA-004', 'Kevin Alfa Setiawan', 'JOB/SOO/002', '08522347211', 'kevin-alfa-setiawan-OS@gmail.com', 'CO-003', 'foto_685218f45b1810.03562721.jpg'),
('ME-002', 'Michael Eka', 'JOB/JSA/000', '9127809126438216', 'michaeleka25@gmail.com', 'KA-004', 'foto_685057581b9db9.75200976.jpg'),
('T-003', 'Taufiqurrahman', 'JOB/HJWT/000', '085523452120', 'taufiq-hr@gmail.com', 'KA-004', 'foto_68521750daaa75.91748257.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening_karyawan`
--

CREATE TABLE `rekening_karyawan` (
  `id_rekening` varchar(25) NOT NULL,
  `id_karyawan` varchar(150) NOT NULL,
  `nama_bank` varchar(10) NOT NULL,
  `nomor_rekening` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rekening_karyawan`
--

INSERT INTO `rekening_karyawan` (`id_rekening`, `id_karyawan`, `nama_bank`, `nomor_rekening`) VALUES
('REK-001', 'CO-003', 'BCA', '1241241255235'),
('REK-002', 'KA-004', 'Mandiri', '45643675643000'),
('REK-003', 'ME-002', 'BNI', '35454632123444'),
('REK-004', 'T-003', 'BRI', '21412454531');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slip_gaji`
--

CREATE TABLE `slip_gaji` (
  `id_slip_gaji` varchar(25) NOT NULL,
  `id_karyawan` varchar(150) NOT NULL,
  `jumlah_gaji` int(20) NOT NULL,
  `metode_bayar` varchar(10) NOT NULL,
  `status_pembayaran` varchar(25) NOT NULL,
  `tanggal_cetak` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `slip_gaji`
--

INSERT INTO `slip_gaji` (`id_slip_gaji`, `id_karyawan`, `jumlah_gaji`, `metode_bayar`, `status_pembayaran`, `tanggal_cetak`) VALUES
('SLIP/001', 'CO-003', 5000000, 'Transfer', 'Lunas', '2025-06-19'),
('SLIP/002', 'T-003', 750000, 'Tunai', 'Lunas', '2025-06-19'),
('SLIP/003', 'ME-002', 10000000, 'Transfer', 'Diproses', '2025-06-19'),
('SLIP/004', 'T-003', 900000, 'Transfer', 'Lunas', '2025-06-24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `spesifikasi_kerja`
--

CREATE TABLE `spesifikasi_kerja` (
  `id_spesifikasi_kerja` varchar(25) NOT NULL,
  `id_divisi` varchar(150) NOT NULL,
  `nama_spesifikasi` varchar(100) NOT NULL,
  `id_supervisor` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `spesifikasi_kerja`
--

INSERT INTO `spesifikasi_kerja` (`id_spesifikasi_kerja`, `id_divisi`, `nama_spesifikasi`, `id_supervisor`) VALUES
('SP-HWT-002', 'DIV-HT-004', 'HR Waitress Training', 'KA-004'),
('SP-SA-002', 'DIV-S-002', 'SEO Auditor', 'H-004'),
('SP-SS-001', 'DIV-S-002', 'SEO Specialist', 'ME-002'),
('SP-UA-002', 'DIV-HT-001', 'UX Analytics', 'H-004');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_lamaran`
--

CREATE TABLE `status_lamaran` (
  `id_status_lamaran` varchar(25) NOT NULL,
  `nama_status_lamaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `status_lamaran`
--

INSERT INTO `status_lamaran` (`id_status_lamaran`, `nama_status_lamaran`) VALUES
('SL-001', 'Baru'),
('SL-002', 'Screening Curriculum Vitae'),
('SL-003', 'Seleksi Pertama'),
('SL-004', 'Interview 1'),
('SL-005', 'Seleksi Interview 1'),
('SL-006', 'Interview 2'),
('SL-007', 'Seleksi Interview 2'),
('SL-008', 'Training'),
('SL-009', 'Seleksi Training'),
('SL-010', 'Tanda Tangan Kontrak'),
('SL-011', 'Diterima'),
('SL-012', 'Ditolak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `struktur_gaji`
--

CREATE TABLE `struktur_gaji` (
  `id_struktur_gaji` varchar(25) NOT NULL,
  `nama_struktur` varchar(100) NOT NULL,
  `jam_kerja` varchar(5) NOT NULL,
  `jumlah_gaji` int(20) NOT NULL,
  `interval_gaji` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `struktur_gaji`
--

INSERT INTO `struktur_gaji` (`id_struktur_gaji`, `nama_struktur`, `jam_kerja`, `jumlah_gaji`, `interval_gaji`) VALUES
('SG-I-003', 'Internships', '15', 15000, 'Jam'),
('SG-SF-001', 'Struktur Full-Time 1', '35', 5000000, 'Bulan'),
('SG-SF2-003', 'Struktur Full-Time 2', '40', 500000, 'Minggu'),
('SG-SP-002', 'Struktur Part-Time', '20', 2000000, 'Bulan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun_pengguna`
--
ALTER TABLE `akun_pengguna`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indeks untuk tabel `bidang_kemampuan`
--
ALTER TABLE `bidang_kemampuan`
  ADD PRIMARY KEY (`id_bidang_kemampuan`);

--
-- Indeks untuk tabel `data_pribadi`
--
ALTER TABLE `data_pribadi`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indeks untuk tabel `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id_departemen`),
  ADD KEY `fk_nama_direktur` (`id_direktur`);

--
-- Indeks untuk tabel `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`),
  ADD KEY `fk_nama_departemen` (`id_departemen`),
  ADD KEY `fk_nama_manager` (`id_manager`);

--
-- Indeks untuk tabel `kemampuan`
--
ALTER TABLE `kemampuan`
  ADD PRIMARY KEY (`id_kemampuan`),
  ADD KEY `fk_bidang_kemampuan` (`id_bidang_kemampuan`);

--
-- Indeks untuk tabel `kemampuan_karyawan`
--
ALTER TABLE `kemampuan_karyawan`
  ADD PRIMARY KEY (`id_karyawan`,`id_jenis_kemampuan`),
  ADD KEY `fk_karyawan` (`id_karyawan`),
  ADD KEY `fk_jenis_kemampuan` (`id_jenis_kemampuan`),
  ADD KEY `id_karyawan` (`id_karyawan`) USING BTREE;

--
-- Indeks untuk tabel `kemampuan_kerja`
--
ALTER TABLE `kemampuan_kerja`
  ADD PRIMARY KEY (`id_pekerjaan`,`id_jenis_kemampuan`),
  ADD KEY `id_jenis_kemampuan` (`id_jenis_kemampuan`);

--
-- Indeks untuk tabel `kontrak_kerja`
--
ALTER TABLE `kontrak_kerja`
  ADD PRIMARY KEY (`id_kontrak`),
  ADD KEY `fk_nama_karyawan` (`id_karyawan`),
  ADD KEY `fk_penanggung_jawab` (`id_penanggung_jawab`),
  ADD KEY `fk_struktur_gaji` (`id_struktur_gaji`);

--
-- Indeks untuk tabel `lowongan`
--
ALTER TABLE `lowongan`
  ADD PRIMARY KEY (`id_lowongan`),
  ADD KEY `fk_pekerjaan` (`id_pekerjaan`);

--
-- Indeks untuk tabel `nilai_akhir`
--
ALTER TABLE `nilai_akhir`
  ADD PRIMARY KEY (`id_nilai_akhir`);

--
-- Indeks untuk tabel `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`id_pekerjaan`),
  ADD KEY `fk_penanggung_jawab` (`id_penanggung_jawab`),
  ADD KEY `fk_spesifikasi_kerja` (`id_spesifikasi_kerja`);

--
-- Indeks untuk tabel `pelamar`
--
ALTER TABLE `pelamar`
  ADD PRIMARY KEY (`id_pelamar`),
  ADD KEY `fk_rekruiter` (`id_rekruiter`),
  ADD KEY `fk_status_lamaran` (`id_status_lamaran`),
  ADD KEY `fk_interviewer` (`id_interviewer`),
  ADD KEY `fk ke lowongan` (`id_lowongan`) USING BTREE;

--
-- Indeks untuk tabel `pencapaian_karyawan`
--
ALTER TABLE `pencapaian_karyawan`
  ADD PRIMARY KEY (`id_pencapaian`),
  ADD KEY `fk_nama_karyawan` (`id_karyawan`);

--
-- Indeks untuk tabel `penilaian_karyawan`
--
ALTER TABLE `penilaian_karyawan`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `fk_nama_karyawan` (`id_karyawan`),
  ADD KEY `fk_nama_penilai` (`id_penilai`),
  ADD KEY `fk_nilai_akhir` (`id_akhir`);

--
-- Indeks untuk tabel `profil_karyawan`
--
ALTER TABLE `profil_karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `fk_pekerjaan` (`id_pekerjaan`),
  ADD KEY `fk_atasan` (`id_atasan`);

--
-- Indeks untuk tabel `rekening_karyawan`
--
ALTER TABLE `rekening_karyawan`
  ADD PRIMARY KEY (`id_rekening`),
  ADD KEY `fk_pekerja` (`id_karyawan`);

--
-- Indeks untuk tabel `slip_gaji`
--
ALTER TABLE `slip_gaji`
  ADD PRIMARY KEY (`id_slip_gaji`),
  ADD KEY `fk_karyawan` (`id_karyawan`);

--
-- Indeks untuk tabel `spesifikasi_kerja`
--
ALTER TABLE `spesifikasi_kerja`
  ADD PRIMARY KEY (`id_spesifikasi_kerja`),
  ADD KEY `fk_divisi` (`id_divisi`),
  ADD KEY `fk_nama_supervisor` (`id_supervisor`);

--
-- Indeks untuk tabel `status_lamaran`
--
ALTER TABLE `status_lamaran`
  ADD PRIMARY KEY (`id_status_lamaran`);

--
-- Indeks untuk tabel `struktur_gaji`
--
ALTER TABLE `struktur_gaji`
  ADD PRIMARY KEY (`id_struktur_gaji`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `akun_pengguna`
--
ALTER TABLE `akun_pengguna`
  ADD CONSTRAINT `akun_pengguna_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `profil_karyawan` (`id_karyawan`);

--
-- Ketidakleluasaan untuk tabel `departemen`
--
ALTER TABLE `departemen`
  ADD CONSTRAINT `departemen_ibfk_1` FOREIGN KEY (`id_direktur`) REFERENCES `profil_karyawan` (`id_karyawan`);

--
-- Ketidakleluasaan untuk tabel `divisi`
--
ALTER TABLE `divisi`
  ADD CONSTRAINT `divisi_ibfk_1` FOREIGN KEY (`id_departemen`) REFERENCES `departemen` (`id_departemen`),
  ADD CONSTRAINT `divisi_ibfk_2` FOREIGN KEY (`id_manager`) REFERENCES `profil_karyawan` (`id_karyawan`);

--
-- Ketidakleluasaan untuk tabel `kemampuan`
--
ALTER TABLE `kemampuan`
  ADD CONSTRAINT `kemampuan_ibfk_1` FOREIGN KEY (`id_bidang_kemampuan`) REFERENCES `bidang_kemampuan` (`id_bidang_kemampuan`);

--
-- Ketidakleluasaan untuk tabel `kemampuan_karyawan`
--
ALTER TABLE `kemampuan_karyawan`
  ADD CONSTRAINT `kemampuan_karyawan_ibfk_2` FOREIGN KEY (`id_jenis_kemampuan`) REFERENCES `kemampuan` (`id_kemampuan`);

--
-- Ketidakleluasaan untuk tabel `kemampuan_kerja`
--
ALTER TABLE `kemampuan_kerja`
  ADD CONSTRAINT `kemampuan_kerja_ibfk_1` FOREIGN KEY (`id_jenis_kemampuan`) REFERENCES `kemampuan` (`id_kemampuan`);

--
-- Ketidakleluasaan untuk tabel `kontrak_kerja`
--
ALTER TABLE `kontrak_kerja`
  ADD CONSTRAINT `kontrak_kerja_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `profil_karyawan` (`id_karyawan`),
  ADD CONSTRAINT `kontrak_kerja_ibfk_2` FOREIGN KEY (`id_penanggung_jawab`) REFERENCES `profil_karyawan` (`id_karyawan`),
  ADD CONSTRAINT `kontrak_kerja_ibfk_3` FOREIGN KEY (`id_struktur_gaji`) REFERENCES `struktur_gaji` (`id_struktur_gaji`);

--
-- Ketidakleluasaan untuk tabel `lowongan`
--
ALTER TABLE `lowongan`
  ADD CONSTRAINT `lowongan_ibfk_1` FOREIGN KEY (`id_pekerjaan`) REFERENCES `pekerjaan` (`id_pekerjaan`);

--
-- Ketidakleluasaan untuk tabel `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD CONSTRAINT `pekerjaan_ibfk_1` FOREIGN KEY (`id_penanggung_jawab`) REFERENCES `profil_karyawan` (`id_karyawan`),
  ADD CONSTRAINT `pekerjaan_ibfk_2` FOREIGN KEY (`id_spesifikasi_kerja`) REFERENCES `spesifikasi_kerja` (`id_spesifikasi_kerja`);

--
-- Ketidakleluasaan untuk tabel `pelamar`
--
ALTER TABLE `pelamar`
  ADD CONSTRAINT `pelamar_ibfk_1` FOREIGN KEY (`id_lowongan`) REFERENCES `lowongan` (`id_lowongan`),
  ADD CONSTRAINT `pelamar_ibfk_2` FOREIGN KEY (`id_rekruiter`) REFERENCES `profil_karyawan` (`id_karyawan`),
  ADD CONSTRAINT `pelamar_ibfk_3` FOREIGN KEY (`id_status_lamaran`) REFERENCES `status_lamaran` (`id_status_lamaran`),
  ADD CONSTRAINT `pelamar_ibfk_4` FOREIGN KEY (`id_interviewer`) REFERENCES `profil_karyawan` (`id_karyawan`);

--
-- Ketidakleluasaan untuk tabel `pencapaian_karyawan`
--
ALTER TABLE `pencapaian_karyawan`
  ADD CONSTRAINT `pencapaian_karyawan_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `profil_karyawan` (`id_karyawan`);

--
-- Ketidakleluasaan untuk tabel `penilaian_karyawan`
--
ALTER TABLE `penilaian_karyawan`
  ADD CONSTRAINT `penilaian_karyawan_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `profil_karyawan` (`id_karyawan`),
  ADD CONSTRAINT `penilaian_karyawan_ibfk_2` FOREIGN KEY (`id_penilai`) REFERENCES `profil_karyawan` (`id_karyawan`),
  ADD CONSTRAINT `penilaian_karyawan_ibfk_3` FOREIGN KEY (`id_akhir`) REFERENCES `nilai_akhir` (`id_nilai_akhir`);

--
-- Ketidakleluasaan untuk tabel `profil_karyawan`
--
ALTER TABLE `profil_karyawan`
  ADD CONSTRAINT `profil_karyawan_ibfk_1` FOREIGN KEY (`id_atasan`) REFERENCES `profil_karyawan` (`id_karyawan`),
  ADD CONSTRAINT `profil_karyawan_ibfk_2` FOREIGN KEY (`id_pekerjaan`) REFERENCES `pekerjaan` (`id_pekerjaan`);

--
-- Ketidakleluasaan untuk tabel `rekening_karyawan`
--
ALTER TABLE `rekening_karyawan`
  ADD CONSTRAINT `rekening_karyawan_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `profil_karyawan` (`id_karyawan`);

--
-- Ketidakleluasaan untuk tabel `slip_gaji`
--
ALTER TABLE `slip_gaji`
  ADD CONSTRAINT `slip_gaji_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `profil_karyawan` (`id_karyawan`);

--
-- Ketidakleluasaan untuk tabel `spesifikasi_kerja`
--
ALTER TABLE `spesifikasi_kerja`
  ADD CONSTRAINT `spesifikasi_kerja_ibfk_1` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`),
  ADD CONSTRAINT `spesifikasi_kerja_ibfk_2` FOREIGN KEY (`id_supervisor`) REFERENCES `profil_karyawan` (`id_karyawan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
