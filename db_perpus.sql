-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.4.25-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.5.0.6684
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- membuang struktur untuk table db_perpus.tbl_buku
CREATE TABLE IF NOT EXISTS `tbl_buku` (
  `IdBuku` int(11) NOT NULL AUTO_INCREMENT,
  `IdKategori` int(11) DEFAULT NULL,
  `tipe_buku` enum('E-BOOK','BUKU') NOT NULL,
  `judul_buku` varchar(60) NOT NULL,
  `pengarang_buku` varchar(60) NOT NULL,
  `tahun_buku` int(5) NOT NULL,
  `ebook_buku` varchar(50) DEFAULT NULL,
  `daftarisi_buku` text NOT NULL,
  `status_buku` enum('Y','N') NOT NULL,
  `jmlh_buku` int(11) NOT NULL DEFAULT 0,
  `harga_denda` int(11) NOT NULL,
  `RegDate` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`IdBuku`),
  KEY `FK_tbl_buku_tbl_kategori` (`IdKategori`),
  CONSTRAINT `FK_tbl_buku_tbl_kategori` FOREIGN KEY (`IdKategori`) REFERENCES `tbl_kategori` (`IdKategori`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel db_perpus.tbl_buku: ~4 rows (lebih kurang)
REPLACE INTO `tbl_buku` (`IdBuku`, `IdKategori`, `tipe_buku`, `judul_buku`, `pengarang_buku`, `tahun_buku`, `ebook_buku`, `daftarisi_buku`, `status_buku`, `jmlh_buku`, `harga_denda`, `RegDate`) VALUES
	(2, 3, 'E-BOOK', 'MQ Sensor Lib 2.0', 'Lals', 2022, 'ebook-29122022-1620070489.pdf', '<p>DAFTAR ISI Halaman KATA PENGANTAR……………………………………………………..i</p><p>DAFTAR ISI………………………………………………………………</p>', 'Y', 1, 0, '2023-01-03 19:53:23'),
	(6, 4, 'BUKU', 'Tes Materi 3', 'Lals', 2011, '-', '<p>DAFTAR ISI Halaman KATA PENGANTAR……………………………………………………..i</p><p>DAFTAR ISI………………………………………………………………</p>', 'Y', 3, 4000, '2023-01-04 19:52:59'),
	(7, 6, 'BUKU', 'Tes Materi 4', 'Johanes', 2014, '-', '<p><strong>asda asd asd asd asda dasd asd</strong></p>', 'Y', 3, 2500, '2022-12-07 19:53:47'),
	(8, 6, 'BUKU', '20 Kata Bahasa Melayu Manado', 'Lals', 2012, '-', '<p><strong>CONTOH DAFTAR ISI</strong></p><p><strong>BAB I</strong> ............................................................................................................................10</p><p><strong>BAB II</strong> ...........................................................................................................................12</p>', 'Y', 10, 1250, '2023-01-09 21:28:08'),
	(9, 4, 'BUKU', 'Buku Testing', 'Testing', 2001, '-', '<p><strong>DAFTAR ISI</strong></p><p><strong>BAB 1 ......................................................................10</strong></p><p><strong>BAB 2 ......................................................................11</strong></p>', 'Y', 5, 2500, '2023-01-13 19:33:44');

-- membuang struktur untuk table db_perpus.tbl_kategori
CREATE TABLE IF NOT EXISTS `tbl_kategori` (
  `IdKategori` int(11) NOT NULL AUTO_INCREMENT,
  `NamaKategori` varchar(50) DEFAULT NULL,
  `Ket_Kategori` text DEFAULT NULL,
  `RegDate` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`IdKategori`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel db_perpus.tbl_kategori: ~6 rows (lebih kurang)
REPLACE INTO `tbl_kategori` (`IdKategori`, `NamaKategori`, `Ket_Kategori`, `RegDate`) VALUES
	(3, 'Sains dan Matematika', 'Sains dan Matematika', '2022-12-22 22:35:33'),
	(4, 'Sosial', '-', '2022-12-22 22:35:45'),
	(5, 'Agama', '-', '2022-12-22 22:35:52'),
	(6, 'Bahasa', '-', '2022-12-22 22:35:59'),
	(7, 'Seni dan Rekreasi', '-', '2022-12-22 22:36:07'),
	(8, 'Sejarah dan Geografi', 'Sejarah dan Geografi', '2022-12-22 22:36:15');

-- membuang struktur untuk table db_perpus.tbl_login
CREATE TABLE IF NOT EXISTS `tbl_login` (
  `IdLogin` int(11) NOT NULL AUTO_INCREMENT,
  `IdUser` int(11) NOT NULL DEFAULT 0,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Role` set('admin','siswa') NOT NULL,
  `LastLogin` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `StatusLogin` enum('ON','OFF') NOT NULL DEFAULT 'OFF',
  `FlagAktif` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`IdLogin`),
  KEY `FK_tbl_login_tbl_users` (`IdUser`),
  CONSTRAINT `FK_tbl_login_tbl_users` FOREIGN KEY (`IdUser`) REFERENCES `tbl_users` (`IdUser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel db_perpus.tbl_login: ~1 rows (lebih kurang)
REPLACE INTO `tbl_login` (`IdLogin`, `IdUser`, `username`, `password`, `Role`, `LastLogin`, `StatusLogin`, `FlagAktif`) VALUES
	(4, 508921, 'admin@admin.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2023-02-26 08:09:41', 'OFF', 'Y');

-- membuang struktur untuk table db_perpus.tbl_pinjam
CREATE TABLE IF NOT EXISTS `tbl_pinjam` (
  `id_pinjam` int(10) NOT NULL AUTO_INCREMENT,
  `IdUser` int(13) NOT NULL,
  `IdBuku` int(20) NOT NULL,
  `waktupinjam_pin` date NOT NULL,
  `waktukembali_pin` date DEFAULT NULL,
  `keterangan_pin` text DEFAULT NULL,
  `status_pin` enum('Y','N') NOT NULL DEFAULT 'N',
  `status_kembali` enum('Y','N') NOT NULL DEFAULT 'N',
  `tgl_kembali` datetime NOT NULL,
  `RegDate` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_pinjam`),
  KEY `FK_tbl_pinjam_tbl_users` (`IdUser`),
  KEY `FK_tbl_pinjam_tbl_buku` (`IdBuku`),
  CONSTRAINT `FK_tbl_pinjam_tbl_buku` FOREIGN KEY (`IdBuku`) REFERENCES `tbl_buku` (`IdBuku`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_pinjam_tbl_users` FOREIGN KEY (`IdUser`) REFERENCES `tbl_users` (`IdUser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel db_perpus.tbl_pinjam: ~0 rows (lebih kurang)

-- membuang struktur untuk table db_perpus.tbl_rekom
CREATE TABLE IF NOT EXISTS `tbl_rekom` (
  `IdKategori` int(11) DEFAULT NULL,
  `IdUser` int(11) DEFAULT NULL,
  KEY `FK_tbl_rekom_tbl_kategori` (`IdKategori`),
  KEY `FK_tbl_rekom_tbl_users` (`IdUser`),
  CONSTRAINT `FK_tbl_rekom_tbl_kategori` FOREIGN KEY (`IdKategori`) REFERENCES `tbl_kategori` (`IdKategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_rekom_tbl_users` FOREIGN KEY (`IdUser`) REFERENCES `tbl_users` (`IdUser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel db_perpus.tbl_rekom: ~0 rows (lebih kurang)

-- membuang struktur untuk table db_perpus.tbl_users
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `IdUser` int(11) NOT NULL AUTO_INCREMENT,
  `nis_nip` int(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `foto` text DEFAULT 'default.jpg',
  `tahunmasuk` year(4) NOT NULL,
  `flag_admin` enum('Y','N') NOT NULL DEFAULT 'N',
  `flag_acc` enum('Y','N') NOT NULL DEFAULT 'N',
  `id_telegram` varchar(50) NOT NULL,
  `regdate` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`IdUser`)
) ENGINE=InnoDB AUTO_INCREMENT=97013426 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel db_perpus.tbl_users: ~1 rows (lebih kurang)
REPLACE INTO `tbl_users` (`IdUser`, `nis_nip`, `nama`, `alamat`, `nohp`, `email`, `foto`, `tahunmasuk`, `flag_admin`, `flag_acc`, `id_telegram`, `regdate`) VALUES
	(508921, 9909090, 'admin1', 'Tondano', '0000', 'admin@admin.com', 'default.jpg', '2011', 'Y', 'Y', '1378945171', '2023-01-04 19:43:14');

-- membuang struktur untuk view db_perpus.tbv_buku
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `tbv_buku` (
	`IdBuku` INT(11) NOT NULL,
	`IdKategori` INT(11) NULL,
	`NamaKategori` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`Ket_Kategori` TEXT NULL COLLATE 'utf8mb4_general_ci',
	`tipe_buku` ENUM('E-BOOK','BUKU') NOT NULL COLLATE 'utf8mb4_general_ci',
	`judul_buku` VARCHAR(60) NOT NULL COLLATE 'utf8mb4_general_ci',
	`pengarang_buku` VARCHAR(60) NOT NULL COLLATE 'utf8mb4_general_ci',
	`tahun_buku` INT(5) NOT NULL,
	`ebook_buku` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`daftarisi_buku` TEXT NOT NULL COLLATE 'utf8mb4_general_ci',
	`status_buku` ENUM('Y','N') NOT NULL COLLATE 'utf8mb4_general_ci',
	`jmlh_buku` INT(11) NOT NULL,
	`harga_denda` INT(11) NOT NULL,
	`RegDate` DATETIME NOT NULL,
	`Flag_New` VARCHAR(1) NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- membuang struktur untuk view db_perpus.tbv_history
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `tbv_history` (
	`id_pinjam` INT(10) NOT NULL,
	`IdUser` INT(13) NOT NULL,
	`nis_nip` INT(20) NOT NULL,
	`nama` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
	`IdBuku` INT(20) NOT NULL,
	`judul_buku` VARCHAR(60) NOT NULL COLLATE 'utf8mb4_general_ci',
	`waktupinjam_pin` DATE NOT NULL,
	`waktukembali_pin` DATE NULL,
	`keterangan_pin` TEXT NULL COLLATE 'utf8mb4_general_ci',
	`harga_denda` INT(11) NOT NULL,
	`terlambat` INT(7) NULL,
	`denda_pinjam` BIGINT(17) NULL,
	`tgl_kembali` DATETIME NOT NULL,
	`status_kembali` ENUM('Y','N') NOT NULL COLLATE 'utf8mb4_general_ci',
	`status_pin` ENUM('Y','N') NOT NULL COLLATE 'utf8mb4_general_ci',
	`id_telegram` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
	`RegDate` DATETIME NOT NULL
) ENGINE=MyISAM;

-- membuang struktur untuk view db_perpus.tbv_login
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `tbv_login` (
	`IdLogin` INT(11) NOT NULL,
	`IdUser` INT(11) NOT NULL,
	`username` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
	`password` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_general_ci',
	`Role` SET('admin','siswa') NOT NULL COLLATE 'utf8mb4_general_ci',
	`LastLogin` DATETIME NOT NULL,
	`StatusLogin` ENUM('ON','OFF') NOT NULL COLLATE 'utf8mb4_general_ci',
	`FlagAktif` ENUM('Y','N') NOT NULL COLLATE 'utf8mb4_general_ci',
	`nis_nip` INT(20) NOT NULL,
	`nama` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
	`alamat` TEXT NOT NULL COLLATE 'utf8mb4_general_ci',
	`nohp` VARCHAR(15) NOT NULL COLLATE 'utf8mb4_general_ci',
	`email` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
	`foto` TEXT NULL COLLATE 'utf8mb4_general_ci',
	`tahunmasuk` YEAR NOT NULL,
	`flag_admin` ENUM('Y','N') NOT NULL COLLATE 'utf8mb4_general_ci',
	`flag_acc` ENUM('Y','N') NOT NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- membuang struktur untuk view db_perpus.tbv_rekom
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `tbv_rekom` (
	`IdKategori` INT(11) NOT NULL,
	`NamaKategori` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`IdUser` INT(11) NOT NULL,
	`nis_nip` INT(20) NOT NULL,
	`nama` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- membuang struktur untuk view db_perpus.tmp_lewat
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `tmp_lewat` (
	`id_pinjam` INT(10) NOT NULL,
	`LEWAT` INT(7) NULL
) ENGINE=MyISAM;

-- membuang struktur untuk event db_perpus.update_batal
DELIMITER //
CREATE EVENT `update_batal` ON SCHEDULE EVERY 1 DAY STARTS '2023-01-11 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
UPDATE tbl_pinjam SET status_kembali = "Y" WHERE id_pinjam IN (SELECT c.id_pinjam FROM tmp_lewat c WHERE c.LEWAT BETWEEN 1 AND 3);
END//
DELIMITER ;

-- membuang struktur untuk trigger db_perpus.tbl_pinjam_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `tbl_pinjam_after_insert` AFTER INSERT ON `tbl_pinjam` FOR EACH ROW BEGIN
DECLARE total_buku INT;
SET total_buku = (SELECT jmlh_buku FROM tbl_buku WHERE IdBuku = NEW.IdBuku);
IF total_buku >= 2 THEN
	UPDATE tbl_buku SET jmlh_buku = `total_buku` - 1 WHERE IdBuku = NEW.IdBuku;
ELSE
	UPDATE tbl_buku SET jmlh_buku = `total_buku` - 1,status_buku = "N" WHERE IdBuku = NEW.IdBuku;
END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger db_perpus.tbl_pinjam_after_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `tbl_pinjam_after_update` AFTER UPDATE ON `tbl_pinjam` FOR EACH ROW BEGIN
DECLARE kembali VARCHAR(50);
DECLARE total_buku INT;
SET kembali = (SELECT status_kembali FROM tbl_pinjam a WHERE a.id_pinjam = OLD.id_pinjam);

IF kembali = "Y" THEN
	SET total_buku = (SELECT jmlh_buku FROM tbl_buku WHERE IdBuku = NEW.IdBuku);
	UPDATE tbl_buku SET jmlh_buku = jmlh_buku + 1 WHERE IdBuku = NEW.IdBuku;
	IF total_buku = 0 THEN
		UPDATE tbl_buku SET status_buku = "Y" WHERE IdBuku = NEW.IdBuku;
	END IF;
END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk view db_perpus.tbv_buku
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `tbv_buku`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `tbv_buku` AS SELECT
a.IdBuku,
a.IdKategori,
b.NamaKategori,
b.Ket_Kategori,
a.tipe_buku,
a.judul_buku,
a.pengarang_buku,
a.tahun_buku,
a.ebook_buku,
a.daftarisi_buku,
a.status_buku,
a.jmlh_buku,
a.harga_denda,
a.RegDate,
IF(DATEDIFF(CURDATE(), DATE(a.RegDate)) <= 3,'Y','N') AS Flag_New
FROM tbl_buku a
INNER JOIN tbl_kategori b
ON a.IdKategori = b.IdKategori ;

-- membuang struktur untuk view db_perpus.tbv_history
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `tbv_history`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `tbv_history` AS SELECT
a.id_pinjam,
a.IdUser,
c.nis_nip,
c.nama,
a.IdBuku,
b.judul_buku,
a.waktupinjam_pin,
a.waktukembali_pin,
a.keterangan_pin,
b.harga_denda,
(
	CASE
		WHEN DATEDIFF(CURDATE(),a.waktukembali_pin) > 0 AND a.status_pin = "N" THEN 0
		WHEN DATEDIFF(CURDATE(),a.waktukembali_pin) > 0 AND a.status_pin = "Y" THEN DATEDIFF(a.tgl_kembali,a.waktukembali_pin)
	END
) AS terlambat,
-- IF(DATEDIFF(CURDATE(),a.waktukembali_pin) < 0 AND a.status_pin != "Y",0,DATEDIFF(CURDATE(),a.waktukembali_pin) * b.harga_denda) AS denda_pinjam,
(
	CASE
		WHEN DATEDIFF(CURDATE(),a.waktukembali_pin) < 0  THEN 0
		WHEN DATEDIFF(CURDATE(),a.waktukembali_pin) = 0  THEN 0
		WHEN DATEDIFF(CURDATE(),a.waktukembali_pin) > 0 AND  a.status_pin != "Y" THEN 0
		WHEN a.status_pin = "Y" AND a.status_kembali = "Y" AND DATE(a.tgl_kembali) != "0000-00-00" THEN (DATEDIFF(DATE(a.tgl_kembali),a.waktukembali_pin) * b.harga_denda)
		WHEN DATEDIFF(CURDATE(),a.waktukembali_pin) > 0 AND a.status_kembali != "Y" THEN DATEDIFF(CURDATE(),a.waktukembali_pin) * b.harga_denda
	END
) AS denda_pinjam,
a.tgl_kembali,
a.status_kembali,
a.status_pin,
c.id_telegram,
a.RegDate
FROM tbl_pinjam a
INNER JOIN tbl_buku b
ON a.IdBuku = b.IdBuku
INNER JOIN tbl_users c
ON a.IdUser = c.IdUser ;

-- membuang struktur untuk view db_perpus.tbv_login
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `tbv_login`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `tbv_login` AS SELECT 
a.IdLogin,
a.IdUser,
a.username,
a.`password`,
a.`Role`,
a.LastLogin,
a.StatusLogin,
a.FlagAktif,
b.nis_nip,
b.nama,
b.alamat,
b.nohp,
b.email,
b.foto,
b.tahunmasuk,
b.flag_admin,
b.flag_acc
FROM tbl_login a
INNER JOIN tbl_users b
ON a.IdUser = b.IdUser ;

-- membuang struktur untuk view db_perpus.tbv_rekom
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `tbv_rekom`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `tbv_rekom` AS SELECT 
b.IdKategori,
b.NamaKategori,
c.IdUser,
c.nis_nip,
c.nama
FROM tbl_rekom a
INNER JOIN tbl_kategori b
ON a.IdKategori = b.IdKategori
INNER JOIN tbl_users c
ON a.IdUser = c.IdUser ;

-- membuang struktur untuk view db_perpus.tmp_lewat
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `tmp_lewat`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `tmp_lewat` AS SELECT
id_pinjam,
DATEDIFF(CURDATE(),DATE(waktukembali_pin)) AS LEWAT
FROM 
tbl_pinjam
WHERE
status_pin = "N" ;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
