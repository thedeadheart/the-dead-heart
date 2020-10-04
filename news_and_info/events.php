<!--MRKelly 2001-->
<!--The Dead Heart www.deadheart.org.uk-->
<html><head>
<link rel=stylesheet href="/general.css" type="text/css">
<title>Upcoming Events</title></head>
<body background="/images/bg-ripples-pink.gif" bgcolor="#FFFFFF">

<table width=100%>
<td width=125 valign=top>
<a href="/main_page.html"><IMG src="/images/nav-tdh-blue.gif" alt="The Dead Heart" width=121 height=42 border=0></A><br>
<a href="/news_and_info/"><IMG src="/images/nav-news_and_info-blue.gif" alt="Media" width="121" height="42" vspace="4" border="0"></A><br>
</td>
<td valign=top width="100%">
<img src="/images/headers/hd-ue.gif" alt="Upcoming Events" width=306 height=42 border=0>

<?
    require( "db_conf.inc.php" );
    require( "human_date.inc.php" );
        
	$dbh = mysql_connect( HOST, USER, PASS );	

/* List the events in the queue

 */        

	$query = "SELECT event_time, event_short_desc, event_long_desc
				FROM events
                WHERE event_time > NOW()
				ORDER BY event_time, event_short_desc";
	$result = mysql(DBNAME, $query, $dbh);
    
	while(list($event_time, $event_short_desc, $event_long_desc) = mysql_fetch_row($result))
    {
		echo("<p><b>".to_human_date($event_time, 1)."</b><br>\n");
        echo($event_short_desc);
        if ($mode == "long")
        {
		    echo("<br>\n$event_long_desc");
		}
        echo("</p>\n");
	}
	if ($mode == long)
	{
        echo("<p><a href=\"events.php\">Less details...</a></p>");
	}
    else
    {
        echo("<p><a href=\"events.php?mode=long\">More details...</a></p>");
    }
	
?>

</body></html>
