<!-- MKelly 2000 -->
<!-- The Dead Heart www.deadheart.org.uk -->
<HTML><HEAD>
<LINK REL=stylesheet HREF="songdb.css" TYPE="text/css">
<STYLE type="text/css">
A {	text-decoration : none;
	color : #FFFFFF;}
B { font-weight : bold;}
</STYLE>
<TITLE>Song List</TITLE></HEAD>
<body bgcolor="#000000">

<?  require('conf.inc.php3');
	
	$dbh = mysql_connect($host, $user, $pass);
	$query = "SELECT id_name, full_name from songs order by id_name";
	$result = mysql($dbname, $query, $dbh);
	if ($result == -1) {
		echo("Error: $phperrmsg\n");
		exit(1);
	}
	$letter = "";
	while(list($id_name, $full_name) = mysql_fetch_row($result)) {
		$new_letter = substr($id_name, 0, 1);
		if ($letter != $new_letter) {
			$high_letter = strtoupper($new_letter);
			echo("</p>\n\n<p><b><a name=\"$new_letter\">$high_letter</a></b><br>\n");
			$letter = $new_letter;
		}
		echo ("<a href=\"song.php3?song_id=".rawurlencode($id_name)."\" target=\"details\">$full_name</a><br>\n");
	}

?>

</BODY></HTML>