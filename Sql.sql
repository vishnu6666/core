+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
SQL Querys
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `varchar` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=active, 1=inactive',
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `text` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `int` int(11) DEFAULT NULL,
  `float` float(10,2) DEFAULT NULL,
  `decimal` decimal(10,2) DEFAULT NULL,
  `enum` enum('1','2','3') DEFAULT NULL,
  `set` set('1','2','3') DEFAULT NULL
);

ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


INSERT INTO `test` (`id`, `varchar`, `status`, `created_date`, `updated_date`, `text`, `date`, `int`, `float`, `decimal`, `enum`, `set`) VALUES
(3, 'this is test for var', 0, '2019-11-26 00:00:00', '2019-11-26 13:36:01', 'this is text fild for test.', '2019-11-27', 55, 55555.56, '555555.00', '2', '1,2'),
(4, NULL, 0, NULL, '2019-11-26 13:37:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

