<!-- MRKelly 2003 -->
<!-- The Dead Heart www.deadheart.org.uk -->
<html><head>
<title>The Dead Heart</title>
<link rel=stylesheet href="general.css" type="text/css">
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-4608571-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body background="images/bg-ripples-full-white.gif" bgcolor="#FFFFFF">

<table width=100% border=0>
	<tr>
		<td valign=top width=220>
			<center>
				<a href="/"><img src="/images/dh-logo-vert-white.gif" alt="The Dead Heart" width=212 height=245 border=0></a>
				<br>
				
				<font face="Arial">
				<h6>
					<a href="#latest">[latest news]</a> / 
					<a href="#new">[what's new]</a> / 
					<a href="#ud">[recently updated]</a> / 
					<a href="#qotm">[quote of the month]</a>
				</h6>
			</center>
		</td>
	
<!-- Heading and date here -->
<!-- ##################### -->
	
		<td valign=top>
			<center>
				<h4><font size=5><em>A Midnight Oil Homepage</em></font></h4>
				<b>Jun 2004</b>
				<table width=500 border=0 cellspacing=10>
					<tr>
						<td width=50% valign=top align=right>
							<p style="font-size:10pt;">
								<a href="/opinion/">
								<img src="/opinion/opinion.gif" alt="Opinions" width=194 height=51 border=0></a><br>
								<b><em>
								<a href="/opinion/live/">Oils Live!</a> / 
								<a href="/opinion/album_reviews/">Album Reviews</a><br>
								<a href="/opinion/quotes.php">QOTM Archive</a> / 
								<a href="/opinion/articles/">Articles</a><br>
								<a href="/opinion/talk_in_circles/">Talk in Circles</a> / 
								<a href="/opinion/feature/">Feature</a><br>
							</p>
						</td>
						
						<td width=50% valign=top align=left>
							<p style="font-size:10pt;">
								<a href="/media/">
								<img src="/media/media.gif" alt="Media" width=137 height=51 border=0></a><br>
								<b><em>
								<a href="/media/sounds.html">Sound Files</a> / 
								<a href="/media/videos/">Video Clips</a><br>
								<a href="/tablature/">Music and Tabs</a> / 
								<a href="/pictures/">Pictures</a> / 
								<a href="/media/lyrics/">Lyrics</a><br>
								<a href="/media/store/">The Mall</a> / 
								<a href="/media/download/">Downloads</a>
							</p>
						</td>
					</tr>
					
					<tr>
						<td valign=top align=right>
							<p style="font-size:10pt;">
								<a href="/contact/">
								<img src="/contact/contact.gif" alt="Contact" width=171 height=51 border=0></a><br>
								<b><em>
								<a href="/powderworks/">Powderworks Mailing List</a><br>
								<a href="/contact/welcome.html">Welcome</a> / 
								<a href="/contact/contact.php">Contact TDH</a><br>
								<a href="/contact/coming_soon.html">Coming Soon</a>
							</p>
						</td>
						
						<td valign=top align=left>
							<p style="font-size:10pt;"><a href="/news_and_info/"><img src="/news_and_info/newsinfo.gif" alt="News & Info" width=265 height=51 border=0></a><br>
                                <b><em>
								<a href="/discographies/">Discography</a> / 
								<a href="/news_and_info/songdb/">Song Database</a><br>
								<a href="/news_and_info/biography/">Biography</a> / 
								<a href="/news.php">Oil News</a> / 
								<a href="/news_and_info/faq/">Oils FAQ</a><br>
								<a href="/opinion/live/touring.htm">On Tour...</a> / 
								<a href="/news_and_info/other_sites.php">Oils and Aussie Sites</a><br>
								<a href="/news_and_info/atlas/">World Atlas</a>
							</p>
						</td>
					</tr>
				</table>
				
		</td>
	</tr>

	<tr>
        <td align="left">
			<?
                require( "db_conf.inc.php" );
                require( "human_date.inc.php" );
                
                mysql_connect( HOST, USER, PASS );	
                mysql_select_db ( DBNAME );

                $var_query = "SELECT event_time, event_short_desc
                               FROM events
                                WHERE event_time > NOW()
                                ORDER BY event_time, event_short_desc
                                LIMIT 3";
                $result = mysql_query( $var_query );
                
                
                echo( "<p style=\"font-size:10pt;\">" );
                echo( "<a href=\"/news_and_info/events.php\" style=\"font-size:12pt;\">" );
                echo( "<b>Upcoming Events...</b>" );
                echo( "</a><br>" );
                while( list( $db_var_event_time, $db_var_event_short_desc ) = mysql_fetch_row( $result ) )
                {
                    echo( "<b>".to_human_date( $db_var_event_time, false )."</b> - " );
                    echo( "$db_var_event_short_desc<br>" );
                }
                echo( "</p>" );
            ?>
		</td>
		<td align="center">
            <p style="font-family:Arial;"><b><a href="help.htm">Help me!!</a></b><br></p>
	    <script type="text/javascript"><!--
	    google_ad_client = "pub-6457913159491754";
	    google_ad_width = 728;
	    google_ad_height = 90;
	    google_ad_format = "728x90_as";
	    google_ad_type = "text";
	    google_ad_channel = "";
	    google_color_border = "D6D8AA";
	    google_color_bg = "FFFFF6";
	    google_color_link = "FF0000";
	    google_color_text = "000000";
	    google_color_url = "008000";
	    //--></script>
	    <script type="text/javascript"
	      src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
	      </script>
			<a href="/discographies/best_of_both_worlds/">
			<img src="discographies/best_of_both_worlds/best_of_both_worlds.gif" alt="Best Of Both Worlds" width="389" height="72" border="0"></a>
		</td>
	</tr>


<!-- ##################### -->
<!--       N E W S         -->
<!-- ##################### -->

	<tr>
		<td valign=top>
			<a href="news.php">
			<img src="/images/main-latest-news.gif" alt="Latest News" width=168 height=75 border=0></a>
		</td>
		
		<td valign=top><a name="latest">
			<font size=+1>

			<!-- Copy news from here... -->
			<? 
                $var_query = "SELECT news_id, news_about, news_heading
                                FROM news
                                ORDER BY news_date DESC, news_id DESC 
                                LIMIT 3";
    
                $var_result = mysql_query( $var_query );
                
                for ( $var_iter = 1; $var_iter <= 3; $var_iter++ )
                {
                    if (list( $db_var_news_id, $db_var_news_about, 
                            $db_var_news_heading ) = 
                            mysql_fetch_row( $var_result ) )
                    {
                        echo( "<a href=\"news.php#$var_iter\">\n" );
                        if ( $var_iter == 1 )
                        {
                            echo( "<b>" );
                        }
                        echo( "<b>$db_var_news_about:</b> $db_var_news_heading<br>\n" );
                        if ( $var_iter == 1 )
                        {
                            echo( "</b>" );
                        }
                    }
                } 
            ?>

			<!-- ...to here -->

			<br>
			<br>
		</td>
	</tr>

<? // Display What's new section
    
    require("main_conf.inc.php");
    
    if (DISPLAY_MP_WN)
    {
        echo ('
<!-- ##################### -->
<!--  W H A T \' S   N E W -->
<!-- ##################### -->
    
	<tr>
		<td valign=top>
			<img src="/images/main-whats-new.gif" alt="What\'s New" width=131 height=64 border=0>
		</td>

		<td>
            <a name="new">A new addition to the site is the <a href="/news_and_info/events.php">Upcoming Events</a> page.<br>
            The <a href="/discographies/#albums">Album Discography</a> has been updated to include <a href="/discographies/the_real_thing/the_real_thing.html">The Real Thing</a>.<br>
            The final addition for now is the new <a href="/news_and_info/release_database/">Release Database</a>. This database is intended to be a more factual replacement for the existing <a href="/discographies/">Discography</a> section.
            <br><br><p>
        </td>
    </tr>
    
');
    }

   // Display Recently Updated section
    
    if (DISPLAY_MP_RU)
    {
        echo ('
<!-- ################################# -->
<!--  R E C E N T L Y   U P D A T E D  -->
<!-- ################################# -->
    
    <tr>
        <td valign=top>
            <img src="/images/main-recently-updated.gif" alt="Recently Updated" width=166 height=74 border=0>
        </td>

        <td>
            <a name="ud"><p>
            After a long hiatus the Dead Heart has seen it\'s first update this
            month after more than a year of near inactivity. Many of the
            changes are under the skin, but areas of interest include a
            revamped (but incomplete data-wise) 
            <a href="/news_and_info/songdb/">Song Database</a> and the
            partially updated <a href="/opinion/quotes.php">Quotes</a>
            section. The <a href="news.php">news</a> system has been updated 
            for more flexibility, as has the 
            <a href="/news_and_info/other_sites.php">external links</a>
            section. There\'s also finally some reference to the existence of
            <a href="/discographies/capricornia/">Capricornia</a>. Something a
            lot of people have been asking for is updated details on joining
            the <a href="/powderworks/">Powderworks mailing list</a>. For
            information about what is still in the pipeline please visit the
            <a href="/contact/coming_soon.html">Coming Soon</a> page.
        </td>
    </tr>
    
');
    }
    
    // Display Quote Of The Month section
    
    if (DISPLAY_MP_QOTM)
    {
        echo ('
<!-- ################################### -->
<!-- Q U O T E   O F   T H E   M O N T H -->
<!-- ################################### -->
    
    <tr>
        <td valign=top>
            <a href="/opinion/quotes.php"><img src="/images/main-quote-of-the-month.gif" alt="Quote of the Month" width=105 height=57 border=0></a>
        </td>

        <td><a name="qotm">');
        

    $strQuery = "SELECT quote_id
        FROM quotes
        WHERE quote_status = 'A'";
    $intResult = mysql_query( $strQuery );
    $arrApprovedIDs = array();
    $dbVarQuoteId = 0;
    while( list( $dbVarQuoteId ) = mysql_fetch_row( $intResult ) )
    {
        $arrApprovedIDs[] = $dbVarQuoteId;
    }
    
    srand( (double)microtime()*1000000 );
    $intRandomQuote = rand( 0, ( count( $arrApprovedIDs) - 1 ) );
    
    $strQuery = "SELECT quote_id, quote_body, quote_song_name, 
            quote_album_name, quote_submittor_name, quote_link
        FROM quotes
        WHERE quote_id = ".$arrApprovedIDs[ $intRandomQuote ];
    $intResult = mysql_query( $strQuery );
    
    list( $dbVarQuoteId, $dbVarQuoteBody, $dbVarQuoteSongName, 
            $dbVarQuoteAlbumName, $dbVarQuoteSubmittorName, $dbVarQuoteLink 
            ) = mysql_fetch_row( $intResult );
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
    
    echo ('
        </td>
    </tr>

');
    }
?>

    <tr>
        <td colspan=2>
            <center><br><p style="font-size:9pt"><font size=1><a href="/opinion/">Opinion</a> / 
                <a href="/media/">Media</a> / 
                <a href="/contact/">Contact</a> / 
                <a href="/news_and_info/">News & Info</a></p>

        </td>
    </tr>
</table>

</body></html>
