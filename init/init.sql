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
INSERT INTO members (first_name,last_name,introduction,email) VALUES ('Annika', 'Bjerke',' Annika is head of outreach committee. Annika focuses on leading a team in ways to share Global Health with the Ithaca and Cornell community. She helps lead events each year such as book discussions and Global Health awareness events. We hosted a great event Walk for Water last year that is also a part of outreach.','ptk592@cornell.edu');
INSERT INTO members (first_name,last_name,introduction,email) VALUES ('Talia', 'Bailes','head of global health case competition. Talia focuses on implementing the annual global health case competition which brings different teams together from across disciplines to develop strategic solutions to global health issues.','admin3@cornell.edu');
/*member images data*/
INSERT INTO member_images (image_name,picpath) VALUES ('admin_pic','uploads/pictures/camel.jpg');
INSERT INTO member_images (image_name,picpath) VALUES ('james_pic','uploads/pictures/felted-sheep.jpg');

INSERT INTO picliason (member, picture) VALUES ((SELECT id FROM members WHERE first_name = 'Annika'),(SELECT id FROM member_images WHERE image_name = 'admin_pic'));
INSERT INTO picliason (member, picture) VALUES ((SELECT id FROM members WHERE first_name = 'Talia'),(SELECT id FROM member_images WHERE image_name = 'james_pic'));

-- password is "good" for user 'admin'
INSERT INTO admin (username, password) VALUES ('admin', '$2y$10$i41U0Al7AUAQFIAeoi0NH.1Aykum/Hf3vScM.zt1pQKcKHDSPlm0e');

-- seed data for slideshow
INSERT INTO slideshow (picpath, title) VALUES ('uploads/pictures/image1.jpg', "image1");
INSERT INTO slideshow (picpath, title) VALUES ('uploads/pictures/image2.jpg', "image2");
INSERT INTO slideshow (picpath, title) VALUES ('uploads/pictures/image3.jpg', "image3");
INSERT INTO slideshow (picpath, title) VALUES ('uploads/pictures/image4.jpg', "image4");

INSERT INTO events (name, date_time, address, description) values ('Cornell Ochestra', '2018-04-29 15:00:00', 'Bailey Hall', 'Tchaikovsky');
INSERT INTO application (event_id, email, comment) values ((SELECT id FROM events where name is 'Cornell Ochestra'), 'jg2273@cornell.edu', 'Is is for free?');


