<?
    //  Maurice Kelly 2004
    //  www.deadheart.org.uk
    //  File: contact.php
    //  Purp: Form processing script to allow people to send emails to the
    //  site 
    require( "main_conf.inc.php" );
    
?>
<!--MKelly 2004-->
<!--The Dead Heart www.deadheart.org.uk-->
<html><head>
<link href="/general.css" rel="STYLESHEET" type="text/css">
<title>Contact The Dead Heart</title></head>
<body background="/images/bg-ripples-pink.gif" bgcolor="#ffffff">

<table width=100%>
<td valign=top width=125><a href="/main_page.php"><img src="/images/nav-tdh-blue.gif" alt="The Dead Heart" width=121 height=42 border=0></A><br>
<a href="/contact/"><img src="/images/nav-contact-blue.gif" alt="Contact" width=121 height=42 vspace=4 border=0></a></td>

<td width="100%">
<p><img src="hd-cont.gif" alt="Contact The Dead Heart" width=404 height=42 border=0></p>

<?
    //  Check to see if this is a valid mail submission
    if( $subMitMe and 
        strlen( $subSenderName ) > 0 and
        strlen( $subSenderAddress ) > 0 )
    {
        $strHeaders  = "From: TDH Admin <".WEBMASTER_ADDRESS.">\n";
        //$strHeaders .= "Reply-To: $subSenderName <$subSenderAddress>";
        $strSubject = "Your email to www.deadheart.org.uk";
        //  Append some text to start/end of body
        $strBody = "";
        $strBody .= "Feedback from $subSenderName ($subSenderAddress):\n";
        $strBody .= "-------------\n";
        $strBody .= stripslashes( $subMessage );
        $strBody .= "\n-------------\n";

        $flgMailSuccess = mail( 
            WEBMASTER_ADDRESS, 
            $strSubject, 
            $strBody, 
            $strHeaders );

        if( $flgMailSuccess )
        {
?>
<p>Your mail was sent successfully. If your message requires a reply we will
get back to you as soon as possible. Thanks for taking the time to visit the
site.</p>
<?
        }
        else
        {
?>
<p>Sorry, but your mail could not be sent at this time. Please try once more,
and if you still have no luck, then try again later.</p>
<?
        }
    }
    else
    {
?>

<p><font size=+1>Note to the spammer who was testing this form: it was a nice try
but I've caught on before you could send anything significant. My apologies to
anyone (if anyone) who may have received spam while this guy was
testing.</font></p>
    
<p>(To save confusion, this web-site is dedicated to the music of Midnight
Oil.)</p>
    
<p>Unfortunately due to the increasing problems associated with junk e-mail,   
it is no longer possible for us to publish an address to which you can send an
email directly. However, please feel free to use the form below in order to
communicate with the site. If you wish to contribute more than just text
(e.g. images, sound files,) then just drop us a line below and we'll get back
to you to discuss transfer options. Thanks.</p>

<p>Please note that all fields should be filled in.<p>

<form action="contact.php" method="Post">
<table cellpadding=0 cellspacing=0 border=0>
<tr>
<td valign=top>Name :</td>
<td><input name="subSenderName" value="<? echo $subSenderName ?>"type="text" size=50 maxlength=50 ></td>
</tr>
<tr>
<td>E-mail address :</td>
<td><input name="subSenderAddress" value="<? echo $subSenderAddress ?>"type="text" size=50 maxlength=50></td>
</tr>
<tr>
<td valign="top">Comments :</td>
<td><textarea name="subMessage" rows=6 cols=50 wrap=PHYSICAL>
<? echo stripslashes( $subMessage ) ?></textarea></td>
</tr>
<tr>
<td><input name="subMitMe" value="Send" type="submit"></p></td>
</tr>
</table>
</form>
<?
    }
?>

</td></table></body></html>
