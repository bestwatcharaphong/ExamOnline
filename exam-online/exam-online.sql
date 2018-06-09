-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2017 at 07:46 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam-online`
--

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `enroll` (
  `enroll_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `subject_id` varchar(20) NOT NULL,
  `enroll_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`enroll_id`, `user_id`, `subject_id`, `enroll_date`) VALUES
(1, '12345671', 'ICT-377', '2017-04-04'),
(2, '12345671', 'ICT60-111', '2017-09-14'),
(3, '12345678', 'ICT60-111', '2017-09-14'),
(4, '12345678', 'ENG-110', '2017-09-14'),
(5, '12345678', 'ICT-377', '2017-09-14'),
(6, '12345678', 'MAT-114', '2017-09-14'),
(7, '12345678', 'SRE-100', '2017-09-14'),
(8, '12345672', 'ICT-377', '2017-04-04'),
(9, '12345673', 'ICT-377', '2017-04-04'),
(10, '12345674', 'ICT-377', '2017-04-04'),
(11, '12345675', 'ICT-377', '2017-04-04'),
(12, '12345676', 'ICT-377', '2017-04-04'),
(13, '12345677', 'ICT-377', '2017-04-04');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `exam_id` int(20) NOT NULL,
  `question` varchar(1000) NOT NULL,
  `choice1` varchar(1000) NOT NULL,
  `choice2` varchar(1000) NOT NULL,
  `choice3` varchar(1000) NOT NULL,
  `choice4` varchar(1000) NOT NULL,
  `choice5` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `answer_key` int(1) NOT NULL,
  `date` date NOT NULL,
  `set_id` int(11) NOT NULL COMMENT 'รหัสชุดข้อสอบ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_id`, `question`, `choice1`, `choice2`, `choice3`, `choice4`, `choice5`, `answer_key`, `date`, `set_id`) VALUES