INSERT INTO blogs (title, blog, author) VALUES ('Urgent need for South Asian collaboration against undifferentiated febrile illness','<p>In early 2018, highly drug resistant cases of typhoid were reported in Sindh, Pakistan, where an outbreak began in November 2016. These organisms were resistant to all three first-line drugs used for typhoid fever (chloramphenicol, ampicillin, and trimethoprim-sulfamethoxazole), as well as fluoroquinolones and third-generation cephalosporins. These organisms have been termed extensively drug resistant (XDR).</p>
<p>According to the most recent estimates by WHO, approximately 21 million cases and 222,000 typhoid-related deaths occur annually worldwide. Antibiotic resistance is a major problem in Salmonella enterica serotype Typhi, the causative agent of typhoid. Multidrug-resistant (MDR) isolates that are resistant to the three first-line drugs are prevalent in many parts of Asia and Africa and reduced susceptibility to the fluoroquinolones is also widespread.</p><a href="http://globalhealth.thelancet.com/2018/05/11/urgent-need-south-asian-collaboration-against-undifferentiated-febrile-illness" class="links">READ MORE...</a>', 'Abhilasha Karkey');
INSERT INTO blogs (title, blog, author) VALUES ('Most access-to-medicine initiatives are poorly evaluated; here’s one effort to change that', '<p>Two decades ago, the World Health Organization and health activists were pressuring global pharmaceutical companies to launch more “access-to-medicine” (AtM) initiatives in low- and middle-income countries. They succeeded, and that has started to happen. Unfortunately, few of these initiatives have any idea what kind of impact they are making.</p>
<p>Those are some of the conclusions of a study published in Health Affairs in April. A team of researchers associated with the Boston University Department of Global Health discovered that the number of AtM initiatives from 21 companies had grown from 17 in 2000 to 102 in 2015 but they found published evaluations for only seven of them.</p>
<p>From those seven evaluations, the researchers found 47 articles that met their inclusion criteria for evidence, and all of them were published in peer-reviewed journals. However, they determined that 62 percent of these were low quality, 32 percent were very low quality and 6 percent were moderate quality. None of them were rated high quality.</p><a href="http://globalhealth.thelancet.com/2017/08/11/most-access-medicine-initiatives-are-poorly-evaluated-heres-one-effort-change">READ MORE<a/>', 'David J. Olson');

INSERT INTO maindescription (title, body) VALUES ('The Declaration of Independence', "hen in the Course of human events it becomes necessary for one people to dissolve the political bands which have connected them with another and to assume among the powers of the earth, the separate and equal station to which the Laws of Nature and of Nature's God entitle them, a decent respect to the opinions of mankind requires that they should declare the causes which impel them to the separation.

We hold these truths to be self-evident, that all men are created equal, that they are endowed by their Creator with certain unalienable Rights, that among these are Life, Liberty and the pursuit of Happiness. — That to secure these rights, Governments are instituted among Men, deriving their just powers from the consent of the governed, — That whenever any Form of Government becomes destructive of these ends, it is the Right of the People to alter or to abolish it, and to institute new Government, laying its foundation on such principles and organizing its powers in such form, as to them shall seem most likely to effect their Safety and Happiness. Prudence, indeed, will dictate that Governments long established should not be changed for light and transient causes; and accordingly all experience hath shewn that mankind are more disposed to suffer, while evils are sufferable than to right themselves by abolishing the forms to which they are accustomed. But when a long train of abuses and usurpations, pursuing invariably the same Object evinces a design to reduce them under absolute Despotism, it is their right, it is their duty, to throw off such Government, and to provide new Guards for their future security. — Such has been the patient sufferance of these Colonies; and such is now the necessity which constrains them to alter their former Systems of Government. The history of the present King of Great Britain is a history of repeated injuries and usurpations, all having in direct object the establishment of an absolute Tyranny over these States. To prove this, let Facts be submitted to a candid world.

He has refused his Assent to Laws, the most wholesome and necessary for the public good.

He has forbidden his Governors to pass Laws of immediate and pressing importance, unless suspended in their operation till his Assent should be obtained; and when so suspended, he has utterly neglected to attend to them.

He has refused to pass other Laws for the accommodation of large districts of people, unless those people would relinquish the right of Representation in the Legislature, a right inestimable to them and formidable to tyrants only.

He has called together legislative bodies at places unusual, uncomfortable, and distant from the depository of their Public Records, for the sole purpose of fatiguing them into compliance with his measures.

He has dissolved Representative Houses repeatedly, for opposing with manly firmness his invasions on the rights of the people.

He has refused for a long time, after such dissolutions, to cause others to be elected, whereby the Legislative Powers, incapable of Annihilation, have returned to the People at large for their exercise; the State remaining in the mean time exposed to all the dangers of invasion from without, and convulsions within.

He has endeavoured to prevent the population of these States; for that purpose obstructing the Laws for Naturalization of Foreigners; refusing to pass others to encourage their migrations hither, and raising the conditions of new Appropriations of Lands.

He has obstructed the Administration of Justice by refusing his Assent to Laws for establishing Judiciary Powers.

He has made Judges dependent on his Will alone for the tenure of their offices, and the amount and payment of their salaries.

He has erected a multitude of New Offices, and sent hither swarms of Officers to harass our people and eat out their substance.

He has kept among us, in times of peace, Standing Armies without the Consent of our legislatures.

He has affected to render the Military independent of and superior to the Civil Power.

He has combined with others to subject us to a jurisdiction foreign to our constitution, and unacknowledged by our laws; giving his Assent to their Acts of pretended Legislation:

For quartering large bodies of armed troops among us:

For protecting them, by a mock Trial from punishment for any Murders which they should commit on the Inhabitants of these States:

For cutting off our Trade with all parts of the world:

For imposing Taxes on us without our Consent:

For depriving us in many cases, of the benefit of Trial by Jury:

For transporting us beyond Seas to be tried for pretended offences:

For abolishing the free System of English Laws in a neighbouring Province, establishing therein an Arbitrary government, and enlarging its Boundaries so as to render it at once an example and fit instrument for introducing the same absolute rule into these Colonies

For taking away our Charters, abolishing our most valuable Laws and altering fundamentally the Forms of our Governments:

For suspending our own Legislatures, and declaring themselves invested with power to legislate for us in all cases whatsoever.

He has abdicated Government here, by declaring us out of his Protection and waging War against us.

He has plundered our seas, ravaged our coasts, burnt our towns, and destroyed the lives of our people.

He is at this time transporting large Armies of foreign Mercenaries to compleat the works of death, desolation, and tyranny, already begun with circumstances of Cruelty & Perfidy scarcely paralleled in the most barbarous ages, and totally unworthy the Head of a civilized nation.

He has constrained our fellow Citizens taken Captive on the high Seas to bear Arms against their Country, to become the executioners of their friends and Brethren, or to fall themselves by their Hands.

He has excited domestic insurrections amongst us, and has endeavoured to bring on the inhabitants of our frontiers, the merciless Indian Savages whose known rule of warfare, is an undistinguished destruction of all ages, sexes and conditions.

In every stage of these Oppressions We have Petitioned for Redress in the most humble terms: Our repeated Petitions have been answered only by repeated injury. A Prince, whose character is thus marked by every act which may define a Tyrant, is unfit to be the ruler of a free people.

Nor have We been wanting in attentions to our British brethren. We have warned them from time to time of attempts by their legislature to extend an unwarrantable jurisdiction over us. We have reminded them of the circumstances of our emigration and settlement here. We have appealed to their native justice and magnanimity, and we have conjured them by the ties of our common kindred to disavow these usurpations, which would inevitably interrupt our connections and correspondence. They too have been deaf to the voice of justice and of consanguinity. We must, therefore, acquiesce in the necessity, which denounces our Separation, and hold them, as we hold the rest of mankind, Enemies in War, in Peace Friends.

We, therefore, the Representatives of the united States of America, in General Congress, Assembled, appealing to the Supreme Judge of the world for the rectitude of our intentions, do, in the Name, and by Authority of the good People of these Colonies, solemnly publish and declare, That these united Colonies are, and of Right ought to be Free and Independent States, that they are Absolved from all Allegiance to the British Crown, and that all political connection between them and the State of Great Britain, is and ought to be totally dissolved; and that as Free and Independent States, they have full Power to levy War, conclude Peace, contract Alliances, establish Commerce, and to do all other Acts and Things which Independent States may of right do. — And for the support of this Declaration, with a firm reliance on the protection of Divine Providence, we mutually pledge to each other our Lives, our Fortunes, and our sacred Honor.

");
