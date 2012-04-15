<!--MKelly 2000-->
<!--The Dead Heart wwww.deadheart.org.uk -->
<HTML>
<link href="songdb.css" rel="STYLESHEET" type="text/css">
<HEAD><TITLE>Database Stats</TITLE>
<STYLE type="text/css">
A {	text-decoration: none;
	color : #FFFFFF;}
B { font-weight : bold;}
</STYLE>
</HEAD>
<body bgcolor="#000000">
<h1>Statistics</h1>

<? 	require('conf.inc.php3');
	
	$dbh = @mysql_connect($host, $user, $pass) or die("<p>Sorry, the database connection has been lost. Please try again later.</p>");
	$query = "select * from songs";
	$result = mysql_db_query($dbname, $query, $dbh);
	$norecs = mysql_num_rows($result);
?>

<p><table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td background="tabbk.jpg" class="top">
	Number of Songs Listed
</td>
</tr>
<tr>
<td class="bot">
	<? echo($norecs) ?>
</td>
</tr>
<tr>
<td background="udtabbk.jpg">
	&nbsp
</td>
</tr>

<?	$query = "select * from songs where tab != 'None'";
	$result = mysql_db_query($dbname, $query, $dbh);
	$norecs = mysql_num_rows($result);
?>

<tr>
<td background="tabbk.jpg" class="top">
	Number of Links to Tabs
</td>
</tr>
<tr>
<td class="bot">
	<? echo($norecs) ?>
</td>
</tr>
<tr>
<td background="udtabbk.jpg">
	&nbsp
</td>
</tr>

<?	$query = "select * from stats";
	$result = mysql_db_query($dbname, $query, $dbh);
	list($visits, $searches, $views) = mysql_fetch_row($result);
?>

<tr>
<td background="tabbk.jpg" class="top">
	Visits to the Database
</td>
</tr>
<tr>
<td class="bot">
	<? echo($visits) ?>
</td>
</tr>
<tr>
<td background="udtabbk.jpg">
	&nbsp
</td>
</tr>

<tr>
<td background="tabbk.jpg" class="top">
	Individual Song Views
</td>
</tr>
<tr>
<td class="bot">
	<? echo($views) ?>
</td>
</tr>
<tr>
<td background="udtabbk.jpg">
	&nbsp
</td>
</tr>

<tr>
<td background="tabbk.jpg" class="top">
	Searches Performed
</td>
</tr>
<tr>
<td class="bot">
	<? echo($searches) ?>
</td>
</tr>
<tr>
<td background="udtabbk.jpg">
	&nbsp
</td>
</tr>


</table></p>

</BODY></HTML>