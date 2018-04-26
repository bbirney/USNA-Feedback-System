DROP TABLE IF EXISTS feedback;
CREATE TABLE `feedback` (
  `user` VARCHAR(20) NOT NULL,
  `do_well` VARCHAR(500) NOT NULL,
  `improve` VARCHAR(500) NOT NULL,
  `giver` VARCHAR(20) NOT NULL,
  `status` INT NOT NULL DEFAULT 2,
  `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `know` INT NOT NULL,
  `id` INT NOT NULL IDENTITY PRIMARY KEY
);

DROP TABLE IF EXISTS feedback_id;
CREATE TABLE `feedback_id` (
  `id` INT NOT NULL PRIMARY KEY,
  `approval` INT NOT NULL DEFAULT 42
);
