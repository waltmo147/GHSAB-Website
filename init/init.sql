CREATE TABLE admin (
  admin_id INTEGER PRIMARY KEY NOT NULL,
  username TEXT NOT NULL UNIQUE,
  password TEXT NOT NULL
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
  author TEXT,
  link TEXT
);

CREATE TABLE maindescription (
  id INTEGER PRIMARY KEY NOT NULL,
  title TEXT UNIQUE NOT NULL,
  body TEXT NOT NULL
);
/* members data */
INSERT INTO members (first_name,last_name,introduction,email) VALUES ('Annika', 'Bjerke',' Annika is head of outreach committee. Annika focuses on leading a team in ways to share Global Health with the Ithaca and Cornell community. She helps lead events each year such as book discussions and Global Health awareness events. We hosted a great event Walk for Water last year that is also a part of outreach.','aeb275@cornell.edu');
INSERT INTO members (first_name,last_name,introduction,email) VALUES ('Talia', 'Bailes','Head of global health case competition. Talia focuses on implementing the annual global health case competition which brings different teams together from across disciplines to develop strategic solutions to global health issues.','tfb44@cornell.edu');
INSERT INTO members (first_name,last_name,introduction,email) VALUES ('Jenny', 'DiPetro','Oversees the whole board. She graduated last year from Cornell as a Global and Public Health major and now serves as the Global Health fellow for the department.','jld322@cornell.edu');
INSERT INTO members (first_name,last_name,introduction,email) VALUES ('Juliet', 'McCann','Head of experiential learning symposium. Juliet oversees the implementation of our annual symposium that brings together students across the Global Helath field to present in a poster symposium on their different experiential and engaged work.','jm2435@cornell.edu');


/*member images data*/
INSERT INTO member_images (image_name,picpath) VALUES ('Annika','uploads/pictures/icon.png');
INSERT INTO member_images (image_name,picpath) VALUES ('Talia','uploads/pictures/icon.png');
INSERT INTO member_images (image_name,picpath) VALUES ('Jenny','uploads/pictures/icon.png');
INSERT INTO member_images (image_name,picpath) VALUES ('Juliet','uploads/pictures/icon.png');
-- <a href="https://www.freeiconspng.com/img/1696">Person Icon by thekua  Icon for representing a person</a>

INSERT INTO picliason (member, picture) VALUES ((SELECT id FROM members WHERE first_name = 'Annika'),(SELECT id FROM member_images WHERE image_name = 'Annika'));
INSERT INTO picliason (member, picture) VALUES ((SELECT id FROM members WHERE first_name = 'Talia'),(SELECT id FROM member_images WHERE image_name = 'Talia'));
INSERT INTO picliason (member, picture) VALUES ((SELECT id FROM members WHERE first_name = 'Jenny'),(SELECT id FROM member_images WHERE image_name = 'Jenny'));
INSERT INTO picliason (member, picture) VALUES ((SELECT id FROM members WHERE first_name = 'Juliet'),(SELECT id FROM member_images WHERE image_name = 'Juliet'));

-- password is "cornellglobalhealth2018" for user 'admininistrator'
INSERT INTO admin (username, password) VALUES ('administrator', '$2y$10$7yzA6bjor.PX2jkqbduReetOpP39/SifVIYUjxYLUx12Qv88jIfp2');

-- seed data for slideshow
INSERT INTO slideshow (picpath, title) VALUES ('uploads/pictures/image1.jpg', "image1");
INSERT INTO slideshow (picpath, title) VALUES ('uploads/pictures/image2.jpg', "image2");
INSERT INTO slideshow (picpath, title) VALUES ('uploads/pictures/image3.jpg', "image3");
INSERT INTO slideshow (picpath, title) VALUES ('uploads/pictures/image4.jpg', "image4");

INSERT INTO events (name, date_time, address, description) values ('Cornell Ochestra', '2018-04-29 15:00:00', 'Bailey Hall', 'Tchaikovsky');
INSERT INTO application (event_id, email, comment) values ((SELECT id FROM events where name is 'Cornell Ochestra'), 'jg2273@cornell.edu', 'Is is for free?');


INSERT INTO blogs (title, blog, author,link) VALUES ('Urgent need for South Asian collaboration against undifferentiated febrile illness','In early 2018, highly drug resistant cases of typhoid were reported in Sindh, Pakistan, where an outbreak began in November 2016. These organisms were resistant to all three first-line drugs used for typhoid fever (chloramphenicol, ampicillin, and trimethoprim-sulfamethoxazole), as well as fluoroquinolones and third-generation cephalosporins. These organisms have been termed extensively drug resistant (XDR).
According to the most recent estimates by WHO, approximately 21 million cases and 222,000 typhoid-related deaths occur annually worldwide. Antibiotic resistance is a major problem in Salmonella enterica serotype Typhi, the causative agent of typhoid. Multidrug-resistant (MDR) isolates that are resistant to the three first-line drugs are prevalent in many parts of Asia and Africa and reduced susceptibility to the fluoroquinolones is also widespread.', 'Abhilasha Karkey','http://globalhealth.thelancet.com/2018/05/11/urgent-need-south-asian-collaboration-against-undifferentiated-febrile-illness');
INSERT INTO blogs (title, blog, author,link) VALUES ('Most access-to-medicine initiatives are poorly evaluated; here’s one effort to change that', 'Two decades ago, the World Health Organization and health activists were pressuring global pharmaceutical companies to launch more “access-to-medicine” (AtM) initiatives in low- and middle-income countries. They succeeded, and that has started to happen. Unfortunately, few of these initiatives have any idea what kind of impact they are making.
Those are some of the conclusions of a study published in Health Affairs in April. A team of researchers associated with the Boston University Department of Global Health discovered that the number of AtM initiatives from 21 companies had grown from 17 in 2000 to 102 in 2015 but they found published evaluations for only seven of them.
From those seven evaluations, the researchers found 47 articles that met their inclusion criteria for evidence, and all of them were published in peer-reviewed journals. However, they determined that 62 percent of these were low quality, 32 percent were very low quality and 6 percent were moderate quality. None of them were rated high quality.', 'David J. Olson','http://globalhealth.thelancet.com/2017/08/11/most-access-medicine-initiatives-are-poorly-evaluated-heres-one-effort-change');

INSERT INTO maindescription (title, body) VALUES ('Who We Are', "The GHSAB is a diverse team of dedicated, enthusiastic, and innovative upperclassmen that represents the Global Health Program and assists with overall program development.  This development includes organizing information sessions and other means of communicating various programs, an intramural Cornell Global Health Case Competition, and organizing Global Health related workshops and various events on campus.");

INSERT INTO maindescription (title, body) VALUES ('Our Mission', "To broaden the Global Health Program’s impact through program development, and to engage students across campus in the field of global and public health. ");
