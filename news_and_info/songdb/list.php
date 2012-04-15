<!-- MRKelly 2004 -->
<!-- The Dead Heart http://www.deadheart.org.uk/ -->
<!-- The Song Database -->

<HTML><HEAD>
<LINK REL=stylesheet HREF="songdb.css" TYPE="text/css">
<STYLE type="text/css">
A {	text-decoration : none;
	color : #FFFFFF;}
B { font-weight : bold;}
</STYLE>

<TITLE>Song List</TITLE></HEAD>
<body bgcolor="#000000">

<?  
    require( 'conf.inc.php' );
    require( 'sdb.func.inc.php' );

	$varDBHandle = initDB();
	$varQuery = "SELECT song_id, song_name
        FROM songs
        WHERE song_name LIKE '$subInitial%'
        ORDER BY song_name";
    debugEcho( $varQuery );
	$varResult = mysql_query( $varQuery, $varDBHandle );
	if( $varResult == -1 )
    {
		echo("Error: $phperrmsg\n");
		exit(1);
	}
	
	$varUpInitial = strtoupper( $subInitial );
	echo( "<h2>$varUpInitial</h2>\n" );
	
    while( list( $dbVarSongId, $dbVarSongName ) 
            = mysql_fetch_row( $varResult ) )
    {
		echo( "<a href=\"song.php?subSongId=$dbVarSongId\" target=\"details\">" );
        echo( $dbVarSongName );
        echo( "</a><br>\n" );
	}

?>

</BODY></HTML>
