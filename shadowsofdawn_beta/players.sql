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

