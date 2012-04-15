<!--MKelly 2000-->
<!--The Dead Heart wwww.deadheart.org.uk -->
<HTML>
<link href="songdb.css" rel="STYLESHEET" type="text/css">
<HEAD><TITLE>Corrections</TITLE>
<STYLE type="text/css">
A {	text-decoration: none;
	color : #FFFFFF;}
B { font-weight : bold;}
</STYLE>
</HEAD>
<body bgcolor="#000000">
<h1>Corrections</h1>

<form action="correct_submit.php3" method="POST">
<p><table width="100%" border="0" cellspacing="0" cellpadding="3">

<tr>
<td background="tabbk.jpg" class="top">
	Name of song
</td>
</tr>
<tr>
<td class="bot">
	<? echo ("<input type=\"text\" name=\"song_name\" size=\"40\" maxlength=\"60\" value=\"$song_name\">"); ?>
</td>
</tr>
<tr>
<td background="udtabbk.jpg">
	&nbsp
</td>
</tr>

<tr>
<td background="tabbk.jpg" class="top">
	Corrected Information
</td>
</tr>
<tr>
<td class="bot">
	<textarea name="correct" cols="40" rows="8" wrap="PHYSICAL"></textarea>
</td>
</tr>
<tr>
<td background="udtabbk.jpg">
	&nbsp
</td>
</tr>

<tr>
<td background="tabbk.jpg" class="top">
	Your name and mail address
</td>
</tr>
<tr>
<td class="bot">
	<p>Please include a valid mail address if you wish for a copy of this correction to be sent to you. Otherwise leave the "email" field blank.<br>
	Your name: - <input type="Text" name="sender_name"><br>
	Your email: - <input type="Text" name="sender_mail"></p>
</td>
</tr>
<tr>
<td background="udtabbk.jpg">
	&nbsp
</td>
</tr>

<tr>
<td background="tabbk.jpg" class="top">
	&nbsp;
</td>
</tr>
<tr>
<td class="bot">
	<input type="Submit" name="submit" value="Submit Correction"> <input type="Reset">
</td>
</tr>
<tr>
<td background="udtabbk.jpg">
	&nbsp
</td>
</tr>

</table></p>

</form>
</BODY></HTML>