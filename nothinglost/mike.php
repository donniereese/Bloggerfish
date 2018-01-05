<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>

<?php
mysql_connect("www.freesql.org","lilaero","res0vvj4");
mysql_select_db("wxp_sql");

id
type
name
address
phone
city

$fetch = mysql_query("select * from cstores");
while ($list = mysql_fetch_array($fetch)) {

$line = number_format($list[id], 123);

print <<<loop
<div>
$line: $list[name]</div>
loop;
}

?>

</body>
</html>