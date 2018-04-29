/* TODO: create tables */
CREATE TABLE admin (
  admin_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  username TEXT NOT NULL UNIQUE,
  password TEXT NOT NULL,
  session TEXT
);



CREATE TABLE `members` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`first_name`	TEXT NOT NULL,
	`last_name`	TEXT NOT NULL,
	`introduction`	TEXT NOT NULL,
  `email` TEXT,
  `photo_id` INTEGER NOT NULL
);

CREATE TABLE slideshow (
  id INTEGER NOT NULL PRIMARY KEY UNIQUE,
  picpath TEXT NOT NULL UNIQUE,
  title TEXT NOT NULL);
)
/* TODO: initial seed data */
/* members data */

-- password is "good" for user 'admin'
INSERT INTO admin (admin_id, username, password, session) VALUES (0, 'admin', '$2y$10$i41U0Al7AUAQFIAeoi0NH.1Aykum/Hf3vScM.zt1pQKcKHDSPlm0e', 'NULL');
