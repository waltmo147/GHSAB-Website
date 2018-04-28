/* TODO: create tables */
CREATE TABLE admin (
  admin_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  username TEXT NOT NULL UNIQUE,
  password TEXT NOT NULL,
  session TEXT
);
/* TODO: initial seed data */



-- password is "good" for user 'admin'
INSERT INTO admin (admin_id, username, password, session) VALUES (0, 'admin', '$2y$10$i41U0Al7AUAQFIAeoi0NH.1Aykum/Hf3vScM.zt1pQKcKHDSPlm0e', 'NULL');
