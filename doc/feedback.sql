CREATE TABLE `feedback` (
  `user` VARCHAR(20) NOT NULL,
  `feedback` VARCHAR(300) NOT NULL,
  `giver` VARCHAR(20) NOT NULL,
  `time` TIMESTAMP NOT NULL
);
