<!-- MRKelly 2003-->
<!-- The Dead Heart www.deadheart.org.uk -->
<html><head>
<link rel=stylesheet href="/general.css" type="text/css">
<title>Quote of the Month Archive</title></head>
<body background="/images/bg-ripples-pink.gif" bgcolor="#FFFFFF">

<table width=100%>
<td valign=top width=125>
<a href="/main_page.php"><img src="/images/nav-tdh-blue.gif" alt="The Dead Heart" width=121 height=42 border=0></A><br>
<a href="/opinion/"><IMG src="/images/nav-opinion-blue.gif" alt="Opinion" width=121 height=42 vspace=4 border=0></A>
</td>

<td width="100%">
<p><img src="hd-qotm.gif" alt="Quote Of the Month Archive" width=448 height=42 border=0></p>

<p>The Quote Of The Month has changed somewhat in that it is no longer "... Of
The Month" (at least for the time being.) For the next while all quotes 
approved by TDH will be put on display, and a random pick will be displayed 
on the main page. In the future visitors will be able to vote for their 
favourite quote each month with the winner being given pride of place on 
the main page. In the meantime why not nominate 
<a href="add_quote.php">your own</a> quote. You might want to check the 
<a href="old_quotes.php">former Quotes of the Month</a> to ensure you don't 
duplicate an existing quote.
</p>

<h2>Submitted Quotes</h2>

<?

require( "db_conf.inc.php" );
    
mysql_connect( HOST, USER, PASS );
mysql_select_db( DBNAME );

if ( $subAction == "" or $subAction == "list" )
{
    $strQuery = "SELECT quote_id, quote_body, quote_song_name, 
            quote_album_name, quote_submittor_name, quote_link
        FROM quotes
        WHERE quote_status = 'A' 
        ORDER BY quote_id";
    $intResult = mysql_query( $strQuery );
    
    while( list( $dbVarQuoteId, $dbVarQuoteBody, $dbVarQuoteSongName, 
                    $dbVarQuoteAlbumName, $dbVarQuoteSubmittorName, 
                    $dbVarQuoteLink ) = 
                mysql_fetch_row( $intResult ) )
    {
        echo( "<p>\n" );
        echo( "<em>\"$dbVarQuoteBody\"</em><br>\n" );
        //  Only create a link if one is stored in DB
        if( $dbVarQuoteLink != "" )
        {
            echo( "<a href=\"$dbVarQuoteLink\">" );
        }
        echo( "$dbVarQuoteSongName - $dbVarQuoteAlbumName" );
        if( $dbVarQuoteLink != "" )
        {
            echo( "</a>\n" );
        }
        echo( "<br>\n" );
        echo( "Submitted by: $dbVarQuoteSubmittorName</p>\n" );
        
    }
}
?>

</td></table>
</body></html>

