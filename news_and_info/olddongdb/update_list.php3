<!-- MKelly 2000 -->
<!-- The Dead Heart www.deadheart.org.uk -->
<HTML><HEAD>
<LINK REL=stylesheet HREF="songdb.css" TYPE="text/css">
<STYLE type="text/css">
A {	text-decoration : none;
	color : #FFFFFF;}
B { font-weight : bold;}
</STYLE>
<TITLE>Updateable Songs List</TITLE></HEAD>
<body bgcolor="#000000">

<?  require('conf.inc.php3');
	
	$dbh = mysql_connect($host, $user, $pass);
	$query = "SELECT id_name, full_name from songs order by full_name";
	$result = mysql($dbname, $query, $dbh);
	if ($result == -1) {
		echo("Error: $phperrmsg\n");
		exit(1);
	}
	while(list($id_name, $full_name) = mysql_fetch_row($result)) {
		$encoded_full_name = rawurlencode($full_name);
		echo ("<a href=\"updatedb.php3?song_name=$encoded_full_name&update=no\">$full_name</a><br>\n");
	}

?>

</BODY></HTML>