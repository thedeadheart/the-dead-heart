<!--MRKelly 2002-->
<!--The Dead Heart www.deadheart.org.uk-->
<html><head><title>Articles</title></head>
<body bgcolor="#FFFFFF" background="bg.gif">
<table width=100% border=0><tr><td valign=top width=125>
<a href="/main_page.html"><img src="/images/nav-tdh-blue.gif" alt="The Dead Heart" width=121 height=42 border=0></A><br>
<a href="/opinion/"><IMG src="/images/nav-opinion-blue.gif" alt="Opinion" width=121 height=42 vspace=4 border=0></A>
</td>
<td valign=top>
<img src="hd-art.gif" alt="Articles" width=138 height=42 border=0><p>

<font face="Arial" size=3>

<?  require( "db_conf.inc.php" );
        
    $dbh = mysql_connect( HOST, USER, PASS );	
    
	//	Interviews
	
    $query = "SELECT article_id, article_heading, article_author, article_type 
                FROM arts_articles
				WHERE article_type='int'";
    $result = mysql( DBNAME, $query, $dbh );

	echo ( "<a name=\"int\"><h3>Interviews</h3>" );
	echo ( "<p>\n" );
	echo ( "<ol>" );
     
    while ( list( $article_id, $article_heading, 
               $article_author, $article_type ) = mysql_fetch_row( $result ) )
    {
		echo ( "<li>" );

		if ( $article_heading )
		{
			echo ( "<a href=\"int.php?article_id=$article_id\">" );
			echo ( $article_heading );
			echo ( "</a>" );
			if ( $article_author )
			{
				echo ( " - $article_author" );
			}
		}
		else if ( $article_author )
		{
			echo ( "By " );
			echo ( "<a href=\"int.php?article_id=$article_id\">" );
			echo ( "$article_author" );
			echo ( "</a>" );
		}
		else
		{
			echo ( "<a href=\"int.php?article_id=$article_id\">" );
			echo ( "Untitled piece" );
			echo ( "</a>" );
		}
		echo ( "\n" );
	}
	echo ( "</ol>\n" );
	echo ( "</p>\n\n" );
	
	//	Essays
	
    $query = "SELECT article_id, article_heading, article_author, article_type 
                FROM arts_articles
				WHERE article_type='ess'";
    $result = mysql( DBNAME, $query, $dbh );

	echo ( "<a name=\"art\"><h3>Essays</h3>" );
	echo ( "<p>\n" );
	echo ( "<ol>" );
     
    while ( list( $article_id, $article_heading, 
               $article_author, $article_type ) = mysql_fetch_row( $result ) )
    {
		echo ( "<li>" );

		if ( $article_heading )
		{
			echo ( "<a href=\"essay.php?article_id=$article_id\">" );
			echo ( $article_heading );
			echo ( "</a>" );
			if ( $article_author )
			{
				echo ( " - $article_author" );
			}
		}
		else if ( $article_author )
		{
			echo ( "By " );
			echo ( "<a href=\"essay.php?article_id=$article_id\">" );
			echo ( "$article_author" );
			echo ( "</a>" );
		}
		else
		{
			echo ( "<a href=\"essay.php?article_id=$article_id\">" );
			echo ( "Untitled piece" );
			echo ( "</a>" );
		}
		echo ( "\n" );
	}
	echo ( "</ol>\n" );
	echo ( "</p>\n\n" );

	//	Miscellaneous
	
    $query = "SELECT article_id, article_heading, article_author, article_type 
                FROM arts_articles
				WHERE article_type='mis'";
    $result = mysql( DBNAME, $query, $dbh );

	echo ( "<a name=\"misc\"><h3>Miscellaneous</h3>" );
	echo ( "<p>\n" );
	echo ( "<ol>" );
     
    while ( list( $article_id, $article_heading, 
               $article_author, $article_type ) = mysql_fetch_row( $result ) )
    {
		echo ( "<li>" );

		if ( $article_heading )
		{
			echo ( "<a href=\"misc.php?article_id=$article_id\">" );
			echo ( $article_heading );
			echo ( "</a>" );
			if ( $article_author )
			{
				echo ( " - $article_author" );
			}
		}
		else if ( $article_author )
		{
			echo ( "By " );
			echo ( "<a href=\"misc.php?article_id=$article_id\">" );
			echo ( "$article_author" );
			echo ( "</a>" );
		}
		else
		{
			echo ( "<a href=\"misc.php?article_id=$article_id\">" );
			echo ( "Untitled piece" );
			echo ( "</a>" );
		}
		echo ( "\n" );
	}
	echo ( "</ol>\n" );
	echo ( "</p>\n\n" );
	
?>

<p>The above material has been collected from around the web and magazines.
Most of it has been copyrighted, but due to this uncommercial nature of use,
it is not believed to harm any of the parties involved. If anyone would like
to authorise their work which they see above, please contact the site through
the link at the bottom of your article.<br>
Thanks for reading this disclaimer</p>


</td></table>
</BODY></HTML>
