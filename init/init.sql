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

CREATE TABLE maindescription (
  id INTEGER PRIMARY KEY NOT NULL,
  title TEXT UNIQUE NOT NULL,
  body TEXT NOT NULL
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
INSERT INTO maindescription (title, body) VALUES ('The Declaration of Independence', "When in the Course of human events it becomes necessary for one people to dissolve the political bands which have connected them with another and to assume among the powers of the earth, the separate and equal station to which the Laws of Nature and of Nature's God entitle them, a decent respect to the opinions of mankind requires that they should declare the causes which impel them to the separation. We hold these truths to be self-evident, that all men are created equal, that they are endowed by their Creator with certain unalienable Rights, that among these are Life, Liberty and the pursuit of Happiness. — That to secure these rights, Governments are instituted among Men, deriving their just powers from the consent of the governed, — That whenever any Form of Government becomes destructive of these ends, it is the Right of the People to alter or to abolish it, and to institute new Government, laying its foundation on such principles and organizing its powers in such form, as to them shall seem most likely to effect their Safety and Happiness. Prudence, indeed, will dictate that Governments long established should not be changed for light and transient causes; and accordingly all experience hath shewn that mankind are more disposed to suffer, while evils are sufferable than to right themselves by abolishing the forms to which they are accustomed. But when a long train of abuses and usurpations, pursuing invariably the same Object evinces a design to reduce them under absolute Despotism, it is their right, it is their duty, to throw off such Government, and to provide new Guards for their future security. — Such has been the patient sufferance of these Colonies; and such is now the necessity which constrains them to alter their former Systems of Government. The history of the present King of Great Britain is a history of repeated injuries and usurpations, all having in direct object the establishment of an absolute Tyranny over these States. To prove this, let Facts be submitted to a candid world. He has refused his Assent to Laws, the most wholesome and necessary for the public good. He has forbidden his Governors to pass Laws of immediate and pressing importance, unless suspended in their operation till his Assent should be obtained; and when so suspended, he has utterly neglected to attend to them. He has refused to pass other Laws for the accommodation of large districts of people, unless those people would relinquish the right of Representation in the Legislature, a right inestimable to them and formidable to tyrants only. He has called together legislative bodies at places unusual, uncomfortable, and distant from the depository of their Public Records, for the sole purpose of fatiguing them into compliance with his measures. He has dissolved Representative Houses repeatedly, for opposing with manly firmness his invasions on the rights of the people. He has refused for a long time, after such dissolutions, to cause others to be elected, whereby the Legislative Powers, incapable of Annihilation, have returned to the People at large for their exercise; the State remaining in the mean time exposed to all the dangers of invasion from without, and convulsions within. He has endeavoured to prevent the population of these States; for that purpose obstructing the Laws for Naturalization of Foreigners; refusing to pass others to encourage their migrations hither, and raising the conditions of new Appropriations of Lands. He has obstructed the Administration of Justice by refusing his Assent to Laws for establishing Judiciary Powers. He has made Judges dependent on his Will alone for the tenure of their offices, and the amount and payment of their salaries. He has erected a multitude of New Offices, and sent hither swarms of Officers to harass our people and eat out their substance. He has kept among us, in times of peace, Standing Armies without the Consent of our legislatures. He has affected to render the Military independent of and superior to the Civil Power. He has combined with others to subject us to a jurisdiction foreign to our constitution, and unacknowledged by our laws; giving his Assent to their Acts of pretended Legislation: For quartering large bodies of armed troops among us: For protecting them, by a mock Trial from punishment for any Murders which they should commit on the Inhabitants of these States: For cutting off our Trade with all parts of the world: For imposing Taxes on us without our Consent: For depriving us in many cases, of the benefit of Trial by Jury: For transporting us beyond Seas to be tried for pretended offences: For abolishing the free System of English Laws in a neighbouring Province, establishing therein an Arbitrary government, and enlarging its Boundaries so as to render it at once an example and fit instrument for introducing the same absolute rule into these Colonies For taking away our Charters, abolishing our most valuable Laws and altering fundamentally the Forms of our Governments: For suspending our own Legislatures, and declaring themselves invested with power to legislate for us in all cases whatsoever. He has abdicated Government here, by declaring us out of his Protection and waging War against us. He has plundered our seas, ravaged our coasts, burnt our towns, and destroyed the lives of our people. He is at this time transporting large Armies of foreign Mercenaries to compleat the works of death, desolation, and tyranny, already begun with circumstances of Cruelty & Perfidy scarcely paralleled in the most barbarous ages, and totally unworthy the Head of a civilized nation. He has constrained our fellow Citizens taken Captive on the high Seas to bear Arms against their Country, to become the executioners of their friends and Brethren, or to fall themselves by their Hands. He has excited domestic insurrections amongst us, and has endeavoured to bring on the inhabitants of our frontiers, the merciless Indian Savages whose known rule of warfare, is an undistinguished destruction of all ages, sexes and conditions. In every stage of these Oppressions We have Petitioned for Redress in the most humble terms: Our repeated Petitions have been answered only by repeated injury. A Prince, whose character is thus marked by every act which may define a Tyrant, is unfit to be the ruler of a free people. Nor have We been wanting in attentions to our British brethren. We have warned them from time to time of attempts by their legislature to extend an unwarrantable jurisdiction over us. We have reminded them of the circumstances of our emigration and settlement here. We have appealed to their native justice and magnanimity, and we have conjured them by the ties of our common kindred to disavow these usurpations, which would inevitably interrupt our connections and correspondence. They too have been deaf to the voice of justice and of consanguinity. We must, therefore, acquiesce in the necessity, which denounces our Separation, and hold them, as we hold the rest of mankind, Enemies in War, in Peace Friends. We, therefore, the Representatives of the united States of America, in General Congress, Assembled, appealing to the Supreme Judge of the world for the rectitude of our intentions, do, in the Name, and by Authority of the good People of these Colonies, solemnly publish and declare, That these united Colonies are, and of Right ought to be Free and Independent States, that they are Absolved from all Allegiance to the British Crown, and that all political connection between them and the State of Great Britain, is and ought to be totally dissolved; and that as Free and Independent States, they have full Power to levy War, conclude Peace, contract Alliances, establish Commerce, and to do all other Acts and Things which Independent States may of right do. — And for the support of this Declaration, with a firm reliance on the protection of Divine Providence, we mutually pledge to each other our Lives, our Fortunes, and our sacred Honor.");