(1, 'จงอ่านบทความที่กำหนดให้\r\n\r\nศาลเป็นสถาบันหนึ่งที่จะช่วยแก้ไข และบรรเทาความเดือดร้อนอันเกิดจากการไม่ได้รับความเป็นธรรมแต่การให้ความเป็นธรรมของศาลนั้นจะต้องอยู่ภายใต้ขอบข่ายของกฎหมาย ศาลจะต้องพิจารณาพิพากษาคดีไปตามพยานหลักฐาน ในสำนวนศาลจะนำข้อเท็จจริงนอกสำนวนมาพิจารณามิได้ ในคดีอาญานั้นเป็นหน้าที่ของโจทก์ที่จะต้องนำสืบพิสูจน์ความผิดของจำเลย หากมีความสงสัยตามสมควรว่าจำเลยได้กระทำผิดหรือไม่ ศาลก็ต้องยกประโยชน์แห่งความสงสัยให้จำเลย ส่วนในคดีแพ่งนั้น โดยหลักทั่วไปแล้ว ฝ่ายใดกล่าวอ้างข้อเท็จจริงขึ้นมา ฝ่ายนั้นก็มีหน้าที่นำสืบพิสูจน์ดังที่กล่าวอ้างมิได้ย่อมจะแพ้ในเรื่องนั้นไป\r\n\r\nสาระสำคัญของบทความนี้กล่าวถึงศาลในเรื่องใด', 'หน้าที่', 'อำนาจ', 'วิธีการนำสืบพิสูจน์ความผิด', 'จรรยาบรรณ', 'ทดสอบตัวเลือก 5 ทดสอบตัวเลือก 5 ทดสอบตัวเลือก 5', 5, '2017-08-20', 1),
(2, 'จงอ่านบทความที่กำหนดให้\n\nศาลเป็นสถาบันหนึ่งที่จะช่วยแก้ไข และบรรเทาความเดือดร้อนอันเกิดจากการไม่ได้รับความเป็นธรรมแต่การให้ความเป็นธรรมของศาลนั้นจะต้องอยู่ภายใต้ขอบข่ายของกฎหมาย ศาลจะต้องพิจารณาพิพากษาคดีไปตามพยานหลักฐาน ในสำนวนศาลจะนำข้อเท็จจริงนอกสำนวนมาพิจารณามิได้ ในคดีอาญานั้นเป็นหน้าที่ของโจทก์ที่จะต้องนำสืบพิสูจน์ความผิดของจำเลย หากมีความสงสัยตามสมควรว่าจำเลยได้กระทำผิดหรือไม่ ศาลก็ต้องยกประโยชน์แห่งความสงสัยให้จำเลย ส่วนในคดีแพ่งนั้น โดยหลักทั่วไปแล้ว ฝ่ายใดกล่าวอ้างข้อเท็จจริงขึ้นมา ฝ่ายนั้นก็มีหน้าที่นำสืบพิสูจน์ดังที่กล่าวอ้างมิได้ย่อมจะแพ้ในเรื่องนั้นไป\n\n"หากมีข้อสงสัยตามสมควรว่าจำเลยได้กระทำผิดหรือไม่" ข้อความนี้หมายความว่าอย่างไร', 'แม้เข้าใจว่าจำเลยกระทำผิด', 'หากเชื่อว่าจำเลยไม่ได้กระทำผิด ', 'หากพิสูจน์ไม่ได้ว่าจำเลยกระทำผิด', 'แม้แน่ใจว่าจำเลยไม่ได้กระทำผิด', '', 4, '2017-08-01', 2),
(3, 'The employees __________ about the closure before the announcement was made public.', 'know', 'known', 'knew', 'have known', '', 3, '2017-08-20', 3),
(4, '__________ it was a holiday, the doctor performed the emergency surgery on the heart patient.', 'During', 'Even', 'Although', 'So', '', 3, '2017-08-20', 3),
(5, 'I cannot understand why she did that, it really  (doesn''t add up).', 'doesn''t calculate', 'isn''t mathematics', 'doesn''t make sense', 'makes the wrong addition', '', 3, '2017-08-22', 2),
(6, 'จงพิจารณาข้อความในตัวเลือก 1 ถึง 4 และจัดเรียงลำดับให้ถูกต้องแล้วจึงตอบคำถามข้อความใดเป็นลำดับที่ 3', 'ทำให้รถยนต์ราคาถูกลง', 'และคงจะถูกลงกว่านี้อีก', 'เพราะนโยบายเศรษฐกิจเสรี       ', 'เมื่อมีการแข่งขันในระบบเศรษฐกิจมากขึ้น', '', 1, '2017-08-24', 1),
(7, '13   9   3   15   25   5   17   49   7   19   81   9   21 ...', '11', '23', '121', '441', '', 4, '2017-09-06', 6),
(8, 'ซื้อเครื่องใช้ชิ้นหนึ่งราคา 2,550 บาท ถ้าต้องการขายให้ได้กำไรร้อยละ 30 จะต้องขายเครื่องใช้ชิ้นนี้ไปในราคากี่บาท', '1,785', '3,315', '4,115', '5,425', '', 2, '2017-09-06', 6),
(9, 'ถ้า x > y และ m เป็นเลขจำนวนเต็มที่มีค่ามากกว่าศูนย์ อยากทราบว่าข้อใดต่อไปนี้ไม่เป็นความจริง', 'mx < my', 'mx > my', '(x + m) > (y + m)', '(x – m) >(y – m)', '', 1, '2017-08-24', 1),
(10, 'เงื่อนไข\n\n- พีระพล กุลวิทย์ และอิทธิ เลือกซื้อขนมมารับประทานคนละ 2 ชนิด ไม่ซ้ำกัน\n- ขนมที่ทั้งห้าคนซื้อได้แก่ ทองหยอด ถั่วตัด ฝอยทอง และ ข้าวตู ทั้งนี้ชื่อคนและขนมไม่ได้เรียงกันตามลำดับข้างต้น\n- กุลวิทย์ไม่ได้ซื้อฝอยทองและข้าวตู\n- อิทธิซื้อขนมไม่เหมือนกับกุลวิทย์เลย\n- มีคนซื้อทองหยอดเพียงคนเดียว\n- ขนมอย่างหนึ่งที่พีระพลซื้อคือ ข้าวตู\n\nข้อสรุปใดถูกต้อง', 'กุลวิทย์ซื้อทองหยอด', 'อิทธิไม่ได้ซื้อถั่วตัด', 'พีระพลซื้อทองหยอด', 'มีคนซื้อฝอยทองเพียงคนเดียว', '', 1, '2017-08-24', 1),
(11, 'ถ้า A > B = C < D และ E ≤ C < F ≤ G ทุกตัวแปรมีค่ามากกว่าศูนย์ \nข้อใดสรุปถูกต้อง', 'G > C', 'C < A', 'F < E', 'B > G', '', 1, '2017-08-24', 4),
(12, '"บลูทูธ (Bluetooth) คือ คลื่นสัญญาณวิทยุชนิดหนึ่งที่ทำให้อุปกรณ์ไอทีต่าง ๆ เช่น โทรศัพท์มือถือ คอมพิวเตอร์ หรือพีดีเอ ให้สามารถเชื่อมต่อข้อมูลถึงกันได้โดยมีรัศมีการส่งข้อมูลอยู่ในระยะประมาณ 10 เมตร" ข้อใดสอดคล้องกับข้อความข้างต้น', 'อุปกรณ์ไอทีที่ใช้กันส่วนใหญ่มีบลูทูธ', 'ถ้าอุปกรณ์ไอทีใดสามารถเชื่อมต่อข้อมูลกันได้ แสดงว่าอุปกรณ์ไอทีนั้นมีบลูทูธ', 'ถ้าอุปกรณ์ไอทีใดไม่มีบลูทูธแล้ว อุปกรณ์ไอทีนั้นจะไม่สามารถเชื่อมต่อข้อมูลถึงกันได้', 'คลื่นสัญญาณวิทยุชนิดหนึ่งที่ทำให้อุปกรณ์ไอทีสามารถเชื่อมต่อข้อมูลถึงกันได้คือ บลูทูธ', '', 1, '2017-08-24', 4),
(13, '"การสนองคุณชาตินั้น หาได้จำกัดเฉพาะการรับราชการไม่ ขอเพียงให้กลับมารับใช้ชาติก็พอ จึงมีการกำหนดเพียงเป็นกรอบกว้าง ๆ ว่า ให้นักเรียนทุนเล่าเรียนหลวงกลับเข้ามาทำงานในประเทศ อย่างน้อยเท่ากับจำนวนปีที่ไปเล่าเรียนมา" สาเหตุสำคัญของข้อความนี้เกี่ยวข้องกับนักเรียนทุนเล่าเรียนหลวงในเรื่องใด', 'สิทธิ', 'เงื่อนไข', 'โอกาส', 'ข้อจำกัด', '', 1, '2017-08-24', 4),
(14, '"การให้การศึกษาแก่ประชาชนเพื่อให้มีความรู้ความสามารถเป็นการลงทุนที่สำคัญที่สุดในการพัฒนาบุคลากรของประเทศ ซึ่งจะส่งผลไปถึงการพัฒนาประเทศในที่สุด" ข้อความนี้สรุปว่าอย่างไร', 'การศึกษามีผลต่อการพัฒนาประเทศโดยทันที ', 'การพัฒนาบุคลากรเป็นผลมาจากการพัฒนาประเทศ', ' การพัฒนาบุคคลและการพัฒนาประเทศมีความสำคัญเท่า ๆ กัน ', 'จุดมุ่งหมายของการศึกษาคือการพัฒนาบุคลากรเพื่อไปพัฒนาประเทศ ', '', 1, '2017-09-07', 5),
(15, 'ถ้าไม่มีใครทำอะไร เพื่อลดความ.........ลง ก็ไม่มีข้อสงสัยว่า ผลสุดท้ายจะไม่ใช้อาวุธกัน', 'เคร่งเครียด', 'เข้มงวด ', 'เคร่งครัด', 'ตึงเครียด', '', 1, '2017-09-07', 5),
(16, 'การออมทรัพย์ไว้เป็นทองคำ อาจเป็นวิธีที่ฉลาดก็ได้ ถ้าผู้ออมทรัพย์สามารถคาดหมาย.........ได้ เพราะไม่มีกฎเกณฑ์แน่นอนว่า มีเงินอยู่แล้วจะเอาไปทำอะไรจึงจะดีที่สุด และเมื่อใดควรออมทรัพย์ไว้ในรูปแบบใด หรือลงทุนในรูปแบบใด', 'ราคา', 'ตลาด', 'เหตุการณ์', 'ความนิยม', '', 1, '2017-09-07', 6),
(17, 'คน : อาหาร : : ? : ?', 'ต้นไม้   ปุ๋ย', 'ดิน   หญ้า', 'น้ำ   ราก', 'ใบ   กิ่ง', '', 1, '2017-09-07', 6),
(18, 'เต้าเจี้ยว : ถั่วเหลือง : : ? : ?', 'ข้าว   เกลือ ', 'น้ำเชื่อม   น้ำตาล ', 'นม   ขนม', 'น้ำปลา   ซีอิ๊ว', '', 1, '2017-09-07', 6),
(19, 'สะใภ้ : พี่ : : ? : ?', 'ย่า   ปู่', 'อา   เขย', 'ลุง   พ่อ', 'ป้า   หลาน ', '', 1, '2017-09-06', 2),
(20, '"ผิวของคนเราแตกต่างกัน จึงต้องการการดูแลที่แตกต่าง การเลือกใช้ผลิตภัณฑ์ที่เหมาะกับผิวมีความสำคัญอย่างมากในการช่วยยืดอายุผิวและความงามให้อยู่กับคุณอย่างยาวนาน" ข้อใดสอดคล้องกับข้อความข้างต้น', 'ผิวของคนเราต้องการการดูแลที่แตกต่างกัน เพราะ ผิวของคนเรามีความแตกต่างกัน ', 'เพราะผิวของคนเราต้องการการดูแลที่ต่างกัน ดังนั้นผิวของคนเราจึงแตกต่างกัน', 'ถ้าผู้ใดใช้ผลิตภัณฑ์ที่ไม่เหมาะกับผิว ผิวของผู้นั้นก็จะไม่สวยงาม', 'ถ้าผู้ใดมีผิวที่สวยงาม แสดงว่าผู้นั้นใช้ผลิตภัณฑ์ที่เหมาะกับผิว ', '', 1, '2017-09-06', 6);

