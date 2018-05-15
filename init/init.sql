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


INSERT INTO blogs (title, blog, author) VALUES ('Cornell Health', '
<p>In early 2018, highly drug resistant cases of typhoid were reported in Sindh, Pakistan, where an outbreak began in November 2016. These organisms were resistant to all three first-line drugs used for typhoid fever (chloramphenicol, ampicillin, and trimethoprim-sulfamethoxazole), as well as fluoroquinolones and third-generation cephalosporins. These organisms have been termed extensively drug resistant (XDR).</p>
<p>According to the most recent estimates by WHO, approximately 21 million cases and 222,000 typhoid-related deaths occur annually worldwide. Antibiotic resistance is a major problem in Salmonella enterica serotype Typhi, the causative agent of typhoid. Multidrug-resistant (MDR) isolates that are resistant to the three first-line drugs are prevalent in many parts of Asia and Africa and reduced susceptibility to the fluoroquinolones is also widespread.</p>', 'Ezra Cornell');
INSERT INTO blogs (title, blog, author) VALUES ('World Health', 'This is a sample post and should be deleted and then replaced. Vestibulum placerat libero et congue facilisis. Nulla tristique posuere sagittis. Fusce aliquet mollis odio, vel lobortis magna fermentum a. Vestibulum quis justo et ipsum imperdiet pharetra. Nam vel tincidunt nibh. Ut tempor, erat et ornare ornare, libero eros tristique risus, ut porttitor nulla ligula nec sem. Fusce dignissim dolor libero, id bibendum dolor dignissim eget.

Suspendisse id molestie velit. Donec faucibus interdum finibus. Nullam ac varius eros. Nunc aliquet placerat sapien a aliquet. Pellentesque porttitor a dui sed tincidunt. Quisque orci ipsum, facilisis laoreet volutpat aliquet, finibus et velit. Aenean bibendum imperdiet odio, sit amet tristique est congue non. Praesent molestie augue dolor. Integer erat elit, laoreet in consequat vitae, vulputate sit amet nulla. In quam est, ultricies vitae leo at, lacinia feugiat velit.

Nulla sed fringilla eros. Vestibulum dignissim dolor ac arcu porta, vel accumsan libero ullamcorper. In ornare, felis a faucibus facilisis, eros arcu interdum nisi, sit amet lobortis eros tellus eget leo. Etiam ac vulputate dolor. Vivamus vel sollicitudin tellus. Integer volutpat velit justo, vel finibus metus aliquet id. Integer eu magna pellentesque, tincidunt enim et, iaculis quam. Proin facilisis ante at urna mollis, et hendrerit erat cursus. Suspendisse potenti. Ut non congue nisi. Nullam euismod suscipit dignissim. Proin sagittis libero id sem molestie, cursus rhoncus quam dictum. Nunc auctor magna suscipit commodo sollicitudin. Integer malesuada congue mollis.', 'A.D. White');
