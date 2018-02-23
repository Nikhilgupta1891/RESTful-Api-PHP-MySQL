SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Table structure for `users` table
CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `user_first_name` varchar(255) NOT NULL,
  `user_last_name` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dump data for table `users`
INSERT INTO `users` (`user_id`, `user_first_name`, `user_last_name`, `user_address`) VALUES
(1, 'Nikhil', 'Gupta', '619-373-6975', 'nikhilgupta1891@test.com', '33 Birch Rd'),
(3, 'Kirti', 'Gupta', '619-930-0895', 'kirtigupta@test.com', '333 South st');

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;