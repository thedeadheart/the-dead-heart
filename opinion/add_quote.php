<!-- MRKelly 2003 -->
<!-- The Dead Heart www.deadheart.org.uk -->
<html><head>
<link rel=stylesheet href="/general.css" type="text/css">
<title>Quote Submissions</title></head>
<body background="/images/bg-ripples-pink.gif" bgcolor="#FFFFFF">

<table width=100%>
<td valign=top width=125>
<a href="/main_page.html"><img src="/images/nav-tdh-blue.gif" alt="The Dead Heart" width=121 height=42 border=0></A><br>
<a href="/opinion/"><IMG src="/images/nav-opinion-blue.gif" alt="Opinion" width=121 height=42 vspace=4 border=0></A>
</td>

<td width="100%">
<p><img src="hd-qotm.gif" alt="Quote Of the Month Archive" width=448 height=42 border=0></p>

<?
    function printForm()
    {
        echo( "<p><form action=\"add_quote.php\" name=\"qotm\" method=\"GET\">\n" );
        echo( "Name:-<br>\n" );
        echo( "<input name=\"subQuoteSubmittorName\" type=\"text\" size=30
                maxlength=50 value=\"$subQuoteSubmittorName\"><br>\n" );
        echo( "Song Name:-<br>\n" );
        echo( "<input type=text name=\"subQuoteSongName\" size=30 maxlength=60
                value=\"$subQuoteSongName\"><br>\n" );
        echo( "Album Name:-<br>\n" );
        echo( "<input type=text name=\"subQuoteAlbumName\" size=30
                maxlength=60 value=\"$subQuoteAlbumName\"><br>\n" );
        echo( "Quote:-<br>\n" );
        echo( "<textarea name=\"subQuoteBody\" rows=5 cols=70>$subQuoteBody</textarea><br><br>\n" );
        echo( "<input type=hidden name=\"subAction\" value=\"add_quote\">" );
        echo( "<input name=\"submit\" type=\"submit\" value=\"Send Quote\">\n" );
        echo( "<input name=\"reset\" type=\"reset\" value=\"Clear Form\"></p>\n" );
        echo( "</form>\n" );
        echo( "<p>Please don't try to send the quote multiple times, otherwise you'll simply waste space. Be patient if the server is a little slow.</p>\n" );
    }

    if ( $subAction == "add_quote" )
    {
        //  Check that all required values submitted
        if ( $subQuoteBody and $subQuoteSongName 
                and $subQuoteAlbumName and $subQuoteSubmittorName )
        {
            require( "db_conf.inc.php" );
            
            mysql_connect( HOST, USER, PASS );
            mysql_select_db( DBNAME );
            
            $strHtmledBody = preg_replace( "/\n/", "<br>", $subQuoteBody );
            
            $strQuery = "INSERT INTO quotes ( quote_body, quote_song_name,
                    quote_album_name, quote_submittor_name ) 
                VALUES ( '$strHtmledBody', '$subQuoteSongName', 
                    '$subQuoteAlbumName', '$subQuoteSubmittorName' )";
            
            $intResult = mysql_query( $strQuery );
            
            echo( "<p>Thank you for your submission - your quote has been
                    added to the list for approval. Please " );
            echo( "<a href=\"quotes.php\">check back</a> " );
            echo( "soon to see if it has been added.</p>" );
        }
        else
        {
            echo( "<p>You need to fully specify all the fields below!</p>" );
            
            printForm();
        }
    }
    else
    {
        printForm();
    }

?>

</td></table>
</body></html>

