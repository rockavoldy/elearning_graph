-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Nov 23, 2020 at 08:09 AM
-- Server version: 10.2.36-MariaDB-1:10.2.36+maria~bionic
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webkelas_db_skripsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE `akses` (
  `id_akses` int(11) NOT NULL,
  `id_mhs` int(11) NOT NULL,
  `akses` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`id_akses`, `id_mhs`, `akses`) VALUES
(2, 5, 'evaluasi'),
(3, 3, 'evaluasi'),
(4, 13, 'evaluasi');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` int(11) NOT NULL,
  `nip` char(12) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `tempat_lahir` varchar(128) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `foto` varchar(128) DEFAULT NULL,
  `aktif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `nip`, `nama`, `email`, `password`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `foto`, `aktif`) VALUES
(1, '1600347', 'Muhammad', 'muhammadrafli246@gmail.com', '99b9247447d07a2db7a74030f82643b4', 'L', 'Purwakata', '1998-06-24', 'default.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `edge_graf`
--

CREATE TABLE `edge_graf` (
  `id` int(11) NOT NULL,
  `id_soal` int(11) DEFAULT NULL,
  `start_node_id` int(11) DEFAULT NULL,
  `end_node_id` int(11) DEFAULT NULL,
  `directional` tinyint(1) DEFAULT NULL,
  `kunci` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `edge_graf`
--

INSERT INTO `edge_graf` (`id`, `id_soal`, `start_node_id`, `end_node_id`, `directional`, `kunci`) VALUES
(1, 1, 1, 2, 1, NULL),
(2, 1, 1, 3, 1, NULL),
(3, 4, 10, 11, 1, NULL),
(4, 4, 10, 12, 1, NULL),
(5, 4, 11, 12, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_edge_graf`
--

CREATE TABLE `jawaban_edge_graf` (
  `id` int(11) NOT NULL,
  `id_soal` int(11) DEFAULT NULL,
  `id_mhs` int(11) DEFAULT NULL,
  `start_node_id` int(11) DEFAULT NULL,
  `end_node_id` int(11) DEFAULT NULL,
  `bobot` int(11) DEFAULT NULL,
  `directional` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_graf_text`
--

CREATE TABLE `jawaban_graf_text` (
  `id` int(11) NOT NULL,
  `id_soal` int(11) DEFAULT NULL,
  `id_mhs` int(11) DEFAULT NULL,
  `text_graf` varchar(255) DEFAULT NULL,
  `text_node` varchar(255) DEFAULT NULL,
  `text_edge` varchar(255) DEFAULT NULL,
  `directional` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_tugas`
--

CREATE TABLE `jawaban_tugas` (
  `id_jawaban` int(11) NOT NULL,
  `id_topik` int(11) NOT NULL,
  `id_mhs` int(11) NOT NULL,
  `file_jawaban` varchar(128) DEFAULT NULL,
  `total_submit` int(11) NOT NULL,
  `st` varchar(128) NOT NULL,
  `nilai` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jawaban_tugas`
--

INSERT INTO `jawaban_tugas` (`id_jawaban`, `id_topik`, `id_mhs`, `file_jawaban`, `total_submit`, `st`, `nilai`) VALUES
(3, 1, 5, '51160023n.pdf', 1, 'nilai', '100'),
(4, 7, 5, '5160023f.pdf', 5, 'sudah', ''),
(5, 9, 5, '591600239.pdf', 1, 'sudah', NULL),
(6, 8, 5, '58160023h.pdf', 1, 'sudah', NULL),
(7, 11, 5, '511160023f.pdf', 1, 'sudah', NULL),
(8, 10, 5, '510160023h.pdf', 1, 'sudah', NULL),
(9, 1, 3, '311600357.pptx', 1, 'nilai', '100'),
(10, 1, 8, '811600001.pptx', 1, 'sudah', NULL),
(11, 7, 3, '371600357.pptx', 1, 'nilai', '80'),
(12, 8, 3, '381600357.pptx', 1, 'sudah', NULL),
(13, 9, 3, '391600357.pptx', 1, 'sudah', NULL),
(14, 10, 3, '3101600357.pptx', 1, 'sudah', NULL),
(15, 11, 3, '3111600357.pptx', 1, 'sudah', NULL),
(16, 1, 13, '1311908682.docx', 1, 'nilai', '70'),
(17, 7, 13, '1371908682.docx', 1, 'sudah', NULL),
(18, 8, 13, '1381908682.docx', 1, 'sudah', NULL),
(19, 9, 13, '1391908682.docx', 1, 'sudah', NULL),
(20, 10, 13, '13101908682.docx', 1, 'sudah', NULL),
(21, 11, 13, '13111908682.docx', 1, 'sudah', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `konten`
--

CREATE TABLE `konten` (
  `id_konten` int(11) NOT NULL,
  `id_topik` int(11) NOT NULL,
  `isi_konten` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konten`
--

INSERT INTO `konten` (`id_konten`, `id_topik`, `isi_konten`) VALUES
(1, 1, '<div align=\"center\"><br></div><font color=\"#000000\">Apa itu Graf? Bagaimana bisa dikatakan sebuah Graf? Simak Penjelasannya . .<br></font><p align=\"center\"></p><div class=\"embed-container\"><iframe src=\"https://www.youtube.com/embed/m6FDVyzgFM8\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen=\"\" frameborder=\"0\"></iframe></div><br><p></p><p><br></p><h3><font color=\"#000000\"><span style=\"font-family: Tahoma;\">Soal</span></font></h3><p><font color=\"#000000\">1. Berikan minimal 3 contoh penerapan graf pada kehidupan sehari hari ? Contoh :</font></p><table class=\"table table-bordered\"><tbody><tr><td align=\"center\"><b>Graf</b><br></td><td align=\"center\"><b>Node atau simpul</b><br></td><td align=\"center\"><b>Edge atau sisi</b><br></td></tr><tr><td align=\"center\">Transportasi<br></td><td align=\"center\">Persimpangan jalan<br></td><td align=\"center\">Jalan raya<br></td></tr></tbody></table><p><font color=\"#000000\">2. Perhatikanlah peta Jawa Barat dibawah ini!<br></font></p><p><font color=\"#000000\">&nbsp; &nbsp;&nbsp; </font><img style=\"width: 50%;\" src=\"http://webkelasku.tech/./assets/img/upload/c88727a40745b809a3c86bd96c3a3d43.png\"><font color=\"#000000\"><br></font></p><p><font color=\"#000000\">&nbsp;Buatlah sebuah graf berdasarkan peta tersebut! (Abaikan perbedaan kota dan kabupaten)<br></font></p>'),
(2, 7, '<div align=\"center\"><br></div><div align=\"left\"><font color=\"#000000\">Berapakah jumlah jenis - jenis Graf? Lalu apa saja jenis - jenis dari graf? simak penjelasannya . . . <br></font></div><div align=\"center\"><div class=\"embed-container\"><iframe src=\"//www.youtube.com/embed/rdwvFEhN4aI\" class=\"note-video-clip\" allowfullscreen=\"\" frameborder=\"0\"></iframe></div><br><p><br></p><h3 align=\"left\"><u><font color=\"#000000\"><span style=\"font-family: Tahoma;\">Soal</span></font></u></h3><p align=\"left\"><font color=\"#000000\">Contoh</font></p><p align=\"left\"><img style=\"width: 423px;\" src=\"http://webkelasku.tech/./assets/img/upload/9920d3364870bd6ced1c5f88731eef03.PNG\"><font color=\"#000000\"><br></font></p><p align=\"left\"><font color=\"#000000\">1. Tuliskan simpul dan edge berdasarkan gambar dibawah ini!</font></p><p align=\"left\"><font color=\"#000000\">&nbsp;&nbsp;&nbsp; a) </font><img style=\"\" src=\"http://webkelasku.tech/./assets/img/upload/48f09dfb49aa1d0da9a678511ad3cf6a.PNG\"><font color=\"#000000\"><br></font></p><p align=\"left\"><font color=\"#000000\">&nbsp;&nbsp;&nbsp; b) </font><img style=\"\" src=\"http://webkelasku.tech/./assets/img/upload/9b79b4366c7b6d030329f575b6407fa6.PNG\"><font color=\"#000000\"><br></font></p><p align=\"left\"><font color=\"#000000\">2. Buatlah sebuah graf dengan simpul dan sisi sebagai berikut!</font></p><p align=\"left\"><font color=\"#000000\">&nbsp;&nbsp;&nbsp; a) V = { 1, 2, 3, 4} dan E = { (1,3), (2,1), (2,4), (3,1), (3,1), (3,2), (3,4), (3,4), (4,3)}</font></p><p align=\"left\"><font color=\"#000000\">&nbsp;&nbsp;&nbsp; b) V = { A, B, C, D, E} dan E = { (A,B), (A,D), (B,A), (B,C), (B,E), (C,B), (C,D), (C,E), (D,E), (D,C) </font></p><p align=\"left\"><font color=\"#000000\">3. Sebutkan jenis graf pada no 2!<br></font></p><p align=\"left\"><font color=\"#000000\">&nbsp; <br></font></p></div>');
INSERT INTO `konten` (`id_konten`, `id_topik`, `isi_konten`) VALUES
(3, 8, '<div align=\"left\"><font color=\"#000000\"><br></font></div><div align=\"left\"><font color=\"#000000\"><!--[if gte mso 9]><xml>\r\n <o:OfficeDocumentSettings>\r\n  <o:RelyOnVML></o:RelyOnVML>\r\n  <o:AllowPNG></o:AllowPNG>\r\n </o:OfficeDocumentSettings>\r\n</xml><![endif]--><!--[if gte mso 9]><xml>\r\n <w:WordDocument>\r\n  <w:View>Normal</w:View>\r\n  <w:Zoom>0</w:Zoom>\r\n  <w:TrackMoves></w:TrackMoves>\r\n  <w:TrackFormatting></w:TrackFormatting>\r\n  <w:PunctuationKerning></w:PunctuationKerning>\r\n  <w:ValidateAgainstSchemas></w:ValidateAgainstSchemas>\r\n  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>\r\n  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>\r\n  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>\r\n  <w:DoNotPromoteQF></w:DoNotPromoteQF>\r\n  <w:LidThemeOther>EN-US</w:LidThemeOther>\r\n  <w:LidThemeAsian>X-NONE</w:LidThemeAsian>\r\n  <w:LidThemeComplexScript>X-NONE</w:LidThemeComplexScript>\r\n  <w:Compatibility>\r\n   <w:BreakWrappedTables></w:BreakWrappedTables>\r\n   <w:SnapToGridInCell></w:SnapToGridInCell>\r\n   <w:WrapTextWithPunct></w:WrapTextWithPunct>\r\n   <w:UseAsianBreakRules></w:UseAsianBreakRules>\r\n   <w:DontGrowAutofit></w:DontGrowAutofit>\r\n   <w:SplitPgBreakAndParaMark></w:SplitPgBreakAndParaMark>\r\n   <w:EnableOpenTypeKerning></w:EnableOpenTypeKerning>\r\n   <w:DontFlipMirrorIndents></w:DontFlipMirrorIndents>\r\n   <w:OverrideTableStyleHps></w:OverrideTableStyleHps>\r\n  </w:Compatibility>\r\n  <m:mathPr>\r\n   <m:mathFont m:val=\"Cambria Math\"></m:mathFont>\r\n   <m:brkBin m:val=\"before\"></m:brkBin>\r\n   <m:brkBinSub m:val=\"&#45;-\"></m:brkBinSub>\r\n   <m:smallFrac m:val=\"off\"></m:smallFrac>\r\n   <m:dispDef></m:dispDef>\r\n   <m:lMargin m:val=\"0\"></m:lMargin>\r\n   <m:rMargin m:val=\"0\"></m:rMargin>\r\n   <m:defJc m:val=\"centerGroup\"></m:defJc>\r\n   <m:wrapIndent m:val=\"1440\"></m:wrapIndent>\r\n   <m:intLim m:val=\"subSup\"></m:intLim>\r\n   <m:naryLim m:val=\"undOvr\"></m:naryLim>\r\n  </m:mathPr></w:WordDocument>\r\n</xml><![endif]--><!--[if gte mso 9]><xml>\r\n <w:LatentStyles DefLockedState=\"false\" DefUnhideWhenUsed=\"false\"\r\n  DefSemiHidden=\"false\" DefQFormat=\"false\" DefPriority=\"99\"\r\n  LatentStyleCount=\"376\">\r\n  <w:LsdException Locked=\"false\" Priority=\"0\" QFormat=\"true\" Name=\"Normal\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" QFormat=\"true\" Name=\"heading 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 7\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 8\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 9\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 7\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 8\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 9\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 7\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 8\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 9\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Normal Indent\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"footnote text\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"annotation text\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"header\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"footer\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index heading\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"35\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"caption\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"table of figures\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"envelope address\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"envelope return\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"footnote reference\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"annotation reference\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"line number\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"page number\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"endnote reference\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"endnote text\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"table of authorities\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"macro\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"toa heading\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Bullet\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Number\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Bullet 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Bullet 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Bullet 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Bullet 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Number 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Number 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Number 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Number 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"10\" QFormat=\"true\" Name=\"Title\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Closing\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Signature\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"1\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"Default Paragraph Font\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text Indent\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Continue\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Continue 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Continue 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Continue 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Continue 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Message Header\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"11\" QFormat=\"true\" Name=\"Subtitle\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Salutation\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Date\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text First Indent\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text First Indent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Note Heading\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text Indent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text Indent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Block Text\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Hyperlink\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"FollowedHyperlink\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"22\" QFormat=\"true\" Name=\"Strong\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"20\" QFormat=\"true\" Name=\"Emphasis\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Document Map\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Plain Text\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"E-mail Signature\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Top of Form\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Bottom of Form\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Normal (Web)\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Acronym\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Address\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Cite\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Code\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Definition\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Keyboard\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Preformatted\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Sample\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Typewriter\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Variable\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Normal Table\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"annotation subject\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"No List\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Outline List 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Outline List 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Outline List 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Simple 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Simple 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Simple 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Classic 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Classic 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Classic 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Classic 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Colorful 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Colorful 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Colorful 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Columns 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Columns 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Columns 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Columns 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Columns 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 7\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 8\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 7\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 8\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table 3D effects 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table 3D effects 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table 3D effects 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Contemporary\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Elegant\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Professional\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Subtle 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Subtle 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Web 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Web 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Web 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Balloon Text\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" Name=\"Table Grid\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Theme\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" Name=\"Placeholder Text\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"1\" QFormat=\"true\" Name=\"No Spacing\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" Name=\"Revision\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"34\" QFormat=\"true\"\r\n   Name=\"List Paragraph\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"29\" QFormat=\"true\" Name=\"Quote\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"30\" QFormat=\"true\"\r\n   Name=\"Intense Quote\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"19\" QFormat=\"true\"\r\n   Name=\"Subtle Emphasis\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"21\" QFormat=\"true\"\r\n   Name=\"Intense Emphasis\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"31\" QFormat=\"true\"\r\n   Name=\"Subtle Reference\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"32\" QFormat=\"true\"\r\n   Name=\"Intense Reference\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"33\" QFormat=\"true\" Name=\"Book Title\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"37\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"Bibliography\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"TOC Heading\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"41\" Name=\"Plain Table 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"42\" Name=\"Plain Table 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"43\" Name=\"Plain Table 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"44\" Name=\"Plain Table 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"45\" Name=\"Plain Table 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"40\" Name=\"Grid Table Light\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\" Name=\"Grid Table 1 Light\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\" Name=\"Grid Table 6 Colorful\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\" Name=\"Grid Table 7 Colorful\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"Grid Table 1 Light Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"Grid Table 6 Colorful Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"Grid Table 7 Colorful Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"Grid Table 1 Light Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"Grid Table 6 Colorful Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"Grid Table 7 Colorful Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"Grid Table 1 Light Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"Grid Table 6 Colorful Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"Grid Table 7 Colorful Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"Grid Table 1 Light Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"Grid Table 6 Colorful Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"Grid Table 7 Colorful Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"Grid Table 1 Light Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"Grid Table 6 Colorful Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"Grid Table 7 Colorful Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"Grid Table 1 Light Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"Grid Table 6 Colorful Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"Grid Table 7 Colorful Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\" Name=\"List Table 1 Light\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\" Name=\"List Table 6 Colorful\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\" Name=\"List Table 7 Colorful\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"List Table 1 Light Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"List Table 6 Colorful Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"List Table 7 Colorful Accent 1\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"List Table 1 Light Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"List Table 6 Colorful Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"List Table 7 Colorful Accent 2\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"List Table 1 Light Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"List Table 6 Colorful Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"List Table 7 Colorful Accent 3\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"List Table 1 Light Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"List Table 6 Colorful Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"List Table 7 Colorful Accent 4\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"List Table 1 Light Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"List Table 6 Colorful Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"List Table 7 Colorful Accent 5\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"List Table 1 Light Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"List Table 6 Colorful Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"List Table 7 Colorful Accent 6\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Mention\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Smart Hyperlink\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Hashtag\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Unresolved Mention\"></w:LsdException>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Smart Link\"></w:LsdException>\r\n </w:LatentStyles>\r\n</xml><![endif]-->Dalam graf memiliki beberapa istilah yang harus kita ketahui, mari simak penjelasannya . . . </font></div><div align=\"center\"><div class=\"embed-container\"><iframe src=\"//www.youtube.com/embed/j1sqXbdtzRg\" class=\"note-video-clip\" allowfullscreen=\"\" frameborder=\"0\"></iframe></div><div class=\"embed-container\"><h3 align=\"left\"><u><font color=\"#000000\"><span style=\"font-family: Tahoma;\"><br></span></font></u></h3><h3 align=\"left\"><u><font color=\"#000000\"><span style=\"font-family: Tahoma;\">Soal</span></font></u></h3><p align=\"left\"><font color=\"#000000\">1. Perhatikan blok di bawah ini </font></p><p align=\"left\">&nbsp; <img style=\"width: 213px;\" src=\"http://webkelasku.tech/./assets/img/upload/27c946aa28681f057864588c2a89a263.PNG\"><font color=\"#000000\"><br></font></p><p align=\"left\"><font color=\"#000000\">&nbsp;Ten<span style=\"font-family: &quot;Nunito&quot;;\">tukan posisi yang mana bukan tetangga dari blok a? Lalu mana saja simpul yang bersisian?</span><br></font></p><p align=\"left\"><font color=\"#000000\"> 2. Berikan sebuah contoh dari jejak , lintasan , sirkuit dan siklus? <br></font></p><p align=\"left\"><font color=\"#000000\">3. </font><font color=\"#000000\"><span style=\"font-family: verdana, geneva, sans-serif; font-size: 10pt;\">Misalkan <span class=\"MathJax_Preview\" style=\"color: inherit;\"></span><span id=\"MathJax-Element-20-Frame\" class=\"mjx-chtml MathJax_CHTML\" tabindex=\"0\" style=\"font-size: 123%; position: relative;\" data-mathml=\"<math xmlns=&quot;http://www.w3.org/1998/Math/MathML&quot;><mi>G</mi></math>\" role=\"presentation\"><span id=\"MJXc-Node-76\" class=\"mjx-math\" aria-hidden=\"true\"><span id=\"MJXc-Node-77\" class=\"mjx-mrow\"><span id=\"MJXc-Node-78\" class=\"mjx-mi\"><span class=\"mjx-char MJXc-TeX-math-I\" style=\"padding-top: 0.491em; padding-bottom: 0.308em;\">G</span></span></span></span></span></span><span style=\"font-family: verdana, geneva, sans-serif; font-size: 10pt;\"> adalah graf dengan barisan derajat: <span class=\"MathJax_Preview\" style=\"color: inherit;\"></span><span id=\"MathJax-Element-21-Frame\" class=\"mjx-chtml MathJax_CHTML\" tabindex=\"0\" style=\"font-size: 123%; position: relative;\" data-mathml=\"<math xmlns=&quot;http://www.w3.org/1998/Math/MathML&quot;><mo stretchy=&quot;false&quot;>(</mo><mn>4</mn><mo>,</mo><mn>3</mn><mo>,</mo><mn>2</mn><mo>,</mo><mn>1</mn><mo stretchy=&quot;false&quot;>)</mo></math>\" role=\"presentation\"><span id=\"MJXc-Node-79\" class=\"mjx-math\" aria-hidden=\"true\"><span id=\"MJXc-Node-80\" class=\"mjx-mrow\"><span id=\"MJXc-Node-81\" class=\"mjx-mo\"><span class=\"mjx-char MJXc-TeX-main-R\" style=\"padding-top: 0.491em; padding-bottom: 0.613em;\">(</span></span><span id=\"MJXc-Node-82\" class=\"mjx-mn\"><span class=\"mjx-char MJXc-TeX-main-R\" style=\"padding-top: 0.369em; padding-bottom: 0.369em;\">4</span></span><span id=\"MJXc-Node-83\" class=\"mjx-mo\"><span class=\"mjx-char MJXc-TeX-main-R\" style=\"margin-top: -0.18em; padding-bottom: 0.552em;\">,</span></span><span id=\"MJXc-Node-84\" class=\"mjx-mn MJXc-space1\"><span class=\"mjx-char MJXc-TeX-main-R\" style=\"padding-top: 0.369em; padding-bottom: 0.369em;\">3</span></span><span id=\"MJXc-Node-85\" class=\"mjx-mo\"><span class=\"mjx-char MJXc-TeX-main-R\" style=\"margin-top: -0.18em; padding-bottom: 0.552em;\">,</span></span><span id=\"MJXc-Node-86\" class=\"mjx-mn MJXc-space1\"><span class=\"mjx-char MJXc-TeX-main-R\" style=\"padding-top: 0.369em; padding-bottom: 0.369em;\">2</span></span><span id=\"MJXc-Node-87\" class=\"mjx-mo\"><span class=\"mjx-char MJXc-TeX-main-R\" style=\"margin-top: -0.18em; padding-bottom: 0.552em;\">,</span></span><span id=\"MJXc-Node-88\" class=\"mjx-mn MJXc-space1\"><span class=\"mjx-char MJXc-TeX-main-R\" style=\"padding-top: 0.369em; padding-bottom: 0.369em;\">1</span></span><span id=\"MJXc-Node-89\" class=\"mjx-mo\"><span class=\"mjx-char MJXc-TeX-main-R\" style=\"padding-top: 0.491em; padding-bottom: 0.613em;\">)</span></span></span></span></span></span><span style=\"font-family: verdana, geneva, sans-serif; font-size: 10pt;\">. Tentukan banyaknya sisi di <span class=\"MathJax_Preview\" style=\"color: inherit;\"></span><span id=\"MathJax-Element-22-Frame\" class=\"mjx-chtml MathJax_CHTML\" tabindex=\"0\" style=\"font-size: 123%; position: relative;\" data-mathml=\"<math xmlns=&quot;http://www.w3.org/1998/Math/MathML&quot;><mi>G</mi></math>\" role=\"presentation\"><span id=\"MJXc-Node-90\" class=\"mjx-math\" aria-hidden=\"true\"><span id=\"MJXc-Node-91\" class=\"mjx-mrow\"><span id=\"MJXc-Node-92\" class=\"mjx-mi\"><span class=\"mjx-char MJXc-TeX-math-I\" style=\"padding-top: 0.491em; padding-bottom: 0.308em;\">G</span></span></span></span></span></span><span style=\"font-family: verdana, geneva, sans-serif; font-size: 10pt;\"> dan gambarkan graf <span class=\"MathJax_Preview\" style=\"color: inherit;\"></span><span id=\"MathJax-Element-23-Frame\" class=\"mjx-chtml MathJax_CHTML\" tabindex=\"0\" style=\"font-size: 123%; position: relative;\" data-mathml=\"<math xmlns=&quot;http://www.w3.org/1998/Math/MathML&quot;><mi>G</mi></math>\" role=\"presentation\"><span id=\"MJXc-Node-93\" class=\"mjx-math\" aria-hidden=\"true\"><span id=\"MJXc-Node-94\" class=\"mjx-mrow\"><span id=\"MJXc-Node-95\" class=\"mjx-mi\"><span class=\"mjx-char MJXc-TeX-math-I\" style=\"padding-top: 0.491em; padding-bottom: 0.308em;\">G!</span></span></span></span></span></span></font></p><p align=\"left\"><font color=\"#000000\"><span style=\"font-family: verdana, geneva, sans-serif; font-size: 10pt;\"><span id=\"MathJax-Element-23-Frame\" class=\"mjx-chtml MathJax_CHTML\" tabindex=\"0\" style=\"font-size: 123%; position: relative;\" data-mathml=\"<math xmlns=&quot;http://www.w3.org/1998/Math/MathML&quot;><mi>G</mi></math>\" role=\"presentation\"><span id=\"MJXc-Node-93\" class=\"mjx-math\" aria-hidden=\"true\"><span id=\"MJXc-Node-94\" class=\"mjx-mrow\"><span id=\"MJXc-Node-95\" class=\"mjx-mi\"><span class=\"mjx-char MJXc-TeX-math-I\" style=\"padding-top: 0.491em; padding-bottom: 0.308em;\">4. <span style=\"font-family: &quot;Nunito&quot;;\">Jelaskan mengapa banyaknya simpul berderajat ganjil adalah genap!</span> <br></span></span></span></span></span></span><span style=\"font-family: verdana, geneva, sans-serif; font-size: 10pt;\"></span></font></p></div><br></div><br>');
INSERT INTO `konten` (`id_konten`, `id_topik`, `isi_konten`) VALUES
(4, 9, '<div align=\"center\"><br></div><font color=\"#000000\">Apa itu Graf? Bagaimana bisa dikatakan sebuah Graf? Simak Penjelasannya . .<br></font><p align=\"center\"></p> <div class=\"embed-container\"><iframe src=\"//www.youtube.com/embed/oN7xizKBTVg\" class=\"note-video-clip\" allowfullscreen=\"\" frameborder=\"0\"></iframe></div><br><h3 align=\"left\"><u><font color=\"#000000\"><span style=\"font-family: Tahoma;\">Soal</span></font></u></h3><p align=\"left\"><font color=\"#000000\">1. Perhatikan graf dibawah ini!</font></p><p align=\"left\">&nbsp; <img style=\"width: 25%;\" src=\"http://webkelasku.tech/./assets/img/upload/2a3e51de16611d2748b79cfef39b3d06.png\"><font color=\"#000000\"><br></font></p><p align=\"left\"><font color=\"#000000\">&nbsp;Buatlah representasi dari graf tersebut menggunakan adjasensi matriks dan adjasensi lis!</font></p><p align=\"left\"><font color=\"#000000\">2. Buatlah sebuah graf dengan menggunakan matriks dibawah ini!</font></p><p align=\"left\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <img style=\"\" src=\"http://webkelasku.tech/./assets/img/upload/c7919caff8b80ceda373f4558530f67c.png\"><font color=\"#000000\"><br></font></p><p align=\"left\"><font color=\"#000000\">3. </font><font color=\"#000000\"><font color=\"#000000\">Buatlah sebuah graf dengan menggunakan matriks dibawah ini!</font></font></p><p align=\"left\"><font color=\"#000000\"><font color=\"#000000\">&nbsp; &nbsp; </font></font><img style=\"width: 169px;\" src=\"http://webkelasku.tech/./assets/img/upload/844596ea94672263848c137a6383d68c.PNG\"><font color=\"#000000\"><font color=\"#000000\"><br></font></font></p>'),
(5, 10, '<div align=\"center\"><br></div><div align=\"center\"><div class=\"embed-container\">asa<iframe src=\"//www.youtube.com/embed/8FfbHQkKeO0\" class=\"note-video-clip\" allowfulscreen=\"\" frameborder=\"0\"></iframe></div><br></div><br><h3 align=\"left\"><u><font color=\"#000000\"><span style=\"font-family: Tahoma;\">Soal</span></font></u></h3><p align=\"left\"><font color=\"#000000\">1. Apakah graf dibawah memiliki sirkuit euler? jika mempunyai , bagaimana sirkuitnya?</font></p><p align=\"left\">&nbsp; <img style=\"width: 388px;\" src=\"http://webkelasku.tech/./assets/img/upload/2ed6f7a38d3b54022919d5021b1556d6.PNG\"><font color=\"#000000\"><br></font></p><p align=\"left\"><font color=\"#000000\">2. Buatlah contoh graf sederhana yang memiliki lintasan dan sirkuit euler!</font><br></p>'),
(6, 11, '<div align=\"center\"><br></div><div align=\"center\"><div class=\"embed-container\"><iframe src=\"//www.youtube.com/embed/-WKjIAqlcvE\" class=\"note-video-clip\" allowfullscreen=\"\" frameborder=\"0\"></iframe></div><div class=\"embed-container\"><h3 align=\"left\"><u><font color=\"#000000\"><span style=\"font-family: Tahoma;\"><br></span></font></u></h3><h3 align=\"left\"><u><font color=\"#000000\"><span style=\"font-family: Tahoma;\">Soal</span></font></u></h3><div align=\"left\"><font color=\"#000000\">1. Apakah graf dibawah merupakan graf hamilton? jika tidak , apakah graf tersebut merupakan graf semi hamilton?</font></div><div align=\"left\"><img style=\"width: 375px;\" src=\"http://webkelasku.tech/./assets/img/upload/a32f94ca91ddd61c267e8b33d9d32607.PNG\"><font color=\"#000000\"><br></font></div><div align=\"left\"><font color=\"#000000\"><br></font></div><div align=\"left\"><font color=\"#000000\">2. Buat sebuah graf hamilton yang terdapat graf semi hamilton?<br></font></div></div></div><br>');

-- --------------------------------------------------------

--
-- Table structure for table `kunci_jawaban_edge_graf`
--

CREATE TABLE `kunci_jawaban_edge_graf` (
  `id` int(11) NOT NULL,
  `id_soal` int(11) DEFAULT NULL,
  `start_node_id` int(11) DEFAULT NULL,
  `end_node_id` int(11) DEFAULT NULL,
  `directional` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kunci_jawaban_graf_text`
--

CREATE TABLE `kunci_jawaban_graf_text` (
  `id` int(11) NOT NULL,
  `id_soal` int(11) DEFAULT NULL,
  `id_text_graf` int(11) DEFAULT NULL,
  `id_text_node` int(11) DEFAULT NULL,
  `id_text_edge` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mhs` int(11) NOT NULL,
  `nim` varchar(128) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `tahun_masuk` varchar(128) NOT NULL,
  `kelas` varchar(128) NOT NULL,
  `jenis_kelamin` char(2) NOT NULL,
  `tempat_lahir` varchar(128) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(128) NOT NULL,
  `aktif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mhs`, `nim`, `nama`, `email`, `password`, `tahun_masuk`, `kelas`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `foto`, `aktif`) VALUES
(3, '1600357', 'User', 'aping06@gmail.com', '99b9247447d07a2db7a74030f82643b4', '', '', '', '', '0000-00-00', '', 'default.jpg', 2),
(5, '160023', 'renra', 'renra@gmail.com', 'f3770595e0cb4d9a988bd5da98d2187d', '', '', '', '', '0000-00-00', '', 'default.jpg', 2),
(6, '071241952', 'Alvia Rifani', 'Alviaaghnir@gmail.com', '1063dafa0be04152678126ebab0d9053', '', '', '', '', '0000-00-00', '', 'default.jpg', 2),
(7, '0123456', 'Alvia Rifani', 'Alviaaghni@gmail.com', 'c338c45ca6cd348e14c731379b903da1', '', '', '', '', '0000-00-00', '', 'default.jpg', 2),
(8, '1600001', 'User Test', 'user@gmail.com', '25d55ad283aa400af464c76d713c07ad', '', '', '', '', '0000-00-00', '', 'default.jpg', 2),
(9, '1600356', 'user', 'user1@gmail.com', '25d55ad283aa400af464c76d713c07ad', '', '', '', '', '0000-00-00', '', 'default.jpg', 1),
(10, '1600002', 'User', 'user2@gmail.com', '25d55ad283aa400af464c76d713c07ad', '', '', '', '', '0000-00-00', '', 'default.jpg', 2),
(11, '1904323', 'Muhammad Rachim Vadrian', 'mrachimv@upi.edu', 'abe48d16cad8476f6f2c8e048ed5b8e3', '', '', '', '', '0000-00-00', '', 'default.jpg', 2),
(12, '1909894', 'Lelah Sari', 'lelahsari@upi.edu', 'd9f71eda918efa6277736c76231765fa', '', '', '', '', '0000-00-00', '', 'default.jpg', 2),
(13, '1908682', 'Meila Pujianti', 'meilapujianti@gmail.com', '8f96ff4f6a6db9dad8d19196ce44088a', '', '', '', '', '0000-00-00', '', 'default.jpg', 2),
(14, '1904656', 'Muhamad Reza Anggana Putra', 'rezaangganaputra14@gmail.com', '1a5e5ef257662f767ab3a2248d12154e', '', '', '', '', '0000-00-00', '', 'default.jpg', 2),
(15, '1904838', 'Dalih Nurdiansah', 'dalih03praja@upi.edu', '65ac455f46c63c54901fd1a94261d430', '', '', '', '', '0000-00-00', '', 'default.jpg', 2),
(16, '1901538', 'Siti Widya Ningsih', 'sitiwidya@upi.edu', '9bad03848b5e688d8421b7e21079d2e0', '', '', '', '', '0000-00-00', '', 'default.jpg', 2),
(17, '1900787', 'Muhammad Shofwan Qobus', 'shofwanqobus@upi.edu', '85c31bb8dc781e51c222a3a824424a77', '', '', '', '', '0000-00-00', '', 'default.jpg', 2),
(18, '1900682', 'Julia Putri', 'hsriyanti1@gmail.com', 'e14309b7af7a43308cb9b6ab985d04b7', '', '', '', '', '0000-00-00', '', 'default.jpg', 2),
(19, '1902319', 'Fauzan Fiqriansyah', 'fauzanfiqriansyah126@gmail.com', 'e26b52819a2d1594ad309e0858fdf730', '', '', '', '', '0000-00-00', '', 'default.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `node_graf`
--

CREATE TABLE `node_graf` (
  `id` int(11) NOT NULL,
  `id_soal` int(11) DEFAULT NULL,
  `posx` int(11) DEFAULT NULL,
  `posy` int(11) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `kunci` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `node_graf`
--

INSERT INTO `node_graf` (`id`, `id_soal`, `posx`, `posy`, `text`, `kunci`) VALUES
(1, 1, 75, 100, 'A', NULL),
(2, 1, 125, 80, 'B', NULL),
(3, 1, 175, 100, 'C', NULL),
(4, 1, 225, 80, 'D', NULL),
(5, 3, 25, 100, 'A', NULL),
(6, 3, 75, 80, 'B', NULL),
(7, 3, 125, 100, 'C', NULL),
(8, 3, 175, 80, 'D', NULL),
(9, 3, 225, 100, 'E', NULL),
(10, 4, 25, 100, 'A', NULL),
(11, 4, 75, 80, 'B', NULL),
(12, 4, 125, 100, 'C', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id` int(11) NOT NULL,
  `kode_topik` varchar(255) DEFAULT NULL,
  `bentuk_soal` varchar(255) NOT NULL,
  `soal` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id`, `kode_topik`, `bentuk_soal`, `soal`) VALUES
(1, 'Pengertian', 'membuat-graf', 'Membuat graf peta Jabodetabek'),
(2, 'Pengertian', 'drag-and-drop', 'Contoh penerapan graf'),
(3, 'Pengertian', 'membuat-graf-euler', ''),
(4, 'Pengertian', 'membuat-matriks', '');

-- --------------------------------------------------------

--
-- Table structure for table `soal_graf_text`
--

CREATE TABLE `soal_graf_text` (
  `id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `bentuk` enum('graf','node','edge') NOT NULL,
  `id_soal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soal_graf_text`
--

INSERT INTO `soal_graf_text` (`id`, `text`, `bentuk`, `id_soal`) VALUES
(1, 'WWW', 'graf', 2),
(2, 'Rantai Makanan', 'graf', 2),
(3, 'Sirkuit', 'graf', 2),
(4, 'Warnet', 'graf', 2),
(5, 'Halaman Web', 'node', 2),
(6, 'Spesies', 'node', 2),
(7, 'Komponen', 'node', 2),
(8, 'Komputer', 'node', 2),
(9, 'Nasi', 'node', 2),
(10, 'Kabel', 'edge', 2),
(11, 'Jalan', 'edge', 2),
(12, 'hyperlink', 'edge', 2),
(13, 'LAN', 'edge', 2),
(14, 'predator', 'edge', 2);

-- --------------------------------------------------------

--
-- Table structure for table `topik`
--

CREATE TABLE `topik` (
  `id_topik` int(11) NOT NULL,
  `nama_topik` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `kode_topik` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topik`
--

INSERT INTO `topik` (`id_topik`, `nama_topik`, `icon`, `kode_topik`) VALUES
(1, 'Pengertian graf', 'fa fa-book-open', 'Pengertian'),
(7, 'Jenis - Jenis Graf', 'fa fa-book-open', 'Jenis'),
(8, 'Istilah - Istilah pada Graf', 'fa fa-book-open', 'Istilah'),
(9, 'Representasi pada Graf', 'fa fa-book-open', 'Representasi'),
(10, 'Graf Euler', 'fa fa-book-open', 'Euler'),
(11, 'Graf Hamilton', 'fa fa-book-open', 'Hamilton');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_jtugas`
-- (See below for the actual view)
--
CREATE TABLE `v_jtugas` (
`id_jawaban` int(11)
,`nama` varchar(128)
,`id_topik` int(11)
,`id_mhs` int(11)
,`file_jawaban` varchar(128)
,`total_submit` int(11)
,`st` varchar(128)
,`nilai` varchar(128)
);

-- --------------------------------------------------------

--
-- Structure for view `v_jtugas`
--
DROP TABLE IF EXISTS `v_jtugas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_jtugas`  AS SELECT `jawaban_tugas`.`id_jawaban` AS `id_jawaban`, `mahasiswa`.`nama` AS `nama`, `jawaban_tugas`.`id_topik` AS `id_topik`, `jawaban_tugas`.`id_mhs` AS `id_mhs`, `jawaban_tugas`.`file_jawaban` AS `file_jawaban`, `jawaban_tugas`.`total_submit` AS `total_submit`, `jawaban_tugas`.`st` AS `st`, `jawaban_tugas`.`nilai` AS `nilai` FROM (`jawaban_tugas` join `mahasiswa`) WHERE `mahasiswa`.`id_mhs` = `jawaban_tugas`.`id_mhs` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`id_akses`),
  ADD KEY `id_mhs` (`id_mhs`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indexes for table `edge_graf`
--
ALTER TABLE `edge_graf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_soal` (`id_soal`),
  ADD KEY `start_node_id` (`start_node_id`),
  ADD KEY `end_node_id` (`end_node_id`);

--
-- Indexes for table `jawaban_edge_graf`
--
ALTER TABLE `jawaban_edge_graf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_soal` (`id_soal`),
  ADD KEY `start_node_id` (`start_node_id`),
  ADD KEY `end_node_id` (`end_node_id`),
  ADD KEY `id_mhs` (`id_mhs`);

--
-- Indexes for table `jawaban_graf_text`
--
ALTER TABLE `jawaban_graf_text`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mhs` (`id_mhs`),
  ADD KEY `id_soal` (`id_soal`);

--
-- Indexes for table `jawaban_tugas`
--
ALTER TABLE `jawaban_tugas`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `id_topik` (`id_topik`),
  ADD KEY `id_mhs` (`id_mhs`);

--
-- Indexes for table `konten`
--
ALTER TABLE `konten`
  ADD PRIMARY KEY (`id_konten`),
  ADD KEY `id_topik` (`id_topik`);

--
-- Indexes for table `kunci_jawaban_edge_graf`
--
ALTER TABLE `kunci_jawaban_edge_graf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_soal` (`id_soal`),
  ADD KEY `start_node_id` (`start_node_id`),
  ADD KEY `end_node_id` (`end_node_id`);

--
-- Indexes for table `kunci_jawaban_graf_text`
--
ALTER TABLE `kunci_jawaban_graf_text`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_soal` (`id_soal`),
  ADD KEY `id_text_edge` (`id_text_edge`),
  ADD KEY `id_text_graf` (`id_text_graf`),
  ADD KEY `id_text_node` (`id_text_node`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mhs`);

--
-- Indexes for table `node_graf`
--
ALTER TABLE `node_graf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_soal` (`id_soal`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soal_graf_text`
--
ALTER TABLE `soal_graf_text`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_soal` (`id_soal`);

--
-- Indexes for table `topik`
--
ALTER TABLE `topik`
  ADD PRIMARY KEY (`id_topik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses`
--
ALTER TABLE `akses`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `edge_graf`
--
ALTER TABLE `edge_graf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jawaban_edge_graf`
--
ALTER TABLE `jawaban_edge_graf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jawaban_graf_text`
--
ALTER TABLE `jawaban_graf_text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jawaban_tugas`
--
ALTER TABLE `jawaban_tugas`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `konten`
--
ALTER TABLE `konten`
  MODIFY `id_konten` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kunci_jawaban_edge_graf`
--
ALTER TABLE `kunci_jawaban_edge_graf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kunci_jawaban_graf_text`
--
ALTER TABLE `kunci_jawaban_graf_text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mhs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `node_graf`
--
ALTER TABLE `node_graf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `soal_graf_text`
--
ALTER TABLE `soal_graf_text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `topik`
--
ALTER TABLE `topik`
  MODIFY `id_topik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akses`
--
ALTER TABLE `akses`
  ADD CONSTRAINT `akses_ibfk_1` FOREIGN KEY (`id_mhs`) REFERENCES `mahasiswa` (`id_mhs`);

--
-- Constraints for table `edge_graf`
--
ALTER TABLE `edge_graf`
  ADD CONSTRAINT `edge_graf_ibfk_1` FOREIGN KEY (`id_soal`) REFERENCES `soal` (`id`),
  ADD CONSTRAINT `edge_graf_ibfk_2` FOREIGN KEY (`start_node_id`) REFERENCES `node_graf` (`id`),
  ADD CONSTRAINT `edge_graf_ibfk_3` FOREIGN KEY (`end_node_id`) REFERENCES `node_graf` (`id`);

--
-- Constraints for table `jawaban_edge_graf`
--
ALTER TABLE `jawaban_edge_graf`
  ADD CONSTRAINT `jawaban_edge_graf_ibfk_1` FOREIGN KEY (`id_soal`) REFERENCES `soal` (`id`),
  ADD CONSTRAINT `jawaban_edge_graf_ibfk_2` FOREIGN KEY (`start_node_id`) REFERENCES `node_graf` (`id`),
  ADD CONSTRAINT `jawaban_edge_graf_ibfk_3` FOREIGN KEY (`end_node_id`) REFERENCES `node_graf` (`id`),
  ADD CONSTRAINT `jawaban_edge_graf_ibfk_4` FOREIGN KEY (`id_mhs`) REFERENCES `mahasiswa` (`id_mhs`);

--
-- Constraints for table `jawaban_graf_text`
--
ALTER TABLE `jawaban_graf_text`
  ADD CONSTRAINT `jawaban_graf_text_ibfk_1` FOREIGN KEY (`id_soal`) REFERENCES `soal` (`id`),
  ADD CONSTRAINT `jawaban_graf_text_ibfk_2` FOREIGN KEY (`id_mhs`) REFERENCES `mahasiswa` (`id_mhs`),
  ADD CONSTRAINT `jawaban_graf_text_ibfk_3` FOREIGN KEY (`id_soal`) REFERENCES `soal` (`id`);

--
-- Constraints for table `jawaban_tugas`
--
ALTER TABLE `jawaban_tugas`
  ADD CONSTRAINT `jawaban_tugas_ibfk_1` FOREIGN KEY (`id_topik`) REFERENCES `topik` (`id_topik`),
  ADD CONSTRAINT `jawaban_tugas_ibfk_2` FOREIGN KEY (`id_mhs`) REFERENCES `mahasiswa` (`id_mhs`);

--
-- Constraints for table `konten`
--
ALTER TABLE `konten`
  ADD CONSTRAINT `konten_ibfk_1` FOREIGN KEY (`id_topik`) REFERENCES `topik` (`id_topik`);

--
-- Constraints for table `kunci_jawaban_edge_graf`
--
ALTER TABLE `kunci_jawaban_edge_graf`
  ADD CONSTRAINT `kunci_jawaban_edge_graf_ibfk_1` FOREIGN KEY (`id_soal`) REFERENCES `soal` (`id`),
  ADD CONSTRAINT `kunci_jawaban_edge_graf_ibfk_2` FOREIGN KEY (`start_node_id`) REFERENCES `node_graf` (`id`),
  ADD CONSTRAINT `kunci_jawaban_edge_graf_ibfk_3` FOREIGN KEY (`end_node_id`) REFERENCES `node_graf` (`id`);

--
-- Constraints for table `kunci_jawaban_graf_text`
--
ALTER TABLE `kunci_jawaban_graf_text`
  ADD CONSTRAINT `kunci_jawaban_graf_text_ibfk_1` FOREIGN KEY (`id_soal`) REFERENCES `soal` (`id`),
  ADD CONSTRAINT `kunci_jawaban_graf_text_ibfk_2` FOREIGN KEY (`id_text_edge`) REFERENCES `soal_graf_text` (`id`),
  ADD CONSTRAINT `kunci_jawaban_graf_text_ibfk_3` FOREIGN KEY (`id_text_graf`) REFERENCES `soal_graf_text` (`id`),
  ADD CONSTRAINT `kunci_jawaban_graf_text_ibfk_4` FOREIGN KEY (`id_text_node`) REFERENCES `soal_graf_text` (`id`);

--
-- Constraints for table `node_graf`
--
ALTER TABLE `node_graf`
  ADD CONSTRAINT `node_graf_ibfk_1` FOREIGN KEY (`id_soal`) REFERENCES `soal` (`id`);

--
-- Constraints for table `soal_graf_text`
--
ALTER TABLE `soal_graf_text`
  ADD CONSTRAINT `soal_graf_text_ibfk_1` FOREIGN KEY (`id_soal`) REFERENCES `soal` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;