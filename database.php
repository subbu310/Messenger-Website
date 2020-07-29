
--
-- Database: `new_messenger`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `user_image` varchar(250) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `user_image`, `email`, `password`, `date`) VALUES
(1, 'virat kholi', 'http://localhost/new_messenger/ProfileImage/69.jpg', 'virat@gmail.com', '12345', '2020-07-16 10:15:20'),
(2, 'dhoni', 'http://localhost/new_messenger/ProfileImage/68.jpg', 'dhoni@yahoo.com', 'password', '2020-07-17 09:55:15'),
(3, 'rohit', 'http://localhost/new_messenger/ProfileImage/15.jpg', 'rohit@gmail.com', '12345', '2020-07-20 03:17:16'),
(4, 'umesh', 'http://localhost/new_messenger/ProfileImage/443.jpg', 'umesh@yahoo.com', '12345', '2020-07-20 03:25:33'),
(5, 'kuldeep', 'http://localhost/new_messenger/ProfileImage/4247.png', 'kuldeep@yahoo.com', 'password', '2020-07-20 03:26:09'),
(6, 'hartik', 'http://localhost/new_messenger/ProfileImage/four.jpg', 'hartik@gmail.com', '12345', '2020-07-20 03:10:49');

-- --------------------------------------------------------

--
-- Table structure for table `user_chat`
--

CREATE TABLE `user_chat` (
  `id` int(11) NOT NULL,
  `sender_id` varchar(150) NOT NULL,
  `receiver_id` varchar(150) NOT NULL,
  `chat_message` varchar(250) NOT NULL,
  `chat_image` varchar(250) NOT NULL,
  `type` varchar(150) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_chat`
--

INSERT INTO `user_chat` (`id`, `sender_id`, `receiver_id`, `chat_message`, `chat_image`, `type`, `date`) VALUES
(1, '1', '2', 'hi', '', 'text', '2020-07-25 03:19:40'),
(2, '1', '4', '', 'http://localhost/new_messenger/chatPost/IMG_20190127_231349_585.jpg', 'image', '2020-07-25 03:19:52'),
(3, '1', '3', '🍎❤🏆', '', 'emoji', '2020-07-25 03:20:03'),
(4, '1', '3', 'hello rohit hw r u?', '', 'text', '2020-07-25 03:29:42'),
(5, '1', '3', '', 'http://localhost/new_messenger/chatPost/images.jpg', 'image', '2020-07-25 03:29:51'),
(6, '1', '3', 'r u fine?', '', 'text', '2020-07-25 03:29:59'),
(7, '3', '1', 'yes am fine❤', '', 'text', '2020-07-25 03:30:58'),
(8, '3', '1', '', 'http://localhost/new_messenger/chatPost/images (8).jpg', 'image', '2020-07-25 03:31:10'),
(9, '3', '1', '🏆🏆🏆🏆❤❤❤', '', 'emoji', '2020-07-25 03:31:25'),
(10, '3', '5', 'hello kulpeep?', '', 'text', '2020-07-25 03:37:47'),
(11, '3', '4', 'hi umesh what r u doing..', '', 'text', '2020-07-25 03:38:12'),
(12, '3', '2', '', 'http://localhost/new_messenger/chatPost/images (4).jpg', 'image', '2020-07-25 03:38:21'),
(13, '3', '6', 'hello hartik 😍😍😍😍', '', 'text', '2020-07-25 03:38:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_chat`
--
ALTER TABLE `user_chat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_chat`
--
ALTER TABLE `user_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
