DROP TABLE IF EXISTS message_board;
CREATE TABLE `message_board` (
  `user` VARCHAR(20) NOT NULL,
  `time` TIMESTAMP NOT NULL,
  `msg` VARCHAR(500) NOT NULL
);
