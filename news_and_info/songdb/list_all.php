<!-- MRKelly 2004 -->
<!-- The Dead Heart http://www.deadheart.org.uk/ -->
<!-- Song Database -->
<?  
    require( 'conf.inc.php' );
    require( 'sdb.func.inc.php' );
?>

<html><head>
<link REL=stylesheet HREF="songdb.css" TYPE="text/css">
<style type="text/css">
a {	text-decoration : none;
	color : #FFFFFF;}
b { font-weight : bold;}
</style>
<title>Song List</title></head>
<body bgcolor="#000000">

<?  
	$varDBHandle = initDB();
	$varQuery = "SELECT song_id, song_name
        FROM songs
        ORDER BY song_name ASC";
	$varResult = mysql_query( $varQuery, $varDBHandle );
	if( $result == -1 )
    {
		echo( "Error: $phperrmsg\n" );
		exit( 1 );
	}
	$varLetter = "";
	while( list( $dbVarSongId, $dbVarSongName ) 
            = mysql_fetch_row( $varResult ) )
    {
		$varNewLetter = substr( $dbVarSongName, 0, 1 );
		if( $varLetter != $varNewLetter )
        {
			$varHighLetter = strtoupper( $varNewLetter );
			echo( "</p>\n\n<p><b><a name=\"$varNewLetter\">$varHighLetter</a></b><br>\n");
			$varLetter = $varNewLetter;
		}
		echo( "<a href=\"song.php?subSongId=$dbVarSongId\" " );
        echo( "target=\"details\">$dbVarSongName</a><br>\n" );
	}

?>

</body></html>
