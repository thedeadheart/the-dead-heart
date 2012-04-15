<!-- MKelly 2000 -->
<!-- The Dead Heart www.deadheart.org.uk -->
<HTML>
<link href="songdb.css" rel="STYLESHEET" type="text/css">
<HEAD><TITLE>Song details</TITLE>
<STYLE type="text/css">
A {	text-decoration: none;
	color : #FFFFFF;}
B { font-weight : bold;}
</STYLE>
</HEAD>
<body bgcolor="#000000">

<? 	require('conf.inc.php3');

	require('func.inc.php3');
	
	$songname = $song_id;
	$srchstr = stripslashes($srchstr);
	$dbh = @mysql_connect($host, $user, $pass) or die("<p>Sorry, the database connection has been lost. Please try again later.</p>");

	if ($stats_on) {
		$stat_query = "update stats set views = views + 1";
		mysql_db_query($dbname, $stat_query, $dbh);
	}
	
	$query = "select * from songs where id_name=\"$songname\"";
	$result = mysql_db_query($dbname, $query, $dbh);
	list($id_name, $full_name, $writers, $orig_ver, $ver_details, $prod_details, $lyrics, $tab) = mysql_fetch_row($result);
	if ($result == -1) {
		echo("Error: $phperrmsg\n");
		exit(1);
	}
	mysql_free_result($result);
	
	$writer_name_output = writer_id_to_name($writers, $dbname, $dbh);
	
	$unmod_orig_ver = $orig_ver;
	if ($srchstr) {
		$full_name = eregi_replace($srchstr, "<b>\\0</b>", $full_name);
		$writer_name_output = eregi_replace($srchstr, "<b>\\0</b>", $writer_name_output);
		$orig_ver = eregi_replace($srchstr, "<b>\\0</b>", $orig_ver);
		$ver_details = eregi_replace($srchstr, "<b>\\0</b>", $ver_details);
		$prod_details = eregi_replace($srchstr, "<b>\\0</b>", $prod_details);
		$lyrics = eregi_replace($srchstr, "<b>\\0</b>", $lyrics);
	}
		
?>

<h1><? echo($full_name) ?></h1>

<p style="margin-right : 0;"><table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td background="tabbk.jpg" class="top">
	Written by: -
</td>
</tr>
<tr>
<td class="bot">
	<? echo($writer_name_output) ?>
</td>
</tr>
<tr>
<td background="udtabbk.jpg">
	&nbsp
</td>
</tr>

<tr>
<td background="tabbk.jpg" class="top">
	Major appearance on: -
</td>
</tr>
<tr>
<td class="bot">
	<? 	$query = "SELECT discog_url FROM visual_disc WHERE main_ver = '$unmod_orig_ver'";
		$result = mysql_db_query($dbname, $query, $dbh);
		if (mysql_num_rows($result) > 0) {
			list($discog_url) = mysql_fetch_row($result);
			echo("<a href=\"/discographies/$discog_url\" target=\"_parent\">$orig_ver <img src=\"sm-sprint.gif\" width=18 height=16 border=0 alt=\"Link\"></a>");
		}
		else {
			echo($orig_ver);
		} ?>
</td>
</tr>
<tr>
<td background="udtabbk.jpg">
	&nbsp
</td>
</tr>

<tr>
<td background="tabbk.jpg" class="top">
	Version details: -
</td>
</tr>
<tr>
<td class="bot">
	<? echo(preg_replace("/\n/", "<br>", $ver_details)) ?>
</td>
</tr>
<tr>
<td background="udtabbk.jpg">
	&nbsp
</td>
</tr>

<tr>
<td background="tabbk.jpg" class="top">
	Production: -
</td>
</tr>
<tr>
<td class="bot">
	<? 	echo(preg_replace("/\n/", "<br>", $prod_details)) ?>
</td>
</tr>
<tr>
<td background="udtabbk.jpg">
	&nbsp
</td>
</tr>


<tr>
<td background="tabbk.jpg" class="top">
	Tablature: -
</td>
</tr>
<tr>
<td class="bot">
	<? 	if ($tab != "None") { 
			echo ("<a href=\"".$server_root."tablature/".$tab."\" target=\"_parent\">Yes <img src=\"sm-sprint.gif\" width=18 height=16 border=0 alt=\"Link\"></a>");
		}
		else { echo ($tab);}
	?>
</td>
</tr>
<tr>
<td background="udtabbk.jpg">
	&nbsp
</td>
</tr>


<tr>
<td background="tabbk.jpg" class="top">
	Lyrics: -
</td>
</tr>
<tr>
<td class="bot">
	<? 	echo(preg_replace("/\n/", "<br>", $lyrics)) ?>
</td>
</tr>
<tr>
<td background="udtabbk.jpg">
	&nbsp
</td>
</tr>

<tr>
<td background="tabbk.jpg" class="top">
	Corrections?
</td>
</tr>
<tr>
<td class="bot">
	<? 	echo("<a href=\"correction.php3?song_name=".rawurlencode($full_name)."\">Submit a correction by clicking on this link <img src=\"sm-sprint.gif\" width=18 height=16 border=0 alt=\"Link\"></a>") ?>
</td>
</tr>
<tr>
<td background="udtabbk.jpg">
	&nbsp
</td>
</tr>
</table></p>


</body></html>