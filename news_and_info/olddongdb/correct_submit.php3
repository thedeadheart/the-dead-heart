<!--MKelly 2000-->
<!--The Dead Heart wwww.deadheart.org.uk -->
<HTML>
<link href="songdb.css" rel="STYLESHEET" type="text/css">
<HEAD><TITLE>Submission Results</TITLE>
<STYLE type="text/css">
A {	text-decoration: none;
	color : #FFFFFF;}
B { font-weight : bold;}
</STYLE>
</HEAD>
<body bgcolor="#000000">
<h1>Submission Results</h1>

<? 	if ($song_name == "" or $correct == "") {
		echo ("<p><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">
<tr>
<td background=\"tabbk.jpg\" class=\"top\">
	Error!
</td>
</tr>
<tr>
<td class=\"bot\">
	Sorry, you didn't submit enough data! Please go back and try again.
</td>
</tr>
<tr>
<td background=\"udtabbk.jpg\">
	&nbsp;
</td>
</tr>
</table></p>");
	}
	else {
		echo ("<p><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">
<tr>
<td background=\"tabbk.jpg\" class=\"top\">
	Thank you...
</td>
</tr>
<tr>
<td class=\"bot\">
	The information you supplied is being sent.<br>");
	$message = "Correction supplied by $sender_name ($sender_mail)\nregarding $song_name.\n\n$correct";
	$subject = "Song Database correction";
	$from = "From: www-mail@deadheart.org.uk\nReply-To: www-mail@deadheart.org.uk";
	mail("mkelly", $subject, $message, $from);
	
	if ($sender_mail != "") {
		mail($sender_mail, $subject, $message."\n\nThanks", $from);
		echo ("A copy has been forwarded to you");
	}
	
echo("</td>
</tr>
<tr>
<td background=\"udtabbk.jpg\">
	&nbsp;
</td>
</tr>
</table></p>");
	
	}
?>

</form>
</BODY></HTML>
