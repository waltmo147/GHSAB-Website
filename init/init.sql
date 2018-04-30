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
  picpath TEXT NOT NULL
);

CREATE TABLE picliason (
  member INTEGER NOT NULL,
  picture INTEGER NOT NULL,
  FOREIGN KEY (member) REFERENCES members(id) ON DELETE CASCADE,
  FOREIGN KEY (picture) REFERENCES member_images(id) ON DELETE CASCADE
);

CREATE TABLE events (
  id INTEGER PRIMARY KEY NOT NULL,
  name TEXT,
  date_time  TEXT,
  address TEXT,
  description TEXT,
  image TEXT
);

CREATE TABLE application (
  id INTEGER PRIMARY KEY NOT NULL,
  event_id TEXT NOT NULL,
  email  TEXT NOT NULL,
  comment TEXT
);
CREATE TABLE blogs (
  id INTEGER PRIMARY KEY NOT NULL,
  title TEXT UNIQUE NOT NULL,
  blog TEXT NOT NULL,
  author TEXT
);
/* members data */
INSERT INTO members (first_name,last_name,introduction,email) VALUES ('michael', 'schrute','admin is the president of the club.....etc','admin@cornell.edu');
INSERT INTO members (first_name,last_name,introduction,email) VALUES ('james', 'Bond','James Bond is the muscle of the club.....etc','admin3@cornell.edu');
/*member images data*/
INSERT INTO member_images (image_name,picpath) VALUES ('admin_pic','uploads/pictures/camel.jpg');
INSERT INTO member_images (image_name,picpath) VALUES ('james_pic','uploads/pictures/felted-sheep.jpg');

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


INSERT INTO blogs (title, blog, author) VALUES ('Cornell Health', 'This is a sample blog post that should be deleted and then replaced. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae finibus urna, ut cursus turpis. Aenean vel nulla vel sem suscipit consequat. Nullam venenatis est vel felis varius ullamcorper. Ut quis orci rhoncus, porttitor quam ac, auctor nisi. Quisque feugiat rhoncus ipsum, sit amet lobortis felis iaculis in. Nulla tempus ac elit nec ultricies. Donec aliquet orci ac enim laoreet, vel sagittis augue venenatis. Integer auctor iaculis nulla, sed elementum velit dapibus id. Maecenas quis posuere enim. In odio ex, rhoncus non leo ac, accumsan faucibus neque.

Fusce nec turpis ultrices, bibendum lorem eget, tincidunt ante. Suspendisse potenti. Nam ut libero tristique, dignissim quam sed, eleifend nunc. Proin consectetur, ipsum vel commodo euismod, lectus felis egestas quam, id facilisis dui ipsum non purus. Etiam congue in risus id scelerisque. Etiam eget leo et mauris porta tempus. Quisque vulputate, sapien vehicula aliquam tempor, enim nisi efficitur purus, eu bibendum eros mi id augue. Nunc egestas ipsum vitae sodales dapibus. Praesent consectetur venenatis nunc, euismod feugiat tellus dictum ac. Aenean at eros eget augue ultricies posuere in eu felis. Curabitur congue a velit ut porta. Fusce auctor vehicula est, ut tristique lacus pellentesque et.', 'Ezra Cornell');
INSERT INTO blogs (title, blog, author) VALUES ('World Health', 'This is a sample post and should be deleted and then replaced. Vestibulum placerat libero et congue facilisis. Nulla tristique posuere sagittis. Fusce aliquet mollis odio, vel lobortis magna fermentum a. Vestibulum quis justo et ipsum imperdiet pharetra. Nam vel tincidunt nibh. Ut tempor, erat et ornare ornare, libero eros tristique risus, ut porttitor nulla ligula nec sem. Fusce dignissim dolor libero, id bibendum dolor dignissim eget.

Suspendisse id molestie velit. Donec faucibus interdum finibus. Nullam ac varius eros. Nunc aliquet placerat sapien a aliquet. Pellentesque porttitor a dui sed tincidunt. Quisque orci ipsum, facilisis laoreet volutpat aliquet, finibus et velit. Aenean bibendum imperdiet odio, sit amet tristique est congue non. Praesent molestie augue dolor. Integer erat elit, laoreet in consequat vitae, vulputate sit amet nulla. In quam est, ultricies vitae leo at, lacinia feugiat velit.

Nulla sed fringilla eros. Vestibulum dignissim dolor ac arcu porta, vel accumsan libero ullamcorper. In ornare, felis a faucibus facilisis, eros arcu interdum nisi, sit amet lobortis eros tellus eget leo. Etiam ac vulputate dolor. Vivamus vel sollicitudin tellus. Integer volutpat velit justo, vel finibus metus aliquet id. Integer eu magna pellentesque, tincidunt enim et, iaculis quam. Proin facilisis ante at urna mollis, et hendrerit erat cursus. Suspendisse potenti. Ut non congue nisi. Nullam euismod suscipit dignissim. Proin sagittis libero id sem molestie, cursus rhoncus quam dictum. Nunc auctor magna suscipit commodo sollicitudin. Integer malesuada congue mollis.', 'A.D. White');
