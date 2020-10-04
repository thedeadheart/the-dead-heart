<!-- MRKelly 2004 -->
<!-- The Dead Heart www.deadheart.org.uk -->
<html><head><title>Other Sites</title></head>
<body background="/images/bg-diesel-logo-black.gif" BGCOLOR="#000000" TEXT="#FFFFFF" LINK="#A4C8F0" VLINK="#C0DCC0">

<table width=100%>
<td valign=top width=125>
<a href="/main_page.html"><img src="/images/nav-tdh-blue.gif" alt="The Dead Heart" width=121 height=42 border=0></a><br>
<a href="/news_and_info/"><IMG src="/images/nav-news_and_info-blue.gif" alt="News & Info" width=121 height=42 vspace=4 border=0></A>
</td>

<td width="100%">
<p><img src="hd-os.gif" alt="Other Sites" width=169 height=42></p>

<?  
    require( "db_conf.inc.php" );
		
    mysql_connect( HOST, USER, PASS );
    mysql_select_db( DBNAME );

	if ( $sub_action == "add" )
    {
		$var_query = "INSERT INTO links (link_url, link_description, 
                            link_sender, link_email, link_status)
                        VALUES ('$sub_link_url','$sub_link_description','$sub_link_sender','$sub_link_email','U')";
		$var_result = mysql_query( $var_query );
		
		echo( "<p>" );
		echo( "<a href=\"$sub_link_url\">$sub_link_description</a><br>\n" );
		echo( "Submitted by <a href=\"mailto:$sub_link_email\">$sub_link_sender</a>\n" );
		echo( "</p>\n" );
		echo( "<p>Thanks for the link - it will be evaluated soon, and if suitable, added to the site.</p>\n" );
        echo( "<p>Back to the <a href=\"other_sites.php\">links page</a></p>" );
	}

	else {
		$var_query = "SELECT link_url, link_description
					FROM links
					WHERE link_status = 'A'
					ORDER BY link_id";
        $var_result = mysql_query( $var_query );
        echo( "<p>" );
        while ( list( $db_var_link_url, $db_var_link_description ) = 
                mysql_fetch_row( $var_result ) )
        {
            echo( "<a href=\"$db_var_link_url\">$db_var_link_description</a><br>" );
        }
		echo( "</p>" );
	}
?>

<h2>Submit a Link</h2>

<p><form action="other_sites.php" method="POST">

<table>
    <tr>
        <td>URL:</td>
        <td><input type="text" name="sub_link_url" maxlength="255"></td>
    </tr>
    <tr>
        <td>Description:</td>
        <td><input type="Text" name="sub_link_description" maxlength="255"></td>
    <tr>
    </tr>
        <td>Name:</td>
        <td><input type="text" name="sub_link_sender" maxlength="80"></td>
    <tr>
    </tr>
        <td>E-mail:</td>
        <td><input type="text" name="sub_link_email" maxlength="80"></td>
    </tr>
</table>

<input type="hidden" name="sub_action" value="add">

<input type="Submit">
</form>

</p>

</td></table></body></html>
