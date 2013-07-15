-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 15. Juli 2013 jam 04:54
-- Versi Server: 5.5.16
-- Versi PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_advertising`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `captcha`
--

CREATE TABLE IF NOT EXISTS `captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `word` varchar(20) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=73 ;

--
-- Dumping data untuk tabel `captcha`
--

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `word`) VALUES
(72, 1373856829, 'RRIVMA3F');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dlmbg_admin`
--

CREATE TABLE IF NOT EXISTS `dlmbg_admin` (
  `id_admin` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(150) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `dlmbg_admin`
--

INSERT INTO `dlmbg_admin` (`id_admin`, `username`, `password`, `nama`) VALUES
(1, 'admin', '92d8cc6c17e7211ca8955e7e52a86232', 'Gede Lumbung'),
(3, 'gedesumawijayaa', '6b817046dc8088031084ff363e5e283c', 'Gede Lumbung');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dlmbg_artikel`
--

CREATE TABLE IF NOT EXISTS `dlmbg_artikel` (
  `id_artikel` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(150) NOT NULL,
  `tanggal` int(20) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `id_admin` int(5) NOT NULL,
  `counter` int(10) NOT NULL,
  PRIMARY KEY (`id_artikel`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `dlmbg_artikel`
--

INSERT INTO `dlmbg_artikel` (`id_artikel`, `judul`, `tanggal`, `isi`, `gambar`, `id_admin`, `counter`) VALUES
(1, 'AMD Umuman APU E-Series Terbaru AMD Umuman APU E-Series Terbaru', 1349035514, '<p>Kembali lagi ketemu di malam minggu yang diselimuti dengan hujan dan mendung ini. Ditambah dengan perut <em>mules</em> gak karuan gara-gara tadi sore saya makan sambal semangkok sendirian. Dan inilah dilema punya perut yang bisa dikatakan <em>&#8216;ndeso bin katrok</em>. Syukurnya sampai hari senin saya tidak sedang dikejar-kejar dengan kerjaan, jadinya 2 hari ini bisa santai <img src=''http://gedelumbung.com/wp-includes/images/smilies/icon_wink.gif'' alt='';)'' class=''wp-smiley'' /> . Saya rasa momennya memang pas, pekerjaan rampung (yang ini masih ada sisa), skripsi juga ikut rampung (tinggal ngumpul revisi doang). Serasa benar-benar menjadi mahasiswa tingkat akhir yang bebas.<span id="more-2986"></span></p>\r\n<p>Nah, ngomong-ngomong soal mahasiswa tingkat akhir, saya agak &#8220;<em>gimana gitu</em>&#8221; dengan yang namanya mahasiswa tingkat akhir. Kalo bahasa saya, mahasiswa tingkat akhir itu adalah mahasiswa paling &#8220;<em>naskeleng</em>&#8221; sedunia (artinya cari tau sendiri aja :p). Yupzzz, saya punya pengalaman yang buruk dengan berbagai mahasiswa yang sedang menyandang predikat tingkat akhir, walaupun gak semuanya. Dulu saya pernah tidak dibayar untuk mengerjakan skripsi. Dan baru-baru kemarin, mahasiswa yang dulu sempat saya bantu di detik-detik sidang skripsinya, melangsungkan pernikahan. Apa yang terjadi saudara-saudara??? Saya tidak masuk ke dalam daftar tamu undangan. Eaaaaaa&#8230;..sangat &#8220;<em>naskeleng</em>&#8221; sekali saudara. Dari kasus-kasus di atas, bisa saya simpulkan bahwa mahasiswa tingkat akhir itu setelah menjalani sidang skripsi, akan mengalami syndrom &#8220;LUPA&#8221;. Entah itu &#8220;lupa&#8221; teman, &#8220;lupa&#8221; dulu yang bantu siapa, hingga yang paling klasik, yaitu &#8220;lupa&#8221; bayar. Untuk yang merasa dan tidak setuju dengan tulisan saya ini, <em>monggo </em>gak usah dibaca. Toh&#8230;juga ini blog pribadi saya, yang bayar hosting juga saya pribadi, jadi saya bebas mengeksplorasi apa yang ada di pikiran saya, entah itu keluh kesah, ide dan apapun itu.</p>\r\n<p>Nah, mari kita beranjak dari mahasiswa tingkat akhir yang mempunyai problem di atas. Kali ini saya kembali akan berbagi sebuah contoh desain web seperti di postingan yang <a href="http://gedelumbung.com/category/tutorial-multimedia/tutorial-desain-web/">sebelumnya</a>. Di postingan ini, saya akan berbagi contoh desain website dinas pemerintahan. Desainnya masih sangat sederhana, hanya memainkan warna-warna <em>soft</em> agar enak dilihat untuk jangka waktu yang lama. Yaw udah, gak usah pake&#8217; lama, <em>monggo</em> dilihat skrinsutnya di bawah ini :</p>', '1.jpg', 1, 7),
(2, 'AMD Umuman APU E-Series Terbaru AMD Umuman APU E-Series Terbaru', 1349035514, 'Kembali lagi ketemu di malam minggu yang diselimuti dengan hujan dan mendung ini. Ditambah dengan perut mules gak karuan gara-gara tadi sore saya makan sambal semangkok sendirian. Dan inilah dilema punya perut yang bisa dikatakan ‘ndeso bin katrok. Syukurnya sampai hari senin', '2.jpg', 1, 1),
(3, 'AMD Umuman APU E-Series Terbaru', 1349035514, 'Kembali lagi ketemu di malam minggu yang diselimuti dengan hujan dan mendung ini. Ditambah dengan perut mules gak karuan gara-gara tadi sore saya makan sambal semangkok sendirian. Dan inilah dilema punya perut yang bisa dikatakan ‘ndeso bin katrok. Syukurnya sampai hari senin', '1.jpg', 1, 1),
(4, 'AMD Umuman APU E-Series Terbaru', 1349035514, 'Kembali lagi ketemu di malam minggu yang diselimuti dengan hujan dan mendung ini. Ditambah dengan perut mules gak karuan gara-gara tadi sore saya makan sambal semangkok sendirian. Dan inilah dilema punya perut yang bisa dikatakan ‘ndeso bin katrok. Syukurnya sampai hari senin', '2.jpg', 1, 1),
(5, 'AMD Umuman APU E-Series Terbaru', 1349035514, 'Kembali lagi ketemu di malam minggu yang diselimuti dengan hujan dan mendung ini. Ditambah dengan perut mules gak karuan gara-gara tadi sore saya makan sambal semangkok sendirian. Dan inilah dilema punya perut yang bisa dikatakan ‘ndeso bin katrok. Syukurnya sampai hari senin', '2.jpg', 1, 1),
(6, 'Bappeda dan STIKOM selenggarakan WORKSHOP Internet Marketing', 1349035514, 'Kembali lagi ketemu di malam minggu yang diselimuti dengan hujan dan mendung ini. Ditambah dengan perut mules gak karuan gara-gara tadi sore saya makan sambal semangkok sendirian. Dan inilah dilema punya perut yang bisa dikatakan â€˜ndeso bin katrok. Syukurnya sampai hari senin', '1.jpg', 1, 1),
(7, 'asu', 1365990762, '<p>kuluk</p>', '629f267e017798360b4d5120965ea34b.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dlmbg_counter`
--

CREATE TABLE IF NOT EXISTS `dlmbg_counter` (
  `id_counter` int(2) NOT NULL AUTO_INCREMENT,
  `counter` int(5) NOT NULL,
  PRIMARY KEY (`id_counter`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `dlmbg_counter`
--

INSERT INTO `dlmbg_counter` (`id_counter`, `counter`) VALUES
(1, 27);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dlmbg_file`
--

CREATE TABLE IF NOT EXISTS `dlmbg_file` (
  `id_file` int(10) NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(150) NOT NULL,
  PRIMARY KEY (`id_file`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `dlmbg_file`
--

INSERT INTO `dlmbg_file` (`id_file`, `keterangan`) VALUES
(1, 'aa0e0492f98ad312afdaf079665bc2f8.txt'),
(2, 'a3481a6edc2a055c27e3e3b43df9f86a.txt'),
(3, '53451e1127e3d97ce7568f62643a5371.txt');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dlmbg_gambar_iklan`
--

CREATE TABLE IF NOT EXISTS `dlmbg_gambar_iklan` (
  `id_gambar_iklan` int(10) NOT NULL AUTO_INCREMENT,
  `id_iklan` int(10) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  PRIMARY KEY (`id_gambar_iklan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data untuk tabel `dlmbg_gambar_iklan`
--

INSERT INTO `dlmbg_gambar_iklan` (`id_gambar_iklan`, `id_iklan`, `gambar`) VALUES
(1, 1, 'gbr_1_1.png'),
(2, 1, 'gbr_1_2.png'),
(10, 10, '89bfb2a1fc4900ae9cdc1d4d33675b45.png'),
(11, 4, '86a7c7184ff9b09d3f5a8e847f9ba168.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dlmbg_iklan`
--

CREATE TABLE IF NOT EXISTS `dlmbg_iklan` (
  `id_iklan` int(10) NOT NULL AUTO_INCREMENT,
  `id_lokasi` int(5) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `id_member` int(10) NOT NULL,
  `judul_iklan` varchar(200) NOT NULL,
  `keterangan` text NOT NULL,
  `harga` int(20) NOT NULL,
  `tanggal` int(20) NOT NULL,
  `kondisi` varchar(10) NOT NULL,
  `tipe` varchar(10) NOT NULL,
  `counter` int(10) NOT NULL,
  `st` int(1) NOT NULL,
  `tanggal_expired` int(30) NOT NULL,
  `rentang_harga` varchar(100) NOT NULL,
  PRIMARY KEY (`id_iklan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data untuk tabel `dlmbg_iklan`
--

INSERT INTO `dlmbg_iklan` (`id_iklan`, `id_lokasi`, `id_kategori`, `id_member`, `judul_iklan`, `keterangan`, `harga`, `tanggal`, `kondisi`, `tipe`, `counter`, `st`, `tanggal_expired`, `rentang_harga`) VALUES
(1, 1, 1, 1, 'Tanah Kavling Di Padang Sambian Denpasar', '<p>Dijual tanah kavling terbatas di Denpasar Barat, tepatnya di Padang Griya Padangsambian. Lokasi berada di dalam perumahan yang sudah berkembang sehingga berbagai fasilitas pendukung sudah tersedia. Lokasi kavling dekat dengan daerah pertokoan dan tidak jauh dari daerah wisata Seminyak dan Kerobokan. Meski berada di pusat kota tapi lokasinya tenang sehingga akan memberikan kenyamanan bila dibangun rumah untuk tempat tinggal maupun kost-kostan..Di sekitar lokasi sudah banyak rumah termasuk salah satu perumahan elite Sastra Loka Taman Sekar. Pilihan luas kavling mulai dari 1,25 Are s/d 1,3 Are.. Inilah investasi tanah kavling terbaik dengan harga terjangkau di Kota Denpasar.</p>\r\n\r\n\r\n<p>Untuk info, hubungi : </p>\r\nJemy : 0361-7832236, 081338707091, 081933046490', 390000000, 1349035514, 'Bekas', 'Jual', 43, 1, 0, '140000-1700000'),
(4, 2, 3, 5, 'Tanah Kavling Di Padang Sambian Denpasar', 'Dijual tanah kavling terbatas di Denpasar Barat, tepatnya di Padang Griya Padangsambian. Lokasi berada di dalam perumahan yang sudah berkembang sehingga berbagai fasilitas pendukung sudah tersedia. Lokasi kavling dekat dengan daerah pertokoan dan tidak jauh dari daerah wisata Seminyak dan Kerobokan. Meski berada di pusat kota tapi lokasinya tenang sehingga akan memberikan kenyamanan bila dibangun rumah untuk tempat tinggal maupun kost-kostan..Di sekitar lokasi sudah banyak rumah termasuk salah satu perumahan elite Sastra Loka Taman Sekar. Pilihan luas kavling mulai dari 1,25 Are s/d 1,3 Are.. Inilah investasi tanah kavling terbaik dengan harga terjangkau di Kota Denpasar.\r\n\r\n\r\nUntuk info, hubungi : \r\nJemy : 0361-7832236, 081338707091, 081933046490', 390000000, 1360945384, 'Baru', 'Beli', 48, 1, 0, '140000-1700000'),
(5, 0, 4, 5, 'Tanah Kavling Di Padang Sambian Denpasar', '', 0, 0, '', '', 0, 1, 0, '140000-1700000'),
(6, 0, 6, 5, 'Tanah Kavling Di Padang Sambian Denpasar', '', 0, 0, '', '', 2, 1, 0, '140000-1700000'),
(7, 0, 1, 5, 'Tanah Kavling Di Padang Sambian Denpasar', '', 0, 0, '', '', 4, 1, 0, '140000-1700000'),
(8, 0, 5, 5, 'Tanah Kavling Di Padang Sambian Denpasar', '', 0, 0, '', '', 5, 1, 0, '140000-1700000'),
(13, 1, 11, 5, 'fff', '<p>fff</p>', 100000, 1371432297, 'Bekas', 'Sewa', 1, 0, 0, '140000-1900000'),
(14, 1, 11, 5, 'fff', '<p>fff</p>', 100000, 1371424393, 'Bekas', 'Sewa', 0, 0, 0, '140000-1700000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dlmbg_kategori`
--

CREATE TABLE IF NOT EXISTS `dlmbg_kategori` (
  `id_kategori` int(5) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(100) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `custom_fields` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data untuk tabel `dlmbg_kategori`
--

INSERT INTO `dlmbg_kategori` (`id_kategori`, `kategori`, `icon`, `custom_fields`) VALUES
(1, 'Mobil', 'icon-mobil.png', 'icon-plane'),
(2, 'Motor', 'icon-motor.png', 'icon-screenshot'),
(3, 'Properti', 'icon-properti.png', 'icon-asterisk'),
(4, 'Mobil', 'icon-mobil.png', 'icon-plane'),
(5, 'Motor', 'icon-motor.png', 'icon-screenshot'),
(6, 'Properti', 'icon-properti.png', 'icon-asterisk'),
(7, 'Mobil', 'icon-mobil.png', 'icon-plane'),
(8, 'Motor', 'icon-motor.png', 'icon-screenshot'),
(9, 'Properti', 'icon-properti.png', 'icon-asterisk'),
(10, 'Mobil', 'icon-mobil.png', 'icon-plane'),
(11, 'Motor', 'icon-motor.png', 'icon-screenshot'),
(12, 'Properti', 'icon-properti.png', 'icon-asterisk'),
(13, 'Elektronik', 'icon-mobil.png', 'icon-fire');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dlmbg_komentar_iklan`
--

CREATE TABLE IF NOT EXISTS `dlmbg_komentar_iklan` (
  `id_komentar_iklan` int(10) NOT NULL AUTO_INCREMENT,
  `id_iklan` int(10) NOT NULL,
  `id_member` int(10) NOT NULL,
  `tanggal` int(40) NOT NULL,
  `komentar` text NOT NULL,
  PRIMARY KEY (`id_komentar_iklan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `dlmbg_komentar_iklan`
--

INSERT INTO `dlmbg_komentar_iklan` (`id_komentar_iklan`, `id_iklan`, `id_member`, `tanggal`, `komentar`) VALUES
(3, 1, 5, 1365807327, '.Di sekitar lokasi sudah banyak rumah termasuk salah satu perumahan elite Sastra Loka Taman Sekar. Pilihan luas kavling mulai dari 1,25 Are s/d 1,3 Are.. Inilah investasi tanah kavling terbaik dengan harga terjangkau di Kota Denpasar.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dlmbg_lokasi`
--

CREATE TABLE IF NOT EXISTS `dlmbg_lokasi` (
  `id_lokasi` int(5) NOT NULL AUTO_INCREMENT,
  `lokasi` varchar(100) NOT NULL,
  PRIMARY KEY (`id_lokasi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `dlmbg_lokasi`
--

INSERT INTO `dlmbg_lokasi` (`id_lokasi`, `lokasi`) VALUES
(1, 'Bali'),
(2, 'Jawa Timur');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dlmbg_member`
--

CREATE TABLE IF NOT EXISTS `dlmbg_member` (
  `id_member` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telpon` varchar(30) NOT NULL,
  `no_hp` varchar(30) NOT NULL,
  `jk` char(1) NOT NULL,
  `tgl_bergabung` int(20) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `stts` int(1) NOT NULL,
  `kode_aktivasi` varchar(50) NOT NULL,
  `kode_forget` varchar(50) NOT NULL,
  PRIMARY KEY (`id_member`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `dlmbg_member`
--

INSERT INTO `dlmbg_member` (`id_member`, `nama`, `email`, `alamat`, `no_telpon`, `no_hp`, `jk`, `tgl_bergabung`, `gambar`, `password`, `stts`, `kode_aktivasi`, `kode_forget`) VALUES
(1, 'Gede Lumbung', 'gedesumawijaya@gmail.com', '', '', '', '', 0, '', 'd2ba5ac651d985a7fad886044d92b5cd', 1, '', ''),
(5, 'Gede Becing Becing', 'asra_sebudi@yahoo.com', 'd', '465676', '0812345678900000', 'L', 1362435082, '4052ec526346126f4797916aa9257b96.jpg', 'd2ba5ac651d985a7fad886044d92b5cd', 1, '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dlmbg_menu`
--

CREATE TABLE IF NOT EXISTS `dlmbg_menu` (
  `id_menu` int(5) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL,
  `menu` varchar(50) NOT NULL,
  `url_route` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `posisi` varchar(10) NOT NULL,
  `custom_fields` varchar(50) NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data untuk tabel `dlmbg_menu`
--

INSERT INTO `dlmbg_menu` (`id_menu`, `id_parent`, `menu`, `url_route`, `content`, `posisi`, `custom_fields`) VALUES
(1, 0, 'BERANDA', 'web', '', 'kiri', 'icon-home'),
(2, 0, 'TENTANG KAMI', '', '<p><span style="font-weight: bold;">Tentang Gede Lumbung</span></p>\r\n<p style="text-align: justify;">Saya ini cuma mahasiswa TI biasa, yang masih sangat kutu kupret, sontoloyo dan jauh dari kata sempurna. Selain itu juga, seorang mahasiswa yang tidak puas dengan keadilan yang diterapkan di kampus. Bisa dibilang, saya ini adalah salah satu makhluk open source. Gara-gara semangat open source yang sangat tinggi, akhirnya saya banyak menerima proyek <em>2M</em> (Makasi Mas) alias proyek TengKyu. Yang penting tetap semangat aja deh, hitung-hitung cari pengalaman (alasan lawas).</p>\r\n<p><span style="font-weight: bold;">Kirim-Kirim Donasi <img src=''http://gedelumbung.com/wp-includes/images/smilies/icon_biggrin.gif'' alt='':D'' class=''wp-smiley'' /> </span></p>\r\n<p style="text-align: justify;">Mungkin ada sebagian pengunjung blog yang mempunyai rejeki lebih dan berniat menyisihkan sedikit rejekinya untuk keberlangsungan blog saya ini&#8230;??? Bisa kirimi-kirim ke rekening BCA saya, dengan nomor rekening 1800588011 a/n Ni Wayan Sedariasih. Besar donasi sesuai keikhlasan rekan-rekan saja, karena kalau ikhlas pasti berkah untuk semua <img src=''http://gedelumbung.com/wp-includes/images/smilies/icon_smile.gif'' alt='':)'' class=''wp-smiley'' /> . Terima Kasih.</p>\r\n<p><span style="font-weight: bold;">Saya Juga Nangkring Di :</span></p>\r\n<ul>\r\n<li><span style="font-weight: normal;">Dimana-mana Hatiku Senang</span></li>\r\n<li><a href="ymsgr:sendim?go_blind_boys"><img alt="" src="http://opi.yahoo.com/online?u=go_blind_boys&amp;m=g&amp;t=2" border="0" /></a></li>\r\n</ul>', 'kiri', 'icon-fire'),
(3, 0, 'INDEXS MEMBER', 'web/member', '', 'kiri', 'icon-user'),
(4, 0, 'INDEXS IKLAN', 'web/iklan', '', 'kiri', 'icon-tags'),
(5, 0, 'ARTIKEL', 'web/artikel', '', 'kiri', 'icon-leaf'),
(6, 0, 'SIGN UP MEMBER', 'web/sign_up', '', 'kanan', 'icon-share'),
(7, 0, 'SIGN IN MEMBER', 'web/sign_in', '', 'kanan', 'icon-check'),
(8, 0, 'Terms & Condition', '', '', 'footer', ''),
(9, 0, 'Privacy Policy', '', '', 'footer', ''),
(10, 0, 'Site Map', '', '', 'footer', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dlmbg_pesan`
--

CREATE TABLE IF NOT EXISTS `dlmbg_pesan` (
  `id_pesan` int(40) NOT NULL AUTO_INCREMENT,
  `id_sampul` int(30) NOT NULL,
  `id_penerima` int(30) NOT NULL,
  `id_pengirim` int(30) NOT NULL,
  `isi` text NOT NULL,
  `stts` char(1) NOT NULL,
  `waktu` int(20) NOT NULL,
  PRIMARY KEY (`id_pesan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `dlmbg_pesan`
--

INSERT INTO `dlmbg_pesan` (`id_pesan`, `id_sampul`, `id_penerima`, `id_pengirim`, `isi`, `stts`, `waktu`) VALUES
(1, 1, 1, 5, '<p>1</p>', 'Y', 1363549399),
(2, 1, 1, 5, '<p>2</p>', 'N', 1363549403),
(3, 1, 5, 1, '<p>3</p>', 'N', 1363549419),
(4, 1, 1, 5, '<p>4</p>', 'N', 1363549431),
(5, 1, 5, 1, '<p>5</p>', 'N', 1363549441),
(6, 1, 5, 1, '<p>6</p>', 'N', 1363549446),
(7, 1, 5, 1, '<p>7</p>', 'N', 1363549450),
(8, 1, 5, 1, '<p>satu jam ajj bisa bersama mu itu udh buat aq bhgia selamnya...<br>(P Y H)<br></p>', 'N', 1363550017);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dlmbg_pesan_admin`
--

CREATE TABLE IF NOT EXISTS `dlmbg_pesan_admin` (
  `id_pesan_admin` int(40) NOT NULL AUTO_INCREMENT,
  `id_pengirim` int(30) NOT NULL,
  `isi` text NOT NULL,
  `waktu` int(20) NOT NULL,
  `admin` int(1) NOT NULL,
  PRIMARY KEY (`id_pesan_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `dlmbg_pesan_admin`
--

INSERT INTO `dlmbg_pesan_admin` (`id_pesan_admin`, `id_pengirim`, `isi`, `waktu`, `admin`) VALUES
(1, 5, 'ok', 1341112357, 0),
(2, 5, 'sippp', 1341112357, 1),
(3, 5, '<p>ok bang</p>', 1364053545, 0),
(4, 1, '<p>pesanmu gak masuk</p>', 1366249353, 1),
(5, 1, '<p>oyiiiik om</p>', 1366249413, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dlmbg_setting`
--

CREATE TABLE IF NOT EXISTS `dlmbg_setting` (
  `id_setting` int(10) NOT NULL AUTO_INCREMENT,
  `tipe` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content_setting` text NOT NULL,
  PRIMARY KEY (`id_setting`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data untuk tabel `dlmbg_setting`
--

INSERT INTO `dlmbg_setting` (`id_setting`, `tipe`, `title`, `content_setting`) VALUES
(1, 'site_title', 'Nama Situs', 'Anacaraka Online Advertising'),
(2, 'site_footer', 'Teks Footer', 'Copyright © 2013 Anacaraka Advertising. All Rights Reserved.<br>\r\nAnacaraka Advertising, Yos Sudarso Street 28. Banyuwangi, East Java, Indonesia. Tel.+62 333 420600. Fax.+62 333 414890<br>\r\nYou come here with the IP Address 125.164.244.154<br>\r\nDesigned & Developed by Gede Lumbung - http://gedelumbung.com'),
(3, 'site_quotes', 'Quotes Situs', 'Promosikan Barang dan Jasa Anda Disini Secara Mudah'),
(4, 'site_send_activation', 'Aktivasi Via Email', 'yes'),
(5, 'site_limit_iklan_front', 'Limit Iklan Halaman Depan', '4'),
(6, 'site_limit_kategori_front', 'LImit Kategori Halaman Depan', '12'),
(7, 'site_theme', 'Nama Template', 'blue_strap'),
(8, 'site_address', 'Alamat & Contact Person', 'Email : gedesumawijaya@gmail.com<br>\r\nTelpon : 083847395705<br>\r\nAlamat : Jln.Dewi Madri Gg. V/5, Renon, Denpasar Timur'),
(9, 'site_limit_artikel_hot', 'Limit Artikel Populer Pada Sidebar', '3'),
(10, 'site_limit_iklan_kategori', 'Limit Iklan Per Kategori', '16'),
(11, 'site_limit_sidebar', 'Limit Content Sidebar', '10'),
(12, 'site_limit_member', 'Limit Daftar Member', '5'),
(13, 'site_email_server', 'Email Server', 'gedelumbung@gmail.com'),
(14, 'site_max_post', 'Maksimal Batas Posting', '3');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
