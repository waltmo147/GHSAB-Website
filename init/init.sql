CREATE TABLE admin (
  admin_id INTEGER PRIMARY KEY NOT NULL,
  username TEXT NOT NULL UNIQUE,
  password TEXT NOT NULL,
  session TEXT
);

CREATE TABLE members (
	id	INTEGER PRIMARY KEY NOT NULL,
	first_name	TEXT NOT NULL,
	last_name	TEXT NOT NULL,
	introduction	TEXT NOT NULL,
  email TEXT
);

CREATE TABLE slideshow (
  id INTEGER NOT NULL PRIMARY KEY,
  picpath TEXT NOT NULL UNIQUE,
  title TEXT NOT NULL);

CREATE TABLE member_images (
  id INTEGER PRIMARY KEY NOT NULL,
  image_name TEXT NOT NULL UNIQUE,
  file_ext TEXT NOT NULL
);

CREATE TABLE picliason (
  member INTEGER NOT NULL,
  picture INTEGER NOT NULL,
  FOREIGN KEY (member) REFERENCES members(id) ON DELETE CASCADE,
  FOREIGN KEY (picture) REFERENCES member_images(id) ON DELETE CASCADE
);

CREATE TABLE events (
  id INTEGER PRIMARY KEY NOT NULL,
  name TEXT NOT NULL,
  date_time  TEXT NOT NULL,
  address TEXT NOT NULL,
  description TEXT NOT NULL,
  image TEXT
);

CREATE TABLE application (
  id INTEGER PRIMARY KEY NOT NULL,
  event_id TEXT NOT NULL,
  email  TEXT NOT NULL,
  comment TEXT
);

/* members data */
INSERT INTO members (first_name,last_name,introduction,email) VALUES ('michael', 'schrute','admin is the president of the club.....etc','admin@cornell.edu');
INSERT INTO members (first_name,last_name,introduction,email) VALUES ('james', 'Bond','James Bond is the muscle of the club.....etc','admin3@cornell.edu');
/*member images data*/
INSERT INTO member_images (image_name,file_ext) VALUES ('admin_pic','png');
INSERT INTO member_images (image_name,file_ext) VALUES ('james_pic','png');

INSERT INTO picliason (member, picture) VALUES ((SELECT id FROM members WHERE first_name = 'michael'),(SELECT id FROM member_images WHERE image_name = 'admin_pic'));
INSERT INTO picliason (member, picture) VALUES ((SELECT id FROM members WHERE first_name = 'james'),(SELECT id FROM member_images WHERE image_name = 'james_pic'));

-- password is "good" for user 'admin'
INSERT INTO admin (username, password) VALUES ('admin', '$2y$10$i41U0Al7AUAQFIAeoi0NH.1Aykum/Hf3vScM.zt1pQKcKHDSPlm0e');

-- seed data for slideshow
INSERT INTO slideshow (picpath, title) VALUES ('uploads/pictures/bald-eagle.jpg', "Bald Eagle");
INSERT INTO slideshow (picpath, title) VALUES ('uploads/pictures/bald-eagle-1.jpg', "Bald Eagle");
INSERT INTO slideshow (picpath, title) VALUES ('uploads/pictures/bird.jpg', "Bird");
INSERT INTO slideshow (picpath, title) VALUES ('uploads/pictures/blackbirds.jpg', "BlackBirds");

INSERT INTO events (name, date_time, address, description) values ('Cornell Ochestra', '2018-04-29 15:00:00', 'Bailey Hall', 'Tchaikovsky');
INSERT INTO application (event_id, email, comment) values ((SELECT id FROM events where name is 'Cornell Ochestra'), 'jg2273@cornell.edu', 'Is is for free?');
