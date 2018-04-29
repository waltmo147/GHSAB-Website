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
CREATE TABLE `member_images` (
  `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  `image_name` TEXT NOT NULL UNIQUE,
  `file_ext` TEXT NOT NULL,
  `member_id` INTEGER NOT NULL
);
/* TODO: initial seed data */
/* members data */
INSERT INTO members(id,first_name,last_name,introduction,email,photo_id) VALUES (1,'michael', 'schrute','admin is the president of the club.....etc','admin@cornell.edu',1);
INSERT INTO members(id,first_name,last_name,introduction,email,photo_id) VALUES (2,'james', 'Bond','James Bond is the muscle of the club.....etc','admin3@cornell.edu',2);
/*member images data*/
INSERT INTO member_images(image_name,file_ext,member_id) VALUES ('admin_pic','png',1);
INSERT INTO member_images(image_name,file_ext,member_id) VALUES ('james_pic','png',2);
-- password is "good" for user 'admin'
INSERT INTO admin (admin_id, username, password, session) VALUES (0, 'admin', '$2y$10$i41U0Al7AUAQFIAeoi0NH.1Aykum/Hf3vScM.zt1pQKcKHDSPlm0e', 'NULL');
