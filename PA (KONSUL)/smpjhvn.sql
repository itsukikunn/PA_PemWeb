-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Waktu pembuatan: 05 Nov 2024 pada 16.26
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
-- Database: `smpjhvn`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
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
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `nama_buku`, `penulis`, `deskripsi`, `kategori_buku`, `stok_buku`, `harga_buku`, `gambar`) VALUES
(1, 'Laut Bercerita', 'Leila S. Chudori', 'Buku ini terdiri atas dua bagian. Bagian pertama mengambil sudut pandang seorang mahasiswa aktivis bernama Laut, menceritakan bagaimana Laut dan kawan-kawannya menyusun rencana, berpindah-pindah dalam pelarian, hingga tertangkap oleh pasukan rahasia. Sedangkan bagian kedua dikisahkan oleh Asmara, adik Laut. Bagian kedua mewakili perasaan keluarga korban penghilangan paksa, bagaimana pencarian mereka terhadap kerabat mereka yang tak pernah kembali.(film adapted)', 'Fiksi', 20, 92000.00, 'laut_bercerita.avif'),
(2, 'The Maxwel Daily reader', 'John C. Maxwell', 'Apa kunci menuju keberhasilan? Apa yang membedakan antara orang dengan banyak pencapaian dan orang dengan pencapaian ala kadarnya saja? Apa yang mereka kerjakan setiap hari? Rahasianya ada di dalam buku ini.\r\nThe Maxwell Daily Reader dirancang untuk membantu Anda meningkatkan diri setiap hari sepanjang tahun. Setiap halamannya memuat ringkasan dari salah satu buku Maxwell untuk menyemangati, mengajar, menantang, atau membantu Anda bertumbuh. Anda tidak akan dapat bertumbuh jika tidak mau berubah. Dan Anda tidak akan berubah, kecuali mengubah sesuatu dari apa yang Anda lakukan setiap hari. Buku ini akan mengajarkan Anda untuk memimpin, bukan hanya untuk diri sendiri, melainkan juga untuk orang-orang yang mengikuti Anda.', 'Nonfiksi', 20, 149000.00, 'themaxwell.avif'),
(3, 'Sains Seru Untuk Anak 3 Aku Ilmuwan Cilik', 'Firly Savitri', 'Setiap anak kalau besar nanti ingin memilih profesi yang mereka minati walau profesi itu tidak mereka kenal. Dari buku ini anak-anak bisa memahami tugas dan apa yang akan dilakukan oleh profesi yang mereka pilih.', 'Anak-anak', 20, 76000.00, 'sainsseru.avif'),
(4, 'To Kill a Mockingbird', 'Harper Lee', 'Kisah ini berlatar di Alabama pada tahun 1930-an, mengikuti seorang gadis muda bernama Scout Finch dan ayahnya, Atticus, seorang pengacara yang membela pria Afrika-Amerika yang dituduh melakukan kejahatan. Buku ini menggambarkan ketidakadilan rasial, keberanian moral, dan ketulusan anak-anak dalam menghadapi isu-isu sosial.(film adapted)', 'Fiksi', 20, 120000.00, 'Mocking.jpg'),
(5, '1984', 'George Orwell', 'Berlatar di dunia distopia di mana pemerintah mengawasi dan mengontrol setiap aspek kehidupan, novel ini mengikuti Winston Smith, seorang pegawai rendah di Partai yang mulai mempertanyakan kebebasan dan kenyataan di dunia yang otoriter. \"1984\" mengeksplorasi tema kontrol, kebebasan, dan manipulasi pikiran oleh penguasa.(film adapted)', 'Fiksi', 20, 98000.00, '1984.jpg'),
(6, 'Pride and prejudice', 'Jane Austen', 'Novel klasik ini mengisahkan Elizabeth Bennet, seorang wanita muda yang cerdas dan penuh semangat, dalam hubungan yang penuh liku dengan Mr. Darcy, pria kaya dan sombong. Melalui persaingan dan cinta, cerita ini menggali tema kebanggaan, prasangka, dan bagaimana kesalahpahaman bisa menghalangi perasaan sejati.(film adapted)', 'Fiksi', 20, 134000.00, 'pride.jpg'),
(7, 'Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling', 'Buku pertama dari seri Harry Potter ini menceritakan petualangan seorang anak laki-laki bernama Harry, yang menemukan bahwa dia adalah seorang penyihir dan diterima di Sekolah Sihir Hogwarts. Dengan teman-temannya, ia menemukan kebenaran tentang keluarganya dan musuh kuat bernama Voldemort, memulai perjalanan magis yang penuh persahabatan dan keberanian.(film adapted)', 'Fiksi', 20, 150000.00, 'harry.jpg'),
(8, 'Go Set a Watchman', 'Harper Lee', 'Buku ini adalah sekuel dari To Kill a Mockingbird dan mengikuti kehidupan Scout Finch sebagai orang dewasa yang kembali ke kampung halamannya di Maycomb. Diceritakan dalam perspektif yang lebih dewasa, novel ini menggambarkan Scout yang harus menghadapi kenyataan tentang pandangan dunia ayahnya, Atticus, dalam konteks pergolakan sosial Amerika.', 'Nonfiksi', 20, 110000.00, 'watchman.jpg'),
(9, 'Homage to Catalonia', 'George Orwell', 'Memoar ini menceritakan pengalaman Orwell sebagai pejuang sukarelawan dalam Perang Saudara Spanyol. Dia mengisahkan peristiwa-peristiwa yang dialaminya di medan perang, termasuk konflik ideologis dan pengkhianatan. Buku ini menawarkan pandangan mendalam tentang komunisme, fasisme, dan bagaimana pengalaman Orwell mempengaruhi pandangannya terhadap totalitarianisme, seperti yang muncul dalam 1984.', 'Nonfiksi', 20, 167000.00, 'catalona.jpg'),
(10, 'The Power of Habit: Why We Do What We Do in Life and Business', 'Charles Duhigg', 'Buku ini mengeksplorasi ilmu di balik kebiasaan, menunjukkan bagaimana kebiasaan bekerja di otak kita, dan bagaimana kita bisa mengubah kebiasaan buruk menjadi baik. Melalui contoh nyata dari dunia bisnis, olahraga, dan kehidupan sehari-hari, Duhigg memberikan panduan yang membantu kita memahami kekuatan kebiasaan dalam mencapai tujuan hidup.', 'Nonfiksi', 20, 102000.00, 'habit.jpg'),
(11, 'Becoming', 'Michelle Obama', 'Memoar inspiratif ini menceritakan perjalanan hidup Michelle Obama, dari masa kecilnya hingga peran publiknya sebagai Ibu Negara AS. Dia berbagi tentang pengalaman pribadi dan tantangan yang dihadapinya dalam membangun karier, keluarga, serta menghadapi isu-isu sosial. Becoming menawarkan wawasan tentang identitas, kekuatan perempuan, dan perjuangan meraih impian.', 'Nonfiksi', 20, 98000.00, 'becoming.jpg\r\n'),
(12, 'Outliers: The Story of Success', 'Malcolm Gladwell', 'Buku ini mengeksplorasi faktor-faktor yang membentuk kesuksesan, dengan menyoroti peran lingkungan, kesempatan, dan kebiasaan dalam kehidupan individu-individu sukses. Gladwell meneliti kasus nyata untuk menjelaskan mengapa beberapa orang mencapai prestasi luar biasa, memberikan pembaca perspektif baru tentang apa yang dibutuhkan untuk berhasil.', 'Edukasi', 20, 117000.00, 'outliers.png'),
(13, 'The Art of Thinking Clearly', 'Rolf Dobelli', 'Buku ini membahas berbagai bias kognitif yang sering memengaruhi cara berpikir kita, dari overthinking hingga kesalahan logika. Dobelli menyajikan 99 konsep yang diringkas dalam bentuk esai pendek dan mudah dipahami, yang membantu kita membuat keputusan yang lebih rasional dan bijaksana dalam kehidupan sehari-hari.', 'Edukasi', 20, 134000.00, 'thinking.jpg'),
(14, 'Range: Why Generalists Triumph in a Specialized World', 'David Epstein', 'Epstein menunjukkan bahwa di era spesialisasi, individu yang memiliki beragam keahlian justru dapat unggul dan lebih siap menghadapi masalah kompleks. Dengan berbagai studi kasus dan contoh dari dunia sains, olahraga, dan pendidikan, Epstein memberikan wawasan tentang pentingnya memiliki wawasan luas dan keterampilan beragam dalam belajar dan bekerja.', 'Edukasi', 20, 78000.00, 'range.jpg'),
(15, 'Thinking, Fast and Slow', 'Daniel Kahneman', 'Ditulis oleh pemenang Nobel Ekonomi, buku ini menjelaskan dua sistem utama berpikir manusia: berpikir cepat dan intuitif versus berpikir lambat dan analitis. Kahneman mengungkapkan bagaimana kedua cara berpikir ini mempengaruhi keputusan kita dan bagaimana kita bisa menghindari kesalahan dengan lebih memahami proses kognitif kita.', 'Edukasi', 20, 121000.00, 'fast.jpg'),
(16, 'A Short History of Nearly Everything', 'Bill Bryson', 'Dengan gaya yang informatif dan humoris, Bryson menjelaskan konsep-konsep penting dalam ilmu pengetahuan, termasuk astronomi, biologi, geologi, dan fisika. Buku ini mengajak pembaca memahami dunia dan alam semesta melalui penemuan-penemuan terbesar dan cerita-cerita di baliknya. Cocok bagi pembaca yang ingin belajar tentang sains dalam cara yang menyenangkan dan mudah dipahami.', 'Edukasi', 20, 123000.00, 'history.jpg'),
(17, 'Atomic Habits', 'James Clear', 'Buku ini berfokus pada kekuatan perubahan kecil dalam membentuk kebiasaan positif jangka panjang. Clear menjelaskan bahwa perubahan besar sering kali sulit dijalankan, tetapi perubahan kecil yang dilakukan secara konsisten dapat menghasilkan dampak besar. Buku ini memberikan teknik untuk merancang lingkungan yang mendukung perubahan kebiasaan dan menyediakan tips praktis untuk menghilangkan kebiasaan buruk. Melalui konsep “1% per hari,” Clear menekankan pentingnya perbaikan kecil namun konsisten dalam mencapai kesuksesan.', 'Selfhelp', 20, 170000.00, 'bussiness.jpeg'),
(18, 'How to Win Friends and Influence People', 'Dale Carnegie', 'Buku klasik ini adalah panduan untuk memperbaiki keterampilan sosial, membangun hubungan yang kuat, dan menjadi pribadi yang disukai. Carnegie memberikan teknik komunikasi yang praktis untuk memperbaiki hubungan dengan orang lain, seperti mendengarkan lebih baik, menghindari kritik, dan menghargai perasaan orang lain. Dengan berbagai contoh, Carnegie menunjukkan cara berinteraksi dengan orang secara efektif dan memengaruhi mereka tanpa paksaan. Buku ini cocok untuk pengembangan diri di bidang profesional maupun pribadi.', 'Selfhelp', 20, 142000.00, 'win.jpeg'),
(19, 'The 7 Habits of Highly Effective People', 'Stephen R. Covey', 'Covey memperkenalkan tujuh kebiasaan yang dianggap penting untuk menjadi individu yang produktif dan efektif, mulai dari kebiasaan pribadi hingga kebiasaan kolaboratif. Buku ini membahas pentingnya proaktif, menentukan tujuan yang jelas, serta membangun sinergi dalam tim. Covey juga membahas prinsip pengembangan diri melalui “pembaharuan diri” (habit 7) yang mencakup aspek fisik, mental, emosional, dan spiritual. Buku ini berfokus pada perubahan dari dalam dan pendekatan prinsip hidup yang dapat diterapkan di berbagai situasi.', 'Selfhelp', 20, 131000.00, '7habit.jpg'),
(20, 'Man\'s Search for Meaning', 'Viktor Frankl', 'Berdasarkan pengalamannya di kamp konsentrasi Nazi, Frankl berbagi pandangan bahwa makna hidup dapat ditemukan bahkan di dalam penderitaan. Ia mendasari filosofi logoterapi—bahwa pencarian makna hidup adalah motivasi utama manusia. Buku ini menunjukkan bahwa meskipun tidak bisa mengendalikan situasi, kita masih bisa memilih sikap terhadapnya. Dengan refleksi psikologis yang mendalam, buku ini mengajak pembaca untuk menemukan tujuan hidup mereka, bahkan dalam kondisi yang sulit sekalipun. Karya ini telah menginspirasi banyak orang di seluruh dunia untuk mengatasi kesulitan hidup.', 'Selfhelp', 20, 125000.00, 'man.jpg'),
(21, 'The Power of Now: A Guide to Spiritual Enlightenment', 'Eckhart Tolle', 'Tolle menawarkan wawasan tentang pentingnya hidup di saat ini (the power of now) dan bagaimana pikiran kita yang terus-menerus memikirkan masa lalu atau masa depan menyebabkan stres dan kecemasan. Buku ini mengajarkan pembaca cara menghentikan kebiasaan pikiran negatif dan menemukan ketenangan dengan berfokus pada momen saat ini. Dengan pendekatan spiritual, buku ini membantu pembaca untuk melepaskan pikiran yang mengganggu dan menemukan kedamaian batin. Buku ini menjadi panduan bagi mereka yang ingin memahami lebih dalam tentang ketenangan spiritual dan kesejahteraan mental.', 'Selfhelp', 20, 132000.00, 'power.jpg'),
(22, 'Good to Great', 'Jim Collins', 'Collins melakukan penelitian selama lima tahun terhadap perusahaan yang sukses besar dan mengidentifikasi elemen-elemen kunci yang membuat perusahaan-perusahaan tersebut unggul di atas rata-rata. Buku ini memperkenalkan konsep “Hedgehog Concept,” “Flywheel Effect,” dan “Level 5 Leadership,” yang memberikan kerangka kerja untuk transformasi perusahaan dari baik menjadi hebat. Ini adalah bacaan penting untuk pemimpin yang ingin membangun budaya bisnis yang berkelanjutan dan sukses.', 'Bisnis', 20, 154000.00, 'great.jpg'),
(23, 'The Lean Startup', 'Eric Ries', 'Buku ini memperkenalkan pendekatan \"lean\" untuk memulai bisnis dengan meminimalkan risiko dan memastikan produk yang dihasilkan benar-benar dibutuhkan oleh pasar. Ries menekankan pentingnya eksperimen, pembelajaran berkelanjutan, dan umpan balik cepat untuk memastikan keberhasilan perusahaan baru. Konsep \"build-measure-learn\" dalam buku ini banyak diadopsi oleh startup di seluruh dunia, memberikan panduan praktis untuk pengusaha yang ingin tumbuh cepat namun tetap berkelanjutan.', 'Bisnis', 20, 115000.00, 'lean.png'),
(24, 'Zero to One', 'Peter Thiel', 'Thiel, salah satu pendiri PayPal, menyajikan perspektif tentang bagaimana inovasi sebenarnya adalah menciptakan sesuatu yang benar-benar baru (dari nol menjadi satu), bukan hanya melakukan apa yang sudah ada. Ia menekankan pentingnya berpikir unik dan menemukan pasar baru, bukan bersaing di pasar yang sudah ada. Buku ini mengajarkan cara mengidentifikasi peluang bisnis yang disruptif dan menjadi pemimpin di bidang yang belum tersentuh.', 'Bisnis', 20, 138000.00, 'zero.jpg'),
(25, 'The Innovator\'s Dilemma', 'Clayton M. Christensen', 'Buku ini menjelaskan mengapa perusahaan besar sering gagal untuk mempertahankan posisi mereka ketika muncul teknologi baru. Christensen menguraikan konsep \"disruptive innovation\" dan menunjukkan bagaimana perusahaan yang sudah mapan seringkali gagal mengadopsi inovasi yang radikal karena fokus pada produk yang ada. Buku ini menjadi panduan bagi eksekutif dalam menghadapi perubahan pasar dan mengadaptasi strategi agar tetap relevan di era yang dinamis.', 'Bisnis', 20, 148000.00, 'dilema.jpg'),
(26, 'Rich Dad Poor Dad', 'Robert T. Kiyosaki', 'Dalam buku ini, Kiyosaki membagikan pelajaran finansial dari dua figur ayah dalam hidupnya—ayah kandungnya yang ia sebut “Poor Dad” dan ayah dari sahabatnya yang disebut “Rich Dad.” Buku ini mengajarkan perbedaan pola pikir tentang uang dan investasi, serta mengapa literasi finansial penting untuk membangun kekayaan. Kiyosaki membahas pentingnya aset, investasi, dan kewirausahaan, memberikan inspirasi bagi pembaca untuk mencapai kebebasan finansial.', 'Bisnis', 20, 143000.00, 'dad.jpg'),
(27, 'The Purpose Driven Life: What on Earth Am I Here For?', 'Rick Warren', 'Buku ini adalah panduan spiritual yang membantu pembaca memahami tujuan hidup mereka berdasarkan prinsip-prinsip Kristen. Rick Warren menguraikan lima tujuan utama yang dianggap Tuhan ingin setiap individu jalani: ibadah, pelayanan, misi, persekutuan, dan pertumbuhan. Dengan pendekatan 40 hari, pembaca diundang untuk menemukan makna dan tujuan hidup mereka melalui refleksi dan tindakan berdasarkan ajaran Alkitab.', 'Agama', 20, 126000.00, 'earth.jpg'),
(28, 'The Book of Joy: Lasting Happiness in a Changing World', 'Dalai Lama', 'Buku ini adalah hasil dialog mendalam antara dua pemimpin spiritual besar, Dalai Lama dan Desmond Tutu. Mereka berbicara tentang bagaimana menemukan kedamaian dan kebahagiaan sejati, meskipun hidup penuh dengan tantangan. Dengan gaya yang personal dan penuh hikmah, mereka berbagi praktik spiritual dan filosofi hidup yang mencakup cinta kasih, kesabaran, dan rasa syukur.', 'Agama', 20, 109000.00, 'joy.jpeg'),
(29, 'Muhammad: His Life Based on the Earliest Sources', 'Martin Lings', 'Buku ini adalah biografi Nabi Muhammad yang disusun dengan gaya yang mengalir dan mudah dipahami. Berdasarkan sumber-sumber awal yang terpercaya, Martin Lings menguraikan kehidupan Nabi Muhammad dari kelahirannya hingga wafatnya, serta nilai-nilai dan ajaran yang beliau sampaikan. Buku ini dianggap sebagai salah satu karya biografi yang paling akurat dan dihormati dalam bahasa Inggris tentang Nabi Muhammad.', 'Agama', 20, 158000.00, 'muhammad.jpg'),
(30, 'In the Footsteps of the Prophet: Lessons from the Life of Muhammad', 'Tariq Ramadan', 'Buku ini menawarkan wawasan mendalam tentang kehidupan Nabi Muhammad dan nilai-nilai yang dapat dipelajari dari perjalanan spiritualnya. Tariq Ramadan, seorang pemikir Muslim kontemporer, menjelaskan bagaimana ajaran dan tindakan Nabi dapat diterapkan dalam konteks modern. Dengan analisis yang tajam dan pemahaman yang dalam, Ramadan menggali aspek-aspek penting seperti kepemimpinan, toleransi, dan keadilan yang menjadi ciri khas kehidupan Nabi Muhammad. Buku ini sangat berguna bagi siapa saja yang ingin memahami lebih dalam tentang etika dan ajaran Islam.', 'Agama', 20, 137000.00, 'tariq.jpeg'),
(31, 'The Purpose Driven Church', 'Rick Warren', 'Dalam buku ini, Rick Warren menjelaskan bagaimana membangun gereja yang sehat dan berkembang dengan tetap setia pada misi dan pesan Kristen. Buku ini menawarkan prinsip-prinsip yang dapat diterapkan oleh pemimpin gereja untuk menciptakan komunitas yang dinamis dan relevan. Warren membahas pentingnya memahami kebutuhan masyarakat, mengembangkan program yang berdampak, dan memfokuskan kegiatan gereja pada penyebaran Injil. Dengan pendekatan yang berbasis pada tujuan, buku ini telah menjadi panduan populer bagi banyak gereja di seluruh dunia.', 'Agama', 20, 144000.00, 'purpose.jpeg'),
(32, 'Where the Wild Things Are', 'Maurice Sendak', 'Buku ini menceritakan kisah Max, seorang anak yang mengenakan kostum serigala dan berpetualang ke dunia imajiner yang dihuni oleh makhluk liar. Max menjadi raja dari \"Wild Things,\" namun pada akhirnya, ia menyadari bahwa ia merindukan rumah dan cinta ibunya. Dengan ilustrasi yang kaya dan cerita yang mendalam, buku ini mengajak anak-anak untuk mengeksplorasi imajinasi mereka sekaligus memahami perasaan rindu dan cinta.(film adapted)', 'Anak-anak', 20, 95000.00, 'wild.jpg\r\n'),
(33, 'Fantastic Beasts and Where to Find Them', 'J.K. Rowling', 'Buku ini adalah panduan tentang berbagai makhluk magis yang ada di dunia sihir, ditulis oleh Newt Scamander, seorang magizoolog terkenal. Meskipun awalnya dirilis sebagai buku pendamping untuk seri Harry Potter, \"Fantastic Beasts\" membawa pembaca dalam eksplorasi makhluk-makhluk unik dan menakjubkan dari mitologi dan imajinasi Rowling. Buku ini dilengkapi dengan ilustrasi dan catatan yang menghibur, menjadikannya bacaan yang menarik bagi penggemar sihir dan petualangan.', 'Anak-anak', 20, 163000.00, 'beast.jpg'),
(34, 'Charlotte\'s Web', 'E.B. White', 'Buku ini menceritakan persahabatan antara seorang gadis bernama Fern dan seekor babi bernama Wilbur, serta Charlotte, seekor laba-laba yang berusaha menyelamatkan Wilbur dari nasib buruk. Dengan tema persahabatan, keberanian, dan siklus kehidupan, buku ini menyentuh hati anak-anak dan mengajarkan nilai-nilai penting tentang cinta dan pengorbanan.(film adapted)', 'Anak-anak', 20, 127000.00, 'charlotte.png'),
(35, 'Matilda', 'Roald Dahl', 'Buku ini bercerita tentang Matilda, seorang gadis kecil yang sangat cerdas dan memiliki kemampuan telekinetik. Meskipun ditakdirkan hidup dengan orang tua yang tidak peduli, Matilda menemukan kekuatan dalam pendidikan dan imajinasinya. Dengan bantuan guru yang baik, ia melawan ketidakadilan yang dilakukan oleh orang dewasa, termasuk kepala sekolah yang jahat. Buku ini menyampaikan pesan tentang kekuatan pengetahuan dan pentingnya berdiri untuk diri sendiri.(film adapted)', 'Anak-anak', 20, 145000.00, 'matilda.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `jumlah_transaksi` int(11) NOT NULL,
  `status_transaksi` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `FK_id_user` int(11) NOT NULL,
  `FK_id_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `FK_id_user` (`FK_id_user`),
  ADD KEY `FK_id_buku` (`FK_id_buku`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `FK_id_buku` FOREIGN KEY (`FK_id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `FK_id_user` FOREIGN KEY (`FK_id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
