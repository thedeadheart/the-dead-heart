<!-- MRKelly 2003 -->
<!-- The Dead Heart www.deadheart.org.uk -->
<html><head>
<link href="articles.css" rel="STYLESHEET" type="text/css">
<title>Approve An Article</title></head>
<body bgcolor="#FFFFFF" background="bg.gif">

<table width=100% border=0>
<tr>
<td valign=top width=125>
	<a href="/main_page.php">
		<img src="/images/nav-tdh-blue.gif" alt="The Dead Heart" width=121 height=42 border=0></a><br>
	<a href="/opinion/">
		<IMG src="/images/nav-opinion-blue.gif" alt="Opinion" width=121 height=42 vspace=4 border=0></A><br>
	<a href="./#misc">
		<IMG src="articles.gif" alt="Articles" width=121 height=42 border=0></A>
</td>
<td valign=top>
<img src="hd-art.gif" alt="Articles" width=138 height=42 border=0><p>

<font size=3 face="Arial">

<?
	require( "main_conf.inc.php" );
	require( "db_conf.inc.php" );

    //  Check parameter $article_id is valid.
    
    if ( !$article_id )
    {
        //  Invalid - bomb out
		
		echo ("<p>Sorry, the article ID is invalid - go back to the previous
        page and try the link again. If you repeatedly see this message,
        please <a href=\"/contact/contact.php\">contact the site</a>. Thanks.</p>");

    }
    else
    {
    	//	Check that what action to take
		
		if ( $action == "submit" )
		{
			//	Check for valid details 
			if ( $details_email && $details_name )
			{
				$message_headers = 
					"From: TDH Admin <".WEBMASTER_ADDRESS.">\nReply-To: $details_name <$details_email>";
				$message_subject = 
					"Article approval information";
				$dbh = mysql_connect( HOST, USER, PASS );	
        
		        $query = "SELECT article_source, article_source_url, 
                        article_original_url, article_date, article_author, 
                        article_heading, article_body
	                    FROM arts_articles
    	                WHERE article_id = '$article_id'";
        		$result = mysql( DBNAME, $query, $dbh );
        
		        if ( list( $article_source, $article_source_url, $article_original_url, 
                        $article_date, $article_author, $article_heading, 
                        $article_body ) = mysql_fetch_row( $result ) )
				{
					$message_body = "Article: $article_heading\nID: $article_id\nAuthor: $article_author";
					$message_body = $message_body."\nContact: $details_name\nAddress: $details_email\n";
					
					if ( $approval == "Yes" )
					{
						$message_body = $message_body."\nArticle has been approved. No contact necessary.\n";
					}
					else
					{
						$message_body = $message_body."\nArticle is not approved. Contact necessary.\n";
					}
				
					//	Mail the details
					$mail_success = mail( WEBMASTER_ADDRESS, $message_subject, $message_body, $message_headers );
					
					//	If the mail command succeeded.
					if ( $mail_success )
					{
						//	If approval indicated...
						if ( $approval == "Yes" )
						{
							echo ( "<p>We appreciate your allowing us to use your article. If you wish to retract this permission at any time please do not hesitate to get in touch.</p>" );
						}
						else	//	No approval indicated.
						{
							echo ( "<p>Thanks, your details have been forwarded to the site. We will be in contact with you soon regarding your article.</p>" );
						}	//	End of approval check
					}
					else	//	Mailing failure!
					{
						echo ("<p>Sorry, there was a problem in sending the message at this time. If this problem recurs please <a href=\"/contact/contact.php\">contact the site</a>. Thanks.</p>");
					}	//	End of mail success check.
				}
				else
				{
					//	Another invalid article ID
					
					echo ("<p>Sorry, the article ID is invalid - go back to the previous page and try the link again. If you repeatedly see this message, please <a href=\"/contact/contact.php\">contact the site</a> with details. Thanks.</p>");
				}
			}
			else
			{
				echo ( "<p>Sorry, you did not supply any contact details, please go back and try again!</p>\n\n" );
			}
		}
		else
		{
		
	        //  Valid - connect to database
    	    require( "db_conf.inc.php" );
        	
	        $dbh = mysql_connect( HOST, USER, PASS );	
	        
	        $query = "SELECT article_source, article_source_url, 
	                        article_original_url, article_date, article_author, 
	                        article_heading, article_body, article_approved
	                    FROM arts_articles
	                    WHERE article_id = '$article_id'";
	        $result = mysql( DBNAME, $query, $dbh );
	        
	        if ( list( $article_source, $article_source_url, $article_original_url, 
	                        $article_date, $article_author, $article_heading, 
	                        $article_body, $article_approved ) = mysql_fetch_row( $result ) )
	        {
				echo( "<p>Article Heading: <b>" );
				if ( $article_heading )
				{
					echo ( $article_heading );
				}
				else
				{
					echo ( "(none)" );
				}
				echo( "</b><br>" );
				echo( "Article Author: <b>" );
				if ( $article_author )
				{
					echo ( $article_author );
				}
				else
				{
					echo ( "(unknown)" );
				}
				echo( "</b><br>" );
	
	            echo( "<p>If you are in a position to authorize the above article please enter your name and email addresses in the space below, and press the submit button. You will be contacted in order to be thanked for your generosity.</p>\n\n" );
	
				echo( "<form action=\"approve.php\" method=GET>\n
					<p>Name: <input name=\"details_name\" type=\"text\" value=\"\"><br>\n
					Email address: <input name=\"details_email\" type=\"text\" value=\"\"></p>\n
					<p>Please tick to indicate your approval of the use of the article - leave blank if you wish The Dead Heart to contact you regarding the current use of the article.<br>\n
					<input type=\"checkbox\" name=\"approval\" value=\"Yes\"><br>
					<input name=\"action\" type=\"hidden\" value=\"submit\">\n
					<input name=\"article_id\" type=\"hidden\" value=\"$article_id\">\n
					<input type=\"submit\" value=\"Send\"></p>\n
				</form>\n" );
    	        
        	}

        }

		echo( "<p>Return to the <a href=\"index.php\">article index</a>.</p>\n" ); 
		
    }
    
    

    
    //  Read configuration.
    
?>

</td></table>
</BODY></HTML>
