<!--MRKelly 2002-->
<!--The Dead Heart www.deadheart.org.uk-->
<html><head>
<link href="articles.css" rel="STYLESHEET" type="text/css">
<title>Essays</title></head>
<body bgcolor="#FFFFFF" background="bg.gif">
<table width=100% border=0>
<tr>
<td valign=top width=125>
    <a href="/main_page.php"><img src="/images/nav-tdh-blue.gif" alt="The Dead Heart" width=121 height=42 border=0></A><br>
    <a href="/opinion/"><IMG src="/images/nav-opinion-blue.gif" alt="Opinion" width=121 height=42 vspace=4 border=0></A><br>
    <a href="./#art"><IMG src="articles.gif" alt="Articles" width=121 height=42 border=0></A>
</td>
<td valign=top>
<img src="hd-arte.gif" alt="Articles - Essays" width=285 height=42 border=0><p>

<font size=3 face="Arial">

<?
    //  Check parameter $article_id is valid.
    
    if ( !$article_id )
    {
        //  Invalid - bomb out
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
            //  Dump heading
            echo( "<p><em><font size=+2><u>$article_heading</u></font></em></p>\n\n" );
            
            //  Dump original article details
            
            //  Check for original article URL
            if ( $article_original_url )
            {
                echo ( "<p><font size=-1>(Original article online <a href=\"$article_original_url\">here</a>)</font></p>\n\n" );
            }
            
            //  Dump body
            
            echo ( $article_body );
            echo ( "\n\n" );
            
            echo( "<p><b><font size=4>From " );
            //  Check for original site URL
            if ( $article_source_url )
            {
                echo ( "<a href=\"$article_source_url\">" );
                echo ( $article_source );
                echo ( "</a>" );
            }
            else
            {
                echo ( $article_source );
            }
            //  Check that there is an author name.
            if ( $article_author )
            {
                echo ( ", by $article_author" );
            }
            echo ( "</font></b></p>\n\n" );
            
            if ( $article_approved == "Yes" )
            {
                echo( "<p><font size=-1><b>(Note:</b> this article has been approved for reproduction.)</font></p>\n\n" );
            }
            else
            {
                echo( "<p><font size=-1>(<b>Note:</b> this article has not been approved for reproduction.<br>If you are the author of this article <a href=\"approve.php?article_id=$article_id\">follow this link</a> to approve the article or ask for it to be removed.)</font></p>\n\n" );
            }
        }
        
        
    }
    
    

    
    //  Read configuration.
    
?>





</td></table>
</BODY></HTML>
