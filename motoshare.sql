-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3307
-- Üretim Zamanı: 22 Ara 2025, 10:26:45
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `motoshare_db`
--
CREATE DATABASE IF NOT EXISTS `motoshare_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `motoshare_db`;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--
-- motoshare_db.categories tablosu için yapı okuma hatası: #1932 - Table &#039;motoshare_db.categories&#039; doesn&#039;t exist in engine
-- motoshare_db.categories tablosu için veri okuma hatası: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `motoshare_db`.`categories`&#039; at line 1

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `deneyimler`
--

CREATE TABLE `deneyimler` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `icerik` text NOT NULL,
  `resim_yolu` varchar(255) DEFAULT NULL,
  `ekleyen_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `deneyimler`
--

INSERT INTO `deneyimler` (`id`, `baslik`, `icerik`, `resim_yolu`, `ekleyen_id`, `created_at`) VALUES
(2, 'Yağmurlu Havalar İçin Sürüş Tecrübelerim', 'Selam millet! 4-5 yıllık yağmurlu sürüş tecrübemden size birkaç damla tecrübe akıtayım. Islak zeminlerdeki en büyük kural, gaza, frene ve direksiyona aşırı yumuşak davranmak. Özellikle yağmurun ilk 15 dakikası yolun en tehlikeli olduğu zamandır, çünkü tüm yağ yüzeye çıkar. Beyaz yol çizgileri ve rögar kapakları adeta buz gibidir; onlardan geçerken motoru dik tutmaya bakın. Fren mesafesi iki katına çıktığı için öndeki araçla aranızdaki mesafeyi abartın. Kaskınızda Pinlock yoksa görüşünüz sıfırlanır, bu yüzden buğulanmayı kesinlikle çözün. Yağmurda hız değil, sadece önsezi ve sabır hayat kurtarır, unutmayın.', 'uploads/1765905710_yagmur2.jpg', 2, '2025-12-16 17:19:31'),
(3, 'Uzun Yolda Zihinsel Hazırlık ve Mola Yönetimi', 'Selam millet! Birçok kez 500 km üzeri rotalar yapmış biri olarak, uzun yolda fizikselden çok zihinsel yorgunluğun altını çizmek istiyorum. Motor üzerinde geçirilen saatler sadece bedeni değil, odaklanmayı da bitiriyor. Benim tecrübem şudur: \"Mola ne zaman gerekli diye sorma, gerekli olmadan ver.\" 2 saatte bir 15 dakikalık mola şart. Sadece yakıt almak için değil, gerçekten gözlerinizi kapatıp dinlenmek, biraz esnemek ve şeker/su dengesini korumak için mola verin. Bu sayede son 100 km\'de \"bitkin\" değil, \"dikkatli\" kalıyorsunuz. Unutmayın, yorgunluk kazaların en büyük davetiyesidir.', 'uploads/1765911543_honda-nt700v-11.avif', 2, '2025-12-16 18:56:44'),
(4, 'Rüzgar ve Aerodinamiği Anlamak', 'Tecrübeyle sabit bir durum daha: Çoğu yeni motorcu, motosikleti yolda savuranın sadece sert yan rüzgar olduğunu sanır. Aslında en tehlikelisi, TIR\'ları geçerken veya tünel giriş/çıkışlarındaki anlık hava değişimleridir (aerodinamik şok). Büyük bir aracı geçerken, tam yanına geldiğinizde oluşan vakum sizi kendine çeker, aracı geçince oluşan itme kuvveti ise sizi şeritten dışarı iter. Bu yüzden büyük araçları geçerken biraz gazı kesip, gidonu sıkı tutmak ve bu itme-çekme kuvvetlerine hazırlıklı olmak gerekir. Bu ufak detay, özellikle otobanda hayat kurtarır.', 'uploads/1765911670_Ruzgarli-havalarda-motosiklet-kullanimi-3.jpg', 3, '2025-12-16 19:01:10');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ekipmanlar`
--

CREATE TABLE `ekipmanlar` (
  `id` int(11) NOT NULL,
  `baslik` varchar(150) NOT NULL,
  `aciklama` text DEFAULT NULL,
  `fiyat` decimal(10,2) DEFAULT NULL,
  `resim_yolu` varchar(255) DEFAULT NULL,
  `ekleyen_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `ekipmanlar`
--

INSERT INTO `ekipmanlar` (`id`, `baslik`, `aciklama`, `fiyat`, `resim_yolu`, `ekleyen_id`, `created_at`) VALUES
(2, 'MTS M-910 Helmet Insect Beyaz Motorcu Kaskı Full Face Güneş Vizörlü', 'Bu kaskı görünüşü için aldım ve yolda gerçekten çok dikkat çekiyor. MT Prohelmet, bu fiyata iyi bir güvenlik ve konfor dengesi sunmuş. Tasarımı müthiş olsa da, yüksek hızlarda biraz rüzgar sesi alıyor. Yine de, stil ve günlük sürüşler için kesinlikle tavsiye ederim.', 0.00, 'uploads/1765904007_ktmkask.webp', 2, '2025-12-16 16:53:27'),
(3, 'Venom Dynamıc Motosiklet Montu Siyah 4 Mevsim', 'Selamlar! Yaklaşık 4 ay önce aldım montumu severek kullanıyorum ve tam bir F/P canavarı. Dört mevsimlik olması harika; çıkarılabilir astarıyla yaz/kış konforu sağlıyor. Su geçirmezlik performansı beni şaşırtacak kadar iyi; yağmurda hiç ıslanmadım. Güvenlik de tam not aldı: CE onaylı sırt, omuz ve dirsek korumaları var. Üstelik motor üzerinde estetik duruşu da çok hoş. Koruma ve konfordan ödün vermeyenlere gönül rahatlığıyla öneririm!', 0.00, 'uploads/1765910451_1_org_zoom.webp', 3, '2025-12-16 18:40:51'),
(4, 'Venom Mafsallı Motorsiklet Dizlik', 'Bu Venom Mafsallı Dizlikler, açıkçası \"giriş seviyesi\" bir iş görücü. Ana görevi olan darbe emiciliği sağlıyor ve mafsallı yapısı sayesinde hareket özgürlüğünüzü çok kısıtlamıyor. En sevdiğim yanı ise, alt kısmındaki elastik pedlerin soğuk havalarda kaval ve diz eklemlerini rüzgardan koruması oldu; bu, özellikle soğukta scooter kullananlar için büyük rahatlık. Standart beden olması bazen sıkma yapabilse de, genel olarak parasına göre iyi bir koruma başlangıcı diyebilirim.', 0.00, 'uploads/1765910681_1_org_zoom (1).webp', 3, '2025-12-16 18:44:41'),
(8, '7001 Bot - Ayakkabı Yağmurluğu-kılıfı', 'Selam arkadaşlar, bot kılıfı arayanlar için MTS 7001\'i şiddetle tavsiye ederim. Piyasada çok fazla potluk yapan ürün var ama bu model, elastik bandı sayesinde ayak bileğinde toplanmayı önlüyor ve mobiliteniz yerinde kalıyor. En önemli özelliği tabii ki su ve rüzgar geçirmez yapısı; yağmurlu günlerde spor ayakkabılarımı kuru tutuyor. Alt tabanının anti kayma özelliği güven veriyor ve reflektörleri de ek güvenlik sağlıyor. Taşıma kolaylığı ve 4 mevsim kullanılabilmesiyle bence fiyat/performans ürünü!', 0.00, 'uploads/1765911276_1_org_zoom (2).webp', 2, '2025-12-16 18:54:36');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `reviews`
--
-- motoshare_db.reviews tablosu için yapı okuma hatası: #1932 - Table &#039;motoshare_db.reviews&#039; doesn&#039;t exist in engine
-- motoshare_db.reviews tablosu için veri okuma hatası: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `motoshare_db`.`reviews`&#039; at line 1

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `rotalar`
--

CREATE TABLE `rotalar` (
  `id` int(11) NOT NULL,
  `baslik` varchar(150) NOT NULL,
  `aciklama` text DEFAULT NULL,
  `zorluk_derecesi` varchar(50) DEFAULT NULL,
  `resim_yolu` varchar(255) DEFAULT NULL,
  `ekleyen_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `rotalar`
--

INSERT INTO `rotalar` (`id`, `baslik`, `aciklama`, `zorluk_derecesi`, `resim_yolu`, `ekleyen_id`, `created_at`) VALUES
(1, 'Bursa/İnegöl-Kütahya/Domaniç', 'Bursa’nın İnegöl ilçesi ile Kütahya’nın Domaniç ilçesini birbirine bağlayan 17 kilometrelik kıvrımlı orman yolu sonbahar mevsiminde kesinlikle görülmesi gereken bir rota', 'Orta', 'uploads/1765667166_rota_aw559108-01-ypsu.webp', 2, '2025-12-13 23:06:06'),
(3, 'Erzincan – Kemaliye (Taş Yolu / Karanlık Kanyon)', 'Erzincan\'ın İliç ve Kemaliye ilçeleri arasında yer alan Taş Yolu, dünyanın en tehlikeli yollarından biri olarak gösterilir. Yüksek dağ yamaçlarına oyulmuş, tünellerle dolu bu tek şeritli yol, altınızda Fırat Nehri\'nin aktığı Karanlık Kanyon manzarasına sahiptir. Asfalt kalitesi inişli çıkışlıdır, yol dardır ve manevra alanı yoktur. Virajlarda tünellerin içinden geçmek, yolun ıssızlığı ve anlık manzaralar yüksek dikkat gerektirir. Adrenalin ve doğayla baş başa kalmak isteyenler için unutulmazdır.', 'Zor', 'uploads/1765911915_d148e7a9869f865ea8d2c0f7910b6861.jpg', 3, '2025-12-16 19:05:15'),
(4, 'Kapadokya Turu (Nevşehir - Göreme - Ürgüp)', 'Motosikletle peribacaları, yeraltı şehirleri ve volkanik arazide gezinmek benzersizdir. Rota, Göreme Açık Hava Müzesi, Uçhisar, Avanos ve Derinkuyu gibi turistik noktaları kapsar. Bölge içindeki yollar genellikle iyi asfalt kalitesine sahiptir, trafik yoğundur ama yavaştır, bu da ani hızlanma veya keskin viraj baskısı yaratmaz. Motorunuzu park edip balonları izlemek, vadilerde yürüyüş yapmak ve fotoğraf çekmek için bolca zaman kalır. Tamamen gezi ve keyif odaklıdır.', 'Kolay', 'uploads/1765912149_road-along-the-fairy-chimney-valley-in-cappadocia-2022-11-11-06-31-00-utc-1024x515-1337x672.webp', 3, '2025-12-16 19:09:09');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','editor','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profil_resmi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`, `profil_resmi`) VALUES
(1, 'admin', 'admin@motoshare.com', '202cb962ac59075b964b07152d234b70', 'admin', '2025-12-13 21:51:31', NULL),
(2, 'izzetsalihkaraman', 'izzetsalihkaraman@gmail.com', '$2y$10$yVH4AMngacKd557XW6YoDuBuf61X.Ox7t0YIC0QCVGq.aLPaWFBaq', 'user', '2025-12-13 22:33:01', NULL),
(3, 'motorcu74', 'fkaraman7406@gmail.com', '$2y$10$.XW0Xx.pNPfxOjMKZ6v4hu7K.bvqoANBr5LJiCWWQ3SdqqvrQtEL2', 'user', '2025-12-16 18:31:58', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `id` int(11) NOT NULL,
  `tur` varchar(50) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `yorum` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `parent_id` int(11) DEFAULT NULL COMMENT 'Üst yorumun IDsi',
  `deleted_at` datetime DEFAULT NULL COMMENT 'Silinme tarihi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `yorumlar`
--

INSERT INTO `yorumlar` (`id`, `tur`, `item_id`, `user_id`, `yorum`, `created_at`, `parent_id`, `deleted_at`) VALUES
(2, 'ekipman', 8, 3, 'kış günleri spor ayakkabı giymeyi seviyorum ama hem ayaklarım hem paçalarım ıslanıyor işimi görür mü?', '2025-12-16 19:16:19', NULL, NULL),
(3, 'ekipman', 8, 2, 'bence kesinlikle görür paçalarına da bir damla su değmesine bile izin vermez', '2025-12-16 19:38:42', 2, NULL),
(4, 'ekipman', 8, 2, 'ys', '2025-12-16 19:39:16', 3, '2025-12-16 22:39:29'),
(5, 'rota', 4, 2, 'arkadaşlar Kapadokya rotasını bitirdim, motosikletle keşif yapmak için şahaneymiş! Yollar mis gibi, trafik sakin. Sabah erken kalkıp Göreme\'de balonları izlerken motorun yanında kahve içmek paha biçilmezdi. Kafa dinlemelik, yormayan bir rota arayanlara birebir.', '2025-12-16 19:41:36', NULL, NULL),
(6, 'deneyim', 4, 2, 'Arkadaşlar, otoyolda TIR geçerken dikkat edin. Yanından geçerken oluşan vakum sizi çekiyor, geçtikten sonra ise itiyor. Gidonu sıkı tutup anlık hava değişimlerine hazırlıklı olmak şart.', '2025-12-16 19:42:55', NULL, NULL),
(7, 'rota', 4, 3, 'Ben de geçen sene gezdim. Peribacaları arasında sürmek inanılmaz bir his. Scooter\'dan touring\'e kadar her motorun keyif alacağı, stresi sıfırlayan harika bir deneyim.', '2025-12-16 19:44:38', 5, NULL),
(8, 'deneyim', 4, 3, 'Çok doğru tespit! Ben buna aerodinamik şok diyorum. Tünel giriş/çıkışlarında da bu etkiyi yaşarsınız. Hızı biraz kesip, bu kuvvetleri hissetmeye alışmak gerekiyor.', '2025-12-16 19:45:17', 6, NULL);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `deneyimler`
--
ALTER TABLE `deneyimler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ekipmanlar`
--
ALTER TABLE `ekipmanlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `rotalar`
--
ALTER TABLE `rotalar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `deneyimler`
--
ALTER TABLE `deneyimler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `ekipmanlar`
--
ALTER TABLE `ekipmanlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `rotalar`
--
ALTER TABLE `rotalar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Veritabanı: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Tablo döküm verisi `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"motoshare_db\",\"table\":\"ekipmanlar\"},{\"db\":\"motoshare_db\",\"table\":\"users\"}]');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Tablo döküm verisi `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2025-12-16 17:45:24', '{\"Console\\/Mode\":\"collapse\",\"lang\":\"tr\"}');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Tablo için indeksler `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Tablo için indeksler `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Tablo için indeksler `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Tablo için indeksler `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Tablo için indeksler `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Tablo için indeksler `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Tablo için indeksler `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Tablo için indeksler `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Tablo için indeksler `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Tablo için indeksler `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Tablo için indeksler `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Tablo için indeksler `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Tablo için indeksler `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Tablo için indeksler `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Tablo için indeksler `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Tablo için indeksler `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Tablo için indeksler `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Veritabanı: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
