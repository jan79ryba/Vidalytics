SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `basket_product` (
  `id` int(11) NOT NULL,
  `basket_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `basket_product` (`id`, `basket_id`, `product_id`) VALUES
(7, 1, 3),
(8, 1, 2),
(9, 2, 1),
(10, 2, 1),
(11, 3, 1),
(12, 3, 2),
(13, 4, 3),
(14, 4, 3),
(15, 4, 1),
(16, 4, 1),
(17, 4, 1);

-- --------------------------------------------------------

CREATE TABLE `delivery` (
  `limit` int(11) NOT NULL,
  `value` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `delivery` (`limit`, `value`) VALUES
(50, 4.95),
(90, 2.95);

-- --------------------------------------------------------

CREATE TABLE `offer` (
  `id` int(11) NOT NULL,
  `code` varchar(3) NOT NULL,
  `amount` int(11) NOT NULL,
  `discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `offer` (`id`, `code`, `amount`, `discount`) VALUES
(1, 'R01', 2, 50);

-- --------------------------------------------------------

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `code` varchar(3) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `product` (`id`, `name`, `code`, `price`) VALUES
(1, 'Red Widget', 'R01', 32.95),
(2, 'Green Widget', 'G01', 24.95),
(3, 'Blue Widget', 'B01', 7.95);

ALTER TABLE `basket_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);


ALTER TABLE `delivery`
  ADD PRIMARY KEY (`limit`);


ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `basket_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;


ALTER TABLE `offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;


ALTER TABLE `basket_product`
  ADD CONSTRAINT `basket_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
