<!-- MKelly 2000 -->
<!-- The Dead Heart www.deadheart.org.uk -->
<?   require('conf.inc.php3'); ?>
<HTML>
<link href="songdb.css" rel="STYLESHEET" type="text/css">
<style type="text/css">
A {	text-decoration : none;
	color : White;}
</style>
<HEAD><TITLE>Song Database</TITLE></HEAD>
<body background="topbk.jpg" bgcolor="#000000">

<table width="125" border="1" cellspacing="0" cellpadding="2" align="RIGHT" bordercolor="#ACAC59" bordercolordark="#696937">
<tr>
<td align="CENTER" valign="TOP" bgcolor="#5F5632" bordercolor="#DFDFBF">
	<a href="<? echo $server_root ?>index.html"  target="_parent" class="nav">TDH</A></td>
</tr>
<tr>
<td align="CENTER" bgcolor="#5F5632" bordercolor="#DFDFBF">
	<a href="<? echo $server_root ?>news_and_info/" target="_parent" class="nav">News & Info</A></td>
</tr>
</table>

<h1>Song Database</h1>

<p><b>
<?	$dbh = @mysql_connect($host, $user, $pass) or die("<p>Sorry, but the database is temporarily unavailable due to a server problem. If this error has not been resolved within an hour, please notify <a href=\"/contact/contact.php\"><b>The Dead Heart</b></a>.</p>");

	if ($stats_on) {
		$stat_query = "update stats set visits = visits + 1";
		mysql_db_query($dbname, $stat_query, $dbh);
	}

	$query = "SELECT id_name, full_name from songs order by id_name";
	$result = mysql_db_query($dbname, $query, $dbh);
	if ($result == -1) {
		echo("Error: $phperrmsg\n");
		exit(1);
	}
	$letter = "";
	while(list($id_name, $full_name) = mysql_fetch_row($result)) {
		$new_letter = substr($id_name, 0, 1);
		if ($letter != $new_letter) {
			$high_letter = strtoupper($new_letter);
			echo("<a href=\"list.php3?initial=$new_letter\" target=\"songlist\">$high_letter</a>\n");
			$letter = $new_letter;
		}
	}

?>

<br><a href="list_all.php3" target="songlist">All Songs</a>
 &nbsp; &nbsp; <a href="search.php3?song_name=yes" target="songlist">Search</a>
 &nbsp; &nbsp; <a href="info.html" target="details">About</a>
 &nbsp; &nbsp; <a href="stats.php3" target="details">Stats</a>
 &nbsp; &nbsp; <a href="pw_check.html" target="details">Admin</a></b></p> 

</BODY></HTML>
