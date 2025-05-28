-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 28, 2025 lúc 10:59 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `laravel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Tin Việt Nam', NULL, '2025-05-26 04:41:18', '2025-05-26 04:41:18'),
(2, 'Thời sự', NULL, '2025-05-26 04:42:53', '2025-05-26 04:42:53'),
(3, 'chính trị', 2, '2025-05-26 04:44:15', '2025-05-26 04:44:15'),
(4, 'Thế giới', NULL, '2025-05-26 05:48:49', '2025-05-26 05:48:49'),
(5, 'Giải trí', NULL, '2025-05-26 05:50:37', '2025-05-26 05:50:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 6, 2, 'hay', '2025-05-26 06:17:35', '2025-05-26 06:17:35'),
(2, 2, 2, 'hay', '2025-05-26 06:18:16', '2025-05-26 06:18:16'),
(3, 9, 1, 'HAY', '2025-05-26 06:20:17', '2025-05-26 06:20:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2024_05_15_155934_create_users_table', 1),
(4, '2024_05_15_160008_create_categories_table', 1),
(5, '2024_05_15_160023_create_posts_table', 1),
(6, '2024_05_15_160056_create_comments_table', 1),
(7, '2024_05_15_160748_create_sessions_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `category_id`, `title`, `image`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'Nga phóng UAV nhiều chưa từng thấy, nghi nhắm đến căn cứ F-16 Ukraine', 'https://i1-vnexpress.vnecdn.net/2025/05/26/kiev-002-1748247274-2234-1748248934.jpg?w=1020&h=0&q=100&dpr=1&fit=crop&s=Pp9dgrDOodA_syd7iTWe-A', 'Nga triển khai 355 UAV, mức nhiều nhất từ đầu chiến sự, cùng 9 tên lửa để tập kích Ukraine, trong số mục tiêu nghi có căn cứ F-16.\r\n\r\nBộ tư lệnh không quân Ukraine hôm nay cho biết Nga đã tiến hành cuộc tập kích hiệp đồng nhằm vào nước này bằng 9 tên lửa hành trình Kh-101 phóng từ oanh tạc cơ chiến lược, cùng 355 máy bay không người lái (UAV) tự sát Geran-2 và phi cơ mồi nhử.\r\n\r\n\"Các đơn vị phòng không Ukraine đã bắn hạ toàn bộ 9 tên lửa Kh-101 và 233 UAV tự sát, trong khi 55 phi cơ mồi bẫy bị gây nhiễu và lạc đường. Vũ khí đối phương đã đánh xuống 5 địa điểm, trong khi mảnh vỡ tên lửa và UAV gây thiệt hại ở 10 khu vực\", cơ quan này cho hay.\r\n\r\nThông báo của Bộ tư lệnh không quân Ukraine cho thấy dường như họ đã để lọt 67 UAV tự sát.', '2025-05-26 05:53:44', '2025-05-26 05:53:44'),
(2, 1, 4, 'Trung Quốc tìm cách lấp khoảng trống Mỹ để lại ở WHO', 'https://i1-vnexpress.vnecdn.net/2025/05/22/Tru-so-WHO-jpeg-6460-1747891160.jpg?w=1020&h=0&q=100&dpr=1&fit=crop&s=TMoj-eDRPOfjTLB59QF7CA', 'Bắc Kinh sẽ thay thế Washington làm nhà tài trợ hàng đầu cho WHO, mở rộng tầm ảnh hưởng của Trung Quốc khi Mỹ rút lui khỏi các tổ chức quốc tế.\r\n\r\nPhát biểu tại Đại hội đồng Y tế Thế giới ở Thụy Sĩ tuần trước, Phó thủ tướng Trung Quốc Lưu Quốc Trung tuyên bố nước này cam kết tài trợ 500 triệu USD cho Tổ chức Y tế Thế giới (WHO) trong 5 năm tới.\r\n\r\n\"Thế giới đang phải đối mặt với tác động của chủ nghĩa đơn phương và chính trị quyền lực, mang đến những thách thức lớn cho an ninh y tế toàn cầu. Trung Quốc tin tưởng rằng chỉ với sự đoàn kết và hỗ trợ lẫn nhau, chúng ta mới có thể tạo ra một thế giới khỏe mạnh\", ông Lưu nói.\r\n\r\nThông báo tài trợ được Trung Quốc đưa ra cùng ngày Bộ trưởng Y tế Mỹ Robert F. Kennedy Jr. cho rằng WHO coi việc Mỹ rút khỏi tổ chức này như \"lời cảnh tỉnh\". Ông nói WHO đang \"hấp hối, sa lầy trong bộ máy quan liêu phình to, tư duy lạc hậu, xung đột lợi ích và ảnh hưởng chính trị quốc tế\", đồng thời kêu gọi các nước làm theo Mỹ.', '2025-05-26 05:57:35', '2025-05-26 05:57:35'),
(3, 1, 2, 'Tổng Bí thư Tô Lâm và Tổng thống Pháp trồng cây hữu nghị', 'https://i1-vnexpress.vnecdn.net/2025/05/26/z6641056518501-6a9d2ea5e5da92358e5f21355ce3b60e-1748257393.jpg?w=1200&h=0&q=100&dpr=2&fit=crop&s=F7u-3POAejWF-0X3D8lHOw', 'Ông Macron tham quan Nhà sàn, nơi Chủ tịch Hồ Chí Minh đã sống và làm việc từ năm 1958 đến năm 1969.\r\n\r\nCông trình là kiến trúc bằng gỗ hai tầng, mái ngói, được xây dựng năm 1958, theo kiểu nhà sàn dân tộc Tày - Thái ở chiến khu Việt Bắc, nơi gắn bó với Chủ tịch Hồ Chí Minh trong suốt 9 năm kháng chiến chống thực dân Pháp.\r\n\r\nTrước đó, Tổng thống Pháp và phu nhân Brigitte Macron đã có nhiều hoạt động như vào Lăng viếng Chủ tịch Hồ Chí Minh, thăm Văn Miếu - Quốc Tử Giám, đi dạo Hồ Gươm trong đêm.\r\n\r\nChuyến thăm cấp nhà nước của Tổng thống Macron và phu nhân sẽ kéo dài tới ngày 27/5. Đây là chuyến thăm thứ năm của một Tổng thống Pháp tới Việt Nam kể từ khi hai nước thiết lập quan hệ ngoại giao năm 1973, là chuyến thăm Việt Nam đầu tiên của ông Macron kể từ khi nhậm chức.\r\n\r\n', '2025-05-26 05:59:00', '2025-05-26 05:59:00'),
(4, 1, 2, 'Phấn đấu hoàn thành sáp nhập tỉnh trước 15/8', 'https://i1-vnexpress.vnecdn.net/2025/05/26/vne6202-jpg-5428-1748244912-17-3627-6428-1748251217.jpg?w=1020&h=0&q=100&dpr=1&fit=crop&s=r-Upi20aKbZ9fc2YnQ3wzA', 'Bộ Chính trị yêu cầu cấp xã sau sáp nhập đi vào hoạt động từ 1/7 và cấp tỉnh trước 15/8, rút ngắn nửa tháng so với dự kiến trước đây.\r\n\r\nTheo kết luận ngày 25/5, Bộ Chính trị nghiêm cấm tác động, can thiệp trong quá trình sắp xếp nhân sự và xử lý nghiêm vi phạm nếu có.\r\n\r\nCùng với chuyển nhiệm vụ, thủ tục hành chính từ huyện về xã ngay từ 1/7, các địa phương đảm bảo điều kiện làm việc của cơ quan cấp tỉnh và xã sau sáp nhập để hoạt động thông suốt, không gián đoạn công việc gây ảnh hưởng đến hoạt động của cơ quan, tổ chức, người dân, doanh nghiệp.\r\n\r\nCác Ủy viên Bộ Chính trị được phân công theo dõi và đôn đốc việc sáp nhập tỉnh xã, đồng chủ trì cùng bí thư tỉnh ủy, thành ủy xây dựng văn kiện Đại hội Đảng bộ các cấp cũng như phương án nhân sự địa phương. \"Tuyệt đối tránh khuynh hướng, tư tưởng cục bộ địa phương, lợi ích nhóm, tiêu cực\", Bộ Chính trị chỉ đạo.\r\n\r\nĐảng ủy Tổng Liên đoàn Lao động Việt Nam có nhiệm vụ nghiên cứu, sớm hướng dẫn việc kết thúc hoạt động, không lập tổ chức công đoàn trong cơ quan hành chính, lực lượng vũ trang, đơn vị sự nghiệp hưởng 100% lương từ ngân sách nhà nước. Việc này đảm bảo đồng bộ với quá trình sửa đổi, bổ sung Hiến pháp và Luật Công đoàn.\r\n\r\nBan Tổ chức Trung ương sẽ phối hợp với các tỉnh ủy, thành ủy diện sáp nhập hoàn thiện phương án nhân sự địa phương, báo cáo Bộ Chính trị, Ban Bí thư xem xét, quyết định trước 20/6.', '2025-05-26 06:00:18', '2025-05-26 06:00:18'),
(6, 1, 5, 'Ý Nhi thuyết trình \'sách và ước mơ\' tại Miss World', 'https://i1-giaitri.vnecdn.net/2025/05/21/Y-Nhi-1-1747837079-5025-1747838216.jpg?w=1020&h=0&q=100&dpr=1&fit=crop&s=Hk5PsrwqROfD3DLV-Hh4_Q', 'Ấn ĐộÝ Nhi thuyết trình dự án nhân ái, nhấn mạnh giá trị của giáo dục và những trang sách giúp trẻ em chạm đến ước mơ, tại Miss World 2025.\r\n\r\nChiều 21/5, Ý Nhi cùng các thí sinh khu vực châu Á -Thái Bình Dương và châu Âu bước vào vòng thi phụ quan trọng Head To Head Challenge. Cô diện trang phục của nhà thiết kế Hà Thanh Việt theo phong cách thanh lịch.', '2025-05-26 06:02:42', '2025-05-26 06:02:42'),
(7, 1, 1, 'Thời điểm tốt nhất trong ngày để dùng máy sấy', 'https://i1-giadinh.vnecdn.net/2025/05/21/best-time-to-run-dryer-GettyIm-7868-2319-1747781545.jpg?w=1020&h=0&q=100&dpr=1&fit=crop&s=vlwiP_gWimL1owiD_OAmZQ', 'Có thời điểm nào trong ngày tối ưu để sử dụng máy móc sao cho tiết kiệm điện hơn, bảo vệ các thiết bị điện, từ đó giúp bạn bớt tốn tiền?\r\n\r\nChọn giờ để giặt sấy không đơn thuần là thói quen sinh hoạt, còn là bài toán kinh tế, theo các chuyên gia thiết bị gia dụng và năng lượng như Nick Barber, đồng sáng lập công ty điện Utilities Now, Justin Cornforth, chủ sở hữu Ace Home Co và Glenn Lewis, chủ tịch hệ thống sửa chữa Mr. Appliance ở Mỹ.\r\n\r\n\"Máy sấy ngốn rất nhiều điện. Nếu bật cùng lúc với lò nướng, máy rửa bát hay điều hòa đang chạy dễ gây quá tải, ảnh hưởng tới toàn bộ hệ thống điện trong nhà\", chuyên gia cảnh báo.', '2025-05-26 06:07:02', '2025-05-26 06:07:02'),
(8, 1, 1, 'Giá vàng miếng giảm 2 triệu đồng đầu tuần', 'https://i1-kinhdoanh.vnecdn.net/2025/05/26/233a0970-1748229123-6586-1748229143.jpg?w=1020&h=0&q=100&dpr=1&fit=crop&s=L7UW_dyetB2vrj3Je3-Fjw', 'Sau khi giảm một triệu, chiều nay, giá vàng miếng giảm thêm 1 triệu đồng xuống dưới 120 triệu đồng một lượng.\r\n\r\nSáng 26/5, các công ty đã đồng loạt hạ giá vàng. Công ty Vàng bạc Đá quý Sài Gòn (SJC) niêm yết giá vàng miếng tại 117 - 120 triệu đồng, giảm 1 triệu đồng một lượng so với cuối tuần trước. Các ngân hàng quốc doanh, PNJ và Bảo Tín Minh Châu cũng bán mặt hàng này bằng với SJC. Chênh lệch giữa giá mua và giá bán là 3 triệu đồng.\r\n\r\nTrong tuần trước, giá vàng miếng đã tăng 1,7 triệu đồng mỗi lượng.', '2025-05-26 06:07:51', '2025-05-26 06:07:51'),
(9, 1, 4, 'Thông điệp của Nga khi tăng cường dội \'mưa lửa\' xuống Ukraine', 'https://i1-vnexpress.vnecdn.net/2025/05/25/ukraine-463-1748165277-5050-1748166084.jpg?w=1020&h=0&q=100&dpr=1&fit=crop&s=ukzJ7geeC5atyuiZ5jdV4g', 'Nga tập kích thủ đô Ukraine với mức độ khốc liệt chưa từng thấy, dường như nhằm \"ăn miếng trả miếng\" và tăng áp lực với Kiev trước các cuộc đàm phán tiềm năng.\r\n\r\nQuân đội Nga gần đây liên tục thực hiện các cuộc tập kích quy mô lớn vào Ukraine, khi các cuộc đàm phán không có nhiều tiến triển. Đêm 25/5, Nga đã tiến hành cuộc không kích dữ dội, sử dụng 298 máy bay không người lái (UAV) và 69 tên lửa, trong đó có tên lửa đạn đạo Iskander-M, nhằm vào thủ đô Kiev và nhiều thành phố khác của Ukraine.\r\n\r\nNhân chứng mô tả đây là \"địa ngục lửa\", với các vụ nổ làm rung chuyển thành phố Kiev và nhiều thành phố lân cận, ánh sáng từ vụ nổ chiếu sáng bầu trời. Giới chức Ukraine cho biết cuộc tấn công đã khiến ít nhất 12 người thiệt mạng, hàng chục người khác bị thương, trong đó có 3 trẻ em ở Zhytomyr. Nhiều khu vực như Kharkov, Mykolaev, Ternopil chịu ảnh hưởng nghiêm trọng, với cơ sở hạ tầng dân sự, tòa nhà dân cư và ký túc xá đại học bị phá hủy hoặc hư hại.', '2025-05-26 06:19:35', '2025-05-26 06:19:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'nguyễn nhật linh', 'lirrylinh@gmail.com', '$2y$12$zcSe2/IZdNnTgzRjgMpT0.cimSTI3IejDbnf7uWiQjHjoM4MSrQC.', 'admin', '2025-05-26 04:37:47', '2025-05-26 04:37:47'),
(2, 'nguyễn văn A', 'linhnhat31@gmail.com', '$2y$12$3XX8DPcydXMcS0wfbaoxA.dHbabPX.xEJ9wM/nSmPXvIaQbk/alfG', 'user', '2025-05-26 06:10:41', '2025-05-26 06:10:41');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`),
  ADD KEY `posts_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
