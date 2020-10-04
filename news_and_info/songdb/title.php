<!-- MRKelly 2004 -->
<!-- The Dead Heart http://www.deadheart.org.uk/ -->
<!-- Song Database -->
<?  
    require( 'conf.inc.php' );
    require( 'sdb.func.inc.php' );
?>

<html>
<link href="songdb.css" rel="STYLESHEET" type="text/css">

<style type="text/css">
A {	text-decoration : none;
	color : White;}
</style>

<head><title>The Song Database</title></head>
<body background="topbk.jpg" bgcolor="#000000">

<table width="125" border="1" cellspacing="0" cellpadding="2" align="RIGHT" bordercolor="#ACAC59" bordercolordark="#696937">

<tr>
<td align="CENTER" valign="TOP" bgcolor="#5F5632" bordercolor="#DFDFBF">
	<a href="/main_page.html"  target="_parent" class="nav">TDH</A></td>
</tr>
<tr>
<td align="CENTER" bgcolor="#5F5632" bordercolor="#DFDFBF">
	<a href="/news_and_info/" target="_parent" class="nav">News & Info</A></td>
</tr>
</table>

<h1>The Song Database</h1>

<p><b>
<?	
    $varDBHandle = initDB();

	/*if ($stats_on) {
		$stat_query = "update stats set visits = visits + 1";
		mysql_db_query($dbname, $stat_query, $dbh);
	}*/

	$varQuery = "SELECT song_name
        FROM songs
        ORDER BY song_name ASC";
	$varResult = mysql_query( $varQuery, $varDBHandle);
	if ($varResult == -1)
    {
		echo( "Error: $phperrmsg\n" );
		exit( 1 );
	}
	$varLetter = "";
	while( list( $song_name ) = mysql_fetch_row( $varResult ) )
    {
		$varNewLetter = substr( $song_name, 0, 1 );
		if ( $varLetter != $varNewLetter )
        {
			$varHighLetter = strtoupper( $varNewLetter );
			echo( "<a href=\"list.php?subInitial=$varNewLetter\" " );
            echo( "target=\"songlist\">$varHighLetter</a>\n" );
			$varLetter = $varNewLetter;
		}
	}

?>

<br>
<a href="list_all.php" target="songlist">All Songs</a>
 <!--&nbsp; &nbsp; <a href="search.php?subSongName=yes"
 target="songlist">Search</a>-->
 &nbsp; &nbsp; <a href="info.html" target="details">About</a>
<!-- &nbsp; &nbsp; <a href="stats.php" target="details">Stats</a>--></b>
</p> 

</body></html>
