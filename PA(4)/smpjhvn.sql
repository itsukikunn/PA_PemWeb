-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 04, 2024 at 12:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smpjhvn`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `nama_buku` varchar(255) NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `kategori_buku` varchar(255) NOT NULL,
  `stok_buku` int(11) NOT NULL,
  `harga_buku` decimal(10,2) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `nama_buku`, `penulis`, `deskripsi`, `kategori_buku`, `stok_buku`, `harga_buku`, `gambar`) VALUES
(1, 'Laut Bercerita', 'Leila S. Chudori', 'Buku ini terdiri atas dua bagian. Bagian pertama mengambil sudut pandang seorang mahasiswa aktivis bernama Laut, menceritakan bagaimana Laut dan kawan-kawannya menyusun rencana, berpindah-pindah dalam pelarian, hingga tertangkap oleh pasukan rahasia. Sedangkan bagian kedua dikisahkan oleh Asmara, adik Laut. Bagian kedua mewakili perasaan keluarga korban penghilangan paksa, bagaimana pencarian mereka terhadap kerabat mereka yang tak pernah kembali.', 'Fiksi', 20, 92000.00, 'laut_bercerita.avif'),
(2, 'The Maxwel Daily reader', 'John C. Maxwell', 'Apa kunci menuju keberhasilan? Apa yang membedakan antara orang dengan banyak pencapaian dan orang dengan pencapaian ala kadarnya saja? Apa yang mereka kerjakan setiap hari? Rahasianya ada di dalam buku ini.\r\nThe Maxwell Daily Reader dirancang untuk membantu Anda meningkatkan diri setiap hari sepanjang tahun. Setiap halamannya memuat ringkasan dari salah satu buku Maxwell untuk menyemangati, mengajar, menantang, atau membantu Anda bertumbuh. Anda tidak akan dapat bertumbuh jika tidak mau berubah. Dan Anda tidak akan berubah, kecuali mengubah sesuatu dari apa yang Anda lakukan setiap hari. Buku ini akan mengajarkan Anda untuk memimpin, bukan hanya untuk diri sendiri, melainkan juga untuk orang-orang yang mengikuti Anda.', 'Nonfiksi', 20, 86.25, 'themaxwell.avif'),
(3, 'Sains Seru Untuk Anak 3 Aku Ilmuwan Cilik', 'Firly Savitri', 'Setiap anak kalau besar nanti ingin memilih profesi yang mereka minati walau profesi itu tidak mereka kenal. Dari buku ini anak-anak bisa memahami tugas dan apa yang akan dilakukan oleh profesi yang mereka pilih.', 'Anak-anak', 0, 76000.00, 'sainsseru.avif'),
(4, 'Laut Bercerita', 'Leila S. Chudori', 'Buku ini terdiri atas dua bagian. Bagian pertama mengambil sudut pandang seorang mahasiswa aktivis bernama Laut, menceritakan bagaimana Laut dan kawan-kawannya menyusun rencana, berpindah-pindah dalam pelarian, hingga tertangkap oleh pasukan rahasia. Sedangkan bagian kedua dikisahkan oleh Asmara, adik Laut. Bagian kedua mewakili perasaan keluarga korban penghilangan paksa, bagaimana pencarian mereka terhadap kerabat mereka yang tak pernah kembali.', 'Fiksi', 20, 92000.00, 'laut_bercerita.avif'),
(5, 'The Maxwel Daily reader', 'John C. Maxwell', 'Apa kunci menuju keberhasilan? Apa yang membedakan antara orang dengan banyak pencapaian dan orang dengan pencapaian ala kadarnya saja? Apa yang mereka kerjakan setiap hari? Rahasianya ada di dalam buku ini.\r\nThe Maxwell Daily Reader dirancang untuk membantu Anda meningkatkan diri setiap hari sepanjang tahun. Setiap halamannya memuat ringkasan dari salah satu buku Maxwell untuk menyemangati, mengajar, menantang, atau membantu Anda bertumbuh. Anda tidak akan dapat bertumbuh jika tidak mau berubah. Dan Anda tidak akan berubah, kecuali mengubah sesuatu dari apa yang Anda lakukan setiap hari. Buku ini akan mengajarkan Anda untuk memimpin, bukan hanya untuk diri sendiri, melainkan juga untuk orang-orang yang mengikuti Anda.', 'Nonfiksi', 20, 86.25, 'themaxwell.avif'),
(6, 'Sains Seru Untuk Anak 3 Aku Ilmuwan Cilik', 'Firly Savitri', 'Setiap anak kalau besar nanti ingin memilih profesi yang mereka minati walau profesi itu tidak mereka kenal. Dari buku ini anak-anak bisa memahami tugas dan apa yang akan dilakukan oleh profesi yang mereka pilih.', 'Anak-anak', 0, 76000.00, 'sainsseru.avif'),
(7, 'Laut Bercerita', 'Leila S. Chudori', 'Buku ini terdiri atas dua bagian. Bagian pertama mengambil sudut pandang seorang mahasiswa aktivis bernama Laut, menceritakan bagaimana Laut dan kawan-kawannya menyusun rencana, berpindah-pindah dalam pelarian, hingga tertangkap oleh pasukan rahasia. Sedangkan bagian kedua dikisahkan oleh Asmara, adik Laut. Bagian kedua mewakili perasaan keluarga korban penghilangan paksa, bagaimana pencarian mereka terhadap kerabat mereka yang tak pernah kembali.', 'Fiksi', 20, 92000.00, 'laut_bercerita.avif');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `jumlah_transaksi` int(11) NOT NULL,
  `status_transaksi` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `FK_id_user` int(11) NOT NULL,
  `FK_id_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `jumlah_transaksi`, `status_transaksi`, `tanggal`, `FK_id_user`, `FK_id_buku`) VALUES
(35, 1, 2, '2024-11-02', 1, 1),
(39, 1, 2, '2024-11-02', 1, 7),
(40, 3, 2, '2024-11-02', 1, 1),
(41, 4, 0, NULL, 2, 1),
(42, 2, 2, '2024-11-02', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `username`, `password`) VALUES
(1, 'user@gmail.com', 'injil', 'injil123'),
(2, 'test@gmal.com', 'user', '$2y$10$wXUSWIu18I6sKrap4e6dPu1c6pIBCWv7nKs4TI4s.DGXQwSm8hlsO'),
(4, 'ikkarepowan@gmail.com', 'test', '$2y$10$2I8Ef4cm7Z4xAeswYD3Uteh3C5JeDp00Q5kx0MZirgIOZS66e/CgC'),
(5, 'test@gmail.com', 'a', '$2y$10$ZYPEyM38PsGCzOPlMSvVC.3/C8UZ21ZKX.XMr2hiojfojtKF2dfTO'),
(6, 'akun3@gmail.com', 'akun3', '$2y$10$rWCFs3.QVxmCYt.V5t23COTwz7VBP7dKR384G5kKjwRgNXf0g1G6W'),
(7, 'akun4@gmail.com', 'akun4', '$2y$10$wn.wJ3cQPN4OWQDfMMNoIuEOEeN5LLbGJ0woqZg/I53xDcZapkL6y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `FK_id_user` (`FK_id_user`),
  ADD KEY `FK_id_buku` (`FK_id_buku`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `FK_id_buku` FOREIGN KEY (`FK_id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `FK_id_user` FOREIGN KEY (`FK_id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
