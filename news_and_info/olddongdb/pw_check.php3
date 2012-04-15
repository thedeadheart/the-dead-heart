<!-- MKelly 2000 -->
<!-- The Dead Heart www.deadheart.org.uk -->
<HTML>
<link href="songdb.css" rel="STYLESHEET" type="text/css">
<style type="text/css">
A {	text-decoration : none;
	color : White;}
P { color : White;}
</style>
<HEAD><TITLE>Password Check Results</TITLE></HEAD>
<body bgcolor="#000000">

<?	require('conf.inc.php3');

	function admin_options() {
		echo ("<h1>Admin Options</h1>\n
				<ol><p>\n
					<li><a href=\"update.php3?al_in=true\">Update a database entry.</a>\n
					<li><a href=\"insert.php3?al_in=true\">Insert a database entry.</a>\n
					<li><a href=\"dump_entry.php3?al_in=true\">Load a dump file.</a></p>\n
				</ol>\n");
	}
	
	if ($al_in == "true") {
		admin_options();
	}
	else {
		$dbh = mysql_connect($host, $user, $pass) or die ("Major whoopsy on the connect!");
	
		$query = "select * from users where username = '$username' and password = password('$password')";
		$result = mysql_db_query ($dbname, $query, $dbh) or die("Query fucked up");
		if(mysql_num_rows($result)) {		
			echo ("<h1>Password Check Results</h1>\n<p>Password accepted.</p>\n");
			admin_options();
		}
		else {
			echo ("<p>Password rejected.<br>\nThe details of this failure has been logged, along with your IP address and other pertinent information regarding this attempt to log in.</p>");
		}
	}
?>

</body></html>