-- --------------------------------------------------------

--
-- Table structure for table `exam_set`
--

CREATE TABLE `exam_set` (
  `set_id` int(11) NOT NULL,
  `set_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `set_date` date NOT NULL,
  `set_time` int(11) NOT NULL COMMENT 'เวลาในการทำข้อสอบ',
  `subject_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `full_score` int(11) NOT NULL,
  `amount_choice` int(1) NOT NULL,
  `activeflag` int(1) NOT NULL COMMENT 'การเปิด-ปิดให้ทำข้อสอบได้'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `exam_set`
--

INSERT INTO `exam_set` (`set_id`, `set_name`, `set_date`, `set_time`, `subject_id`, `full_score`, `amount_choice`, `activeflag`) VALUES
(1, 'ทดสอบก่อนเรียน', '2017-08-01', 20, 'ICT-377', 4, 5, 1),
(2, 'Lecture 1', '2017-08-25', 45, 'ICT-377', 3, 5, 1),
(3, 'ทดสอบ 1', '2017-08-28', 60, 'ENG-110', 2, 4, 0),
(4, 'ทดสอบหลังเรียน', '2017-08-31', 120, 'ICT-377', 3, 4, 0),
(5, 'Lecture 2', '2017-08-28', 180, 'ICT-377', 2, 4, 1),
(6, 'Lab 1', '2017-08-24', 50, 'ICT60-111', 6, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `score_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `set_id` int(11) NOT NULL COMMENT 'รหัสชุดข้อสอบ',
  `score_date_time` datetime NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางคะแนน';

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`score_id`, `user_id`, `set_id`, `score_date_time`, `score`) VALUES
(1, '12345671', 1, '2017-09-06 06:14:21', 2),
(6, '12345671', 6, '2017-09-10 07:12:47', 1),
(11, '12345678', 1, '2017-09-11 13:16:32', 2),
(13, '12345678', 2, '2017-09-13 16:28:24', 3),
(15, '12345678', 3, '2017-09-14 17:53:23', 2),
(16, '12345678', 4, '2017-09-15 09:15:44', 1),
(18, '12345678', 5, '2017-09-17 00:00:00', 0),
(19, '12345678', 6, '2017-09-18 20:18:48', 4),
(20, '12345672', 1, '2017-09-11 13:16:32', 3),
(21, '12345673', 1, '2017-09-11 13:16:32', 3),
(22, '12345674', 1, '2017-09-11 20:50:32', 4),
(23, '12345675', 1, '2017-09-11 23:52:32', 1),
(24, '12345676', 1, '2017-09-11 23:52:32', 2),
(25, '12345677', 1, '2017-09-11 23:52:32', 3);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` varchar(20) NOT NULL,
  `subject_name` varchar(200) NOT NULL,
  `instructor_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `subject_name`, `instructor_id`) VALUES
('ENG-110', 'English in Sciences and Technology', '1234567891'),
('ICT-377', 'Information Technology Entrepreneurship', '1234567890'),
('ICT60-111', 'Documentation Management and Data Processing', '1234567890'),
('MAT-114', 'Applied Statistics', '1234567892'),
('SRE-100', 'Sports, Recreation and Exercise for Health', '1234567892');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(50) NOT NULL,
  `fname` varchar(150) NOT NULL,
  `lname` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `password_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fname`, `lname`, `email`, `password`, `password_token`, `role`) VALUES
('11111', 'Bill', 'Gates', 'a@b.com', 'ef114e5fdeb89a3ffa62eaad0abafac412cadc02c2610904843ca42184e79e5c', '', 0),
('12345670', 'ไอริน', 'แสงสว่าง', 'treeanut.22@gmail.com', 'ef114e5fdeb89a3ffa62eaad0abafac412cadc02c2610904843ca42184e79e5c', '', 2),
('12345671', 'อารียา', 'สูงค่า', 'suwannawangpol@gmail.com', 'ef114e5fdeb89a3ffa62eaad0abafac412cadc02c2610904843ca42184e79e5c', '', 2),
('12345672', 'ดาริน', 'ดีเยี่ยม', 'a@b.com', 'ef114e5fdeb89a3ffa62eaad0abafac412cadc02c2610904843ca42184e79e5c', '', 2),
('12345673', 'เกวลิน', 'บริสุทธิ์', 'a@b.com', 'ef114e5fdeb89a3ffa62eaad0abafac412cadc02c2610904843ca42184e79e5c', '', 2),
('12345674', 'มาริสา', 'นุ่มนวล', 'c@d.com', 'ef114e5fdeb89a3ffa62eaad0abafac412cadc02c2610904843ca42184e79e5c', '', 2),
('12345675', 'โรสลิน', 'ดอกกุหลาบ', 'c@d.com', 'ef114e5fdeb89a3ffa62eaad0abafac412cadc02c2610904843ca42184e79e5c', '', 2),
('12345676', 'แสนดี', 'ผู้พิทักษ์', 'c@d.com', 'ef114e5fdeb89a3ffa62eaad0abafac412cadc02c2610904843ca42184e79e5c', '', 2),
('12345677', 'ขยัน', 'หมั่นเพียร', 'c@d.com', 'ef114e5fdeb89a3ffa62eaad0abafac412cadc02c2610904843ca42184e79e5c', '', 2),
('12345678', 'รักเรียน', 'เรียนดี', 'c@d.com', 'ef114e5fdeb89a3ffa62eaad0abafac412cadc02c2610904843ca42184e79e5c', '', 2),
('1234567890', 'สมชาย', 'สอนดี', 'a@b.com', 'ef114e5fdeb89a3ffa62eaad0abafac412cadc02c2610904843ca42184e79e5c', '', 1),
('1234567891', 'Vin', 'Diesel', 'a@b.com', 'ef114e5fdeb89a3ffa62eaad0abafac412cadc02c2610904843ca42184e79e5c', '', 1),
('1234567892', 'Arnold', 'Schwarzenegger', 'a@b.com', 'ef114e5fdeb89a3ffa62eaad0abafac412cadc02c2610904843ca42184e79e5c', '', 1),
('1234567893', 'Huge', 'Jackman', 'a@b.com', 'ef114e5fdeb89a3ffa62eaad0abafac412cadc02c2610904843ca42184e79e5c', '', 1),
('1234567894', 'Leonardo', 'Dicaprio', 'a@b.com', 'ef114e5fdeb89a3ffa62eaad0abafac412cadc02c2610904843ca42184e79e5c', '', 1),
('1234567895', 'Sophie', 'Turner', 'a@b.com', 'ef114e5fdeb89a3ffa62eaad0abafac412cadc02c2610904843ca42184e79e5c', '', 1),
('1234567896', 'Angelina', 'Jolie', 'a@b.com', 'ef114e5fdeb89a3ffa62eaad0abafac412cadc02c2610904843ca42184e79e5c', '', 1),
('1234567897', 'Emmanuelle', 'Chriqui', 'a@b.com', 'ef114e5fdeb89a3ffa62eaad0abafac412cadc02c2610904843ca42184e79e5c', '', 1),
('1234567898', 'Gal', 'Gadot', 'a@b.com', 'ef114e5fdeb89a3ffa62eaad0abafac412cadc02c2610904843ca42184e79e5c', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `enroll`
--
ALTER TABLE `enroll`
  ADD PRIMARY KEY (`enroll_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `exam_set`
--
ALTER TABLE `exam_set`
  ADD PRIMARY KEY (`set_id`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`score_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enroll`
--
ALTER TABLE `enroll`
  MODIFY `enroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `exam_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `exam_set`
--
ALTER TABLE `exam_set`
  MODIFY `set_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `score`
--
ALTER TABLE `score`
  MODIFY `score_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
