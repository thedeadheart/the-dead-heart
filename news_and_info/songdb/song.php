<!-- MRKelly 2004 -->
<!-- The Dead Heart http://www.deadheart.org.uk/ -->
<!-- Song Database -->
<?  
    require( 'conf.inc.php' );
    require( 'sdb.func.inc.php' );
?>

<html>
<link href="songdb.css" rel="STYLESHEET" type="text/css">
<head><title>Song details</title>
<style type="text/css">
a {	text-decoration: none;
	color : #FFFFFF;}
b { font-weight : bold;}
</style>
</head>
<body bgcolor="#000000">

<? 	
	$varSearchString = stripslashes( $subSearchString );
	$varDBHandle = initDB();

	//if ($stats_on) {
	//	$stat_query = "update stats set views = views + 1";
	//	mysql_db_query($dbname, $stat_query, $dbh);
	//}
	
	$varQuery = "SELECT song_name, song_authors, song_notes, song_tab
        FROM songs
        WHERE song_id=\"$subSongId\"";
	$varResult = mysql_query( $varQuery, $varDBHandle );
	list( $dbVarSongName, $dbVarSongAuthors, $dbVarSongNotes, $dbVarSongTab ) 
            = mysql_fetch_row( $varResult );
	if( $varResult == -1 )
    {
		echo( "Error: $phperrmsg\n" );
		exit( 1 );
	}
	mysql_free_result( $varResult );
	
	$varSongAuthors = getArtistsAsString( $dbVarSongAuthors );
	
	if( $varSearchString )
    {
		$varSongName = eregi_replace( $varSearchString, "<b>\\0</b>",
                $dbVarSongName );
		$varSongAuthors = eregi_replace($varSearchString, "<b>\\0</b>",
                $varSongAuthors );
		$varSongNotes = eregi_replace($varSearchString, "<b>\\0</b>",
                $dbVarSongNotes );
	}
    else
    {
        $varSongName = $dbVarSongName;
		$varSongAuthors = $varSongAuthors;
		$varSongNotes = $dbVarSongNotes;
    }

    if( !$subVersionId )
    {
        //  Display the original version if none was specified
        $varQuery = "SELECT version_id, version_name, version_prod_details,
                version_details, version_time, version_lyrics
            FROM versions
            WHERE version_song = '$subSongId'
            AND version_name = 'Original Version'";
        $varResult = mysql_query( $varQuery, $varDBHandle );

        if( mysql_num_rows( $varResult ) == 1 )
        {
            list( $dbVarVersionId, $dbVarVersionName,
                    $dbVarVersionProdDetails, $dbVarVersionDetails,
                    $dbVarVersionTime, $dbVarVersionLyrics ) 
                    = mysql_fetch_row( $varResult );
        }
    }
    else
    {
        $varQuery = "SELECT version_id, version_name, version_prod_details,
                version_details, version_time, version_lyrics
            FROM versions
            WHERE version_song = '$subSongId'
            AND version_id = '$subVersionId'";
        $varResult = mysql_query( $varQuery, $varDBHandle );

        if( mysql_num_rows( $varResult ) == 1 )
        {
            list( $dbVarVersionId, $dbVarVersionName,
                    $dbVarVersionProdDetails, $dbVarVersionDetails,
                    $dbVarVersionTime, $dbVarVersionLyrics ) 
                    = mysql_fetch_row( $varResult );
        }
    }


?>

<h1><? echo( $varSongName." (".$dbVarVersionName.")" ) ?></h1>

<p style="margin-right : 0;"><table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td background="tabbk.jpg" class="top">
	Written by: -
</td>
</tr>
<tr>
<td class="bot">
	<? echo( $varSongAuthors ) ?>
</td>
</tr>
<tr>
<td background="udtabbk.jpg">
	&nbsp
</td>
</tr>


<!-- SONG NOTES -->
<tr>
<td background="tabbk.jpg" class="top">
	General Song Notes: -
</td>
</tr>
<tr>
<td class="bot">
<?
    if( $varSongNotes )
    {
        echo( preg_replace( "/\n/", "<br>", $varSongNotes ) );
    }
    else
    {
        echo( "None." );
    }
?>
</td>
</tr>
<tr>
<td background="udtabbk.jpg">
	&nbsp
</td>
</tr>


<!-- PRODUCTION DETAILS -->
<tr>
<td background="tabbk.jpg" class="top">
	Production Details: -
</td>
</tr>
<tr>
<td class="bot">
<?
    echo( preg_replace( "/\n/", "<br>", $dbVarVersionProdDetails ) );
?>
</td>
</tr>
<tr>
<td background="udtabbk.jpg">
	&nbsp
</td>
</tr>


<!-- VERSION DETAILS -->
<tr>
<td background="tabbk.jpg" class="top">
    Other Version-Specific Details: -
</td>
</tr>
<tr>
<td class="bot">
<?
    if( $dbVarVersionDetails )
    {
        echo( preg_replace( "/\n/", "<br>", $dbVarVersionDetails ) );
    }
    else
    {
        echo( "None." );
    }
?>
</td>
</tr>
<tr>
<td background="udtabbk.jpg">
	&nbsp
</td>
</tr>


<!-- VERSION TIME -->
<tr>
<td background="tabbk.jpg" class="top">
    Track Time: -
</td>
</tr>
<tr>
<td class="bot">
<?
    if( $dbVarVersionTime )
    {
        echo( getTimeAsString( $dbVarVersionTime ) );
    }
    else
    {
        echo( "Unspecified" );
    }
?>
</td>
</tr>
<tr>
<td background="udtabbk.jpg">
	&nbsp
</td>
</tr>


<!-- VERSION LYRICS -->
<tr>
<td background="tabbk.jpg" class="top">
    Lyrics: -
</td>
</tr>
<tr>
<td class="bot">
<?
    if( $dbVarVersionLyrics )
    {
        echo( preg_replace( "/\n/", "<br>", $dbVarVersionLyrics ) );
    }
    else
    {
        echo( "No lyrics have been added yet." );
    }
?>
</td>
</tr>
<tr>
<td background="udtabbk.jpg">
	&nbsp
</td>
</tr>


<!-- VERSIONS -->
<tr>
<td background="tabbk.jpg" class="top">
	Versions: -
</td>
</tr>
<tr>
<td class="bot">
<?  
//  Display version details!
//  First display the original version
$varQuery = "SELECT version_id, version_name
    FROM versions
    WHERE version_song = '$subSongId'
    AND version_name = 'Original Version'";
$varResult = mysql_query( $varQuery, $varDBHandle );
$varFlagResults = false;

if( mysql_num_rows( $varResult ) == 1 )
{
    list( $dbVarVersionId, $dbVarVersionName ) 
            = mysql_fetch_row( $varResult );
    echo( "<a href=\"song.php" );
    echo( "?subSongId=$subSongId" );
    echo( "&subVersionId=$dbVarVersionId" );
    echo( "\">" );
    echo( $dbVarVersionName );
    echo( " <img src=\"sm-sprint.gif\" width=18 height=16 border=0 " );
    echo( "alt=\"Link\">" );
    echo( "</a><br>" );
    
    $varFlagResults = true;
}

$varQuery = "SELECT version_id, version_name
    FROM versions
    WHERE version_song = '$subSongId'
    AND version_name != 'Original Version'
    ORDER BY version_name";
$varResult = mysql_query( $varQuery, $varDBHandle );

if( mysql_num_rows( $varResult ) > 0 )
{
    while( list( $dbVarVersionId, $dbVarVersionName ) 
            = mysql_fetch_row( $varResult ) )
    {
        echo( "<a href=\"song.php" );
        echo( "?subSongId=$subSongId" );
        echo( "&subVersionId=$dbVarVersionId" );
        echo( "\">" );
        echo( $dbVarVersionName );
        echo( " <img src=\"sm-sprint.gif\" width=18 height=16 border=0 " );
        echo( "alt=\"Link\">" );
        echo( "</a><br>" );
    }
    $varFlagResults = true;
}

if ( !$varFlagResults ) //  No version details found!
{
    echo( "Sorry, there is no version data available." );
}
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
	Tablature: -
</td>
</tr>
<tr>
<td class="bot">
<?
    if ( $dbVarSongTab )
    { 
        echo( "<a href=\"/tablature/".$dbVarSongTab."\" target=\"_parent\">Yes " );
        echo( "<img src=\"sm-sprint.gif\" width=18 height=16 border=0 " );
        echo( "alt=\"Link\"></a>" );
    }
    else
    {
        echo( "None" );
    }
?>
</td>
</tr>
<tr>
<td background="udtabbk.jpg">
	&nbsp
</td>
</tr>


<!--<tr>
<td background="tabbk.jpg" class="top">
	Corrections?
</td>
</tr>
<tr>
<td class="bot">
<?
    echo( "<a href=\"correction.php?subSongId=$subSongId\">" );
    echo( "Submit a correction by clicking on this link " );
    echo( "<img src=\"sm-sprint.gif\" width=18 height=16 border=0 " );
    echo( "alt=\"Link\"></a>");
?>
</td>
</tr>
<tr>
<td background="udtabbk.jpg">
	&nbsp
</td>
</tr>-->
</table></p>


</body></html>
