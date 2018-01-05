<?php

//Below this is the original code from: http://www.desilva.biz/mysql/listdbs.html
//...............................................................................

// FILENAME: LIST_MYSQL_DBS.PHP
// ----------------------------

//define( 'NL', "\n" );
//define( 'TB', '  ' );

// connecting to MySQL.
//$conn = @mysql_connect( 'bloggerfishdata.bloggerfish.com', 'bloggie', 'mightydonniebuddha' )
//        or die( mysql_errno().': '.mysql_error().NL );

// attempt to get a list of MySQL databases
// already set up in my account. This is done
// using the PHP function: mysql_list_dbs()
//$result = mysql_list_dbs( $conn );

// Output the list
//echo '<ul>'.NL;
 
  /* USING: mysql_fetch_object()
  //  ---------------------------
  while( $row = mysql_fetch_object( $result ) ):
    echo TB.'<li>'.$row->Database.'</li>'.NL;
  endwhile;
  //*/

  /* USING: mysql_fetch_row()
  // ------------------------
  while( $row = mysql_fetch_row( $result ) ):
    echo TB.'<li>'.$row[0].'</li>'.NL;
  endwhile;
  //*/

  /* USING: mysql_fetch_assoc()
  // --------------------------
  while( $row = mysql_fetch_assoc( $result ) ):
    echo TB.'<li>'.$row['Database'].'</li>'.NL;
  endwhile;
  //*/

//echo '</ul>'.NL;

// Free resources / close MySQL Connection
//mysql_free_result( $result );
//mysql_close( $conn );    
//...............................................................................

function getdbs($sep=",", $makesession="session", $presessionhost="", $presessionuser="", $presessionpass="") {
	
	//Create Session Check
	if($makesession == "session") {
		// connecting to MySQL.
		//ex:$conn = @mysql_connect( 'bloggerfishdata.bloggerfish.com', 'bloggie', 'mightydonniebuddha' ) or die( mysql_errno().': '.mysql_error()."\n" );
		$conn = @mysql_connect( $presessionhost, $presessionuser, $presessionpass ) or die( mysql_errno().': '.mysql_error()."\n" );
	}
	
	
	$dbname = 'bloggerfish';
	
	$sql = "SHOW TABLES FROM $dbname";
	$result = mysql_query($sql);
	
	if (!$result) {
		echo "DB Error, could not list tables\n";
		echo 'MySQL Error: ' . mysql_error();
		exit;
	}
	
	while ($row = mysql_fetch_row($result)) {
		echo "Table: {$row[0]}<br>";
	}
	
	
	
	if($makesession == "yes") {
		$result = mysql_list_dbs($conn);
	} else {
		$result = mysql_list_dbs();
	}
	 
	// USING: mysql_fetch_row()
	while( $row = mysql_fetch_row( $result ) ):
		if(empty($parsedresult)) {
			$parsedresult = $row[0];
		} else {
			$parsedresult = ",".$row[0];
		}
	endwhile;
	
	print $parsedresult;
}

function printdbl_flat() {
	define( 'NL', "\n" );
	define( 'TB', '  ' );

	$conn = @mysql_connect( 'bloggerfishdata.bloggerfish.com', 'bloggie', 'mightydonniebuddha' ) or die( mysql_errno().': '.mysql_error().NL );	
	$result = mysql_list_dbs( $conn );
	
	echo '<ul>'.NL;
	while( $row = mysql_fetch_row( $result ) ):
		echo TB.'<li>'.$row[0].'</li>'.NL;
	endwhile;
	echo '</ul>'.NL;
	
	// Free resources / close MySQL Connection
	mysql_free_result( $result );
	mysql_close( $conn );
}

function dblarray() {
	$conn = @mysql_connect( 'bloggerfishdata.bloggerfish.com', 'bloggie', 'mightydonniebuddha' ) or die( mysql_errno().': '.mysql_error());
	$dblist = mysql_list_dbs($conn);
	while ($result = mysql_fetch_row($dblist)) {
		$fin[] = $result[0];
	}
	//print_r($fin);
	return $fin;
}
?>