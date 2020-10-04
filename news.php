<!-- MRKelly 2002 -->
<!-- The Dead Heart www.deadheart.org.uk -->
<html><head><title>Midnight Oil News</title></head>
<body bgcolor="#000000" text="#ffffff" link="#a4c8f0" vlink="#c0dcc0">

<table width=100%>
<td valign=top width=125>
<a href="/main_page.html"><img src="/images/nav-tdh-blue.gif" alt="The Dead Heart" width=121 height=42 border=0></a><br>
<a href="/news_and_info/"><img src="/images/nav-news_and_info-blue.gif" alt="News & Info" width=121 height=42 vspace=4 border=0></A>
</td>
<td align=right>
<p><img src="/images/oilnews.gif" alt="Midnight Oil News" width=142 height=92></p>

<!--News Template
<p><font size=4><b></b></font><br>
<font size="5" color="#FFFF00"></font><br>
</p>
-->

<p><a href="oldnews.html">Old news stories</a></p>

<?  //  This portion of the code will read in the news stories from the 
    //  database.
    
    //  Connect to DB
    require( "db_conf.inc.php" );
    require( "human_date.inc.php" );
    
    mysql_connect( HOST, USER, PASS );
    mysql_select_db( DBNAME );
    
    $var_query = "SELECT news_id, news_date, news_about, news_heading, news_body
                    FROM news
                    ORDER BY news_date DESC, news_id DESC";
    
    $var_result = mysql_query( $var_query );
    
    for ( $var_iter = 1; $var_iter <= 3; $var_iter++ )
    {
        if (list( $db_var_news_id, $db_var_news_date, $db_var_news_about, 
                    $db_var_news_heading, $db_var_news_body ) = 
                mysql_fetch_row( $var_result ) )
        {
            echo( "<a name=\"$var_iter\">\n" );
            echo( "<p><font size=4><b>" );
            echo( to_human_date( $db_var_news_date, false ) );
            echo( "</b></font><br>\n" );
            echo( "<font size=5 color=\"#FFFF00\">$db_var_news_heading</font><br>\n" );
            echo( "<b>$db_var_news_about:</b> $db_var_news_body\n" );
            echo( "</p>\n\n" );
        }
    }
            
    while( list( $db_var_news_id, $db_var_news_date, $db_var_news_about, 
                $db_var_news_heading, $db_var_news_body ) = 
            mysql_fetch_row( $var_result ) )
    {
        echo( "<p><font size=4><b>" );
        echo( to_human_date( $db_var_news_date, false ) );
        echo( "</b></font><br>\n" );
        echo( "<font size=5 color=\"#FFFF00\">$db_var_news_heading</font><br>\n" );
        echo( "<b>$db_var_news_about:</b> $db_var_news_body\n" );
        echo( "</p>\n\n" );
    }


?>


</td></table></BODY></HTML>
