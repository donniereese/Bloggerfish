CREATE TABLE admin_config (
  id int(11) NOT NULL auto_increment,
  user int(11) NOT NULL default '0',
  pass int(11) NOT NULL default '0',
  multi_account int(11) NOT NULL default '0',
  main_account int(11) NOT NULL default '0',
  server_activate varchar(10) NOT NULL default 'YES',
  UNIQUE KEY id (id)
) TYPE=MyISAM;
# --------------------------------------------------------

#
CREATE TABLE user_config (
  id int(11) NOT NULL auto_increment,
  user int(11) NOT NULL default '0',
  pass int(11) NOT NULL default '0',
  cost int(11) NOT NULL default '0',
  UNIQUE KEY id (id)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `chat`
#

CREATE TABLE chat (
  id int(11) NOT NULL auto_increment,
  user varchar(100) NOT NULL default '',
  chat text NOT NULL,
  UNIQUE KEY id (id)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `equipment`
#

CREATE TABLE equipment (
  id int(11) NOT NULL auto_increment,
  owner int(11) NOT NULL default '0',
  name varchar(30) NOT NULL default '',
  power int(11) NOT NULL default '0',
  status char(1) NOT NULL default 'U',
  type char(1) NOT NULL default 'W',
  cost int(11) NOT NULL default '0',
  UNIQUE KEY id (id)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `exp`
#

CREATE TABLE exp (
  level int(11) NOT NULL default '0',
  exp int(11) NOT NULL default '0'
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `log`
#

CREATE TABLE log (
  id int(11) NOT NULL auto_increment,
  owner int(11) NOT NULL default '0',
  log text NOT NULL,
  unread char(1) NOT NULL default 'F',
  UNIQUE KEY id (id)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `mail`
#

CREATE TABLE mail (
  id int(11) NOT NULL auto_increment,
  sender varchar(15) NOT NULL default '',
  owner int(11) NOT NULL default '0',
  subject varchar(50) NOT NULL default '',
  body text NOT NULL,
  unread char(1) NOT NULL default 'F',
  UNIQUE KEY id (id)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `outposts`
#

CREATE TABLE outposts (
  id int(11) NOT NULL auto_increment,
  owner int(11) NOT NULL default '0',
  size int(11) NOT NULL default '1',
  mines int(11) NOT NULL default '0',
  turns int(11) NOT NULL default '5',
  tokens int(11) NOT NULL default '1000',
  troops int(11) NOT NULL default '3',
  barricades int(11) NOT NULL default '3',
  news text NOT NULL,
  UNIQUE KEY id (id)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `players`
#

CREATE TABLE players (
  id int(11) NOT NULL auto_increment,
  user varchar(15) NOT NULL default '',
  email varchar(60) NOT NULL default '',
  pass varchar(15) NOT NULL default '',
  rank varchar(10) NOT NULL default 'Member',
  level int(11) NOT NULL default '1',
  exp int(11) NOT NULL default '0',
  credits int(11) NOT NULL default '1000',
  energy double(11,2) NOT NULL default '5.00',
  max_energy double(11,2) NOT NULL default '5.00',
  strength double(11,3) NOT NULL default '3.000',
  agility double(11,3) NOT NULL default '3.000',
  ap int(11) NOT NULL default '3',
  wins int(11) NOT NULL default '0',
  losses int(11) NOT NULL default '0',
  lastkilled varchar(15) NOT NULL default '...',
  lastkilledby varchar(15) NOT NULL default '...',
  platinum int(11) NOT NULL default '0',
  age int(11) NOT NULL default '1',
  logins int(11) NOT NULL default '0',
  hp int(11) NOT NULL default '15',
  max_hp int(11) NOT NULL default '15',
  bank int(11) NOT NULL default '0',
  lpv bigint(20) NOT NULL default '0',
  page varchar(100) NOT NULL default '',
  ip varchar(50) NOT NULL default '',
  ability double(11,2) NOT NULL default '0.01',
  tribe int(11) NOT NULL default '0',
  UNIQUE KEY id (id)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `pmarket`
#

CREATE TABLE pmarket (
  id int(11) NOT NULL auto_increment,
  seller int(11) NOT NULL default '0',
  platinum int(11) NOT NULL default '0',
  cost int(11) NOT NULL default '0',
  UNIQUE KEY id (id)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `replies`
#

CREATE TABLE replies (
  id int(11) NOT NULL auto_increment,
  starter varchar(30) NOT NULL default '',
  topic_id text NOT NULL,
  body text NOT NULL,
  UNIQUE KEY id (id)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `topics`
#

CREATE TABLE topics (
  id int(11) NOT NULL auto_increment,
  topic text NOT NULL,
  body text NOT NULL,
  starter varchar(30) NOT NULL default '',
  UNIQUE KEY id (id)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `tribes`
#

CREATE TABLE `tribes` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `owner` int(11) NOT NULL default '0',
  `coowner` int(11) NOT NULL default '0',
  `credits` int(11) NOT NULL default '0',
  `platinum` int(11) NOT NULL default '0',
  `public_msg` text NOT NULL,
  `private_msg` text NOT NULL,
  `pass` varchar(30) NOT NULL default '',
  UNIQUE KEY `id` (`id`)
) TYPE=MyISAM;

#
# Table structure for table `updates`
#

CREATE TABLE updates (
  id int(11) NOT NULL auto_increment,
  starter text NOT NULL,
  title text NOT NULL,
  updates text NOT NULL,
  UNIQUE KEY id (id)
) TYPE=MyISAM;


