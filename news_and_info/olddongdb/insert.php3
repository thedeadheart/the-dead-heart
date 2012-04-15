<!-- MKelly 2000 -->
<!-- The Dead Heart www.deadheart.org.uk -->
<HTML>
<link href="songdb.css" rel="STYLESHEET" type="text/css">
<style type="text/css">
A {	text-decoration : none;
	color : White;}
P { color : White;}
</style>
<HEAD><TITLE>Insert New Entry</TITLE></HEAD>
<body bgcolor="#000000">

<h1>Insert New Entry</h1>

<? 	if(!$al_in) {
		echo ("<p>Sorry, you have attempted to access an admin page directly, without first going through the password pages.<br>Please <b><a href=\"pw_check.html\">return</a></b> and enter your username and password.</p>");
		exit();
	}
?>


<form method="post" action="insertdb.php3">

<p>Song Name: - <br><input type="Text" name="song_name" size="50" maxlength="60"></p>

<p>Writers: - <br><input type="Text" name="writers" size="50" maxlength="60"></p>

<p>Original Version: - <br><input type="Text" name="orig_ver" size="50" maxlength="60"></p>

<p>Tab: - <br><input type="Text" name="tab" size="50" maxlength="60"></p>

<p>Version Details: - </p><textarea name="ver_details" cols="65" rows="5" wrap="PHYSICAL"></textarea>

<p>Production Details: - </p><textarea name="prod_details" cols="65" rows="5" wrap="PHYSICAL"></textarea><br>

<p>Lyrics: - </p><textarea name="lyrics" cols="65" rows="5" wrap="PHYSICAL"></textarea><br>

<input type="Hidden" name="confirm" value="no">

<input type="Submit" name="submit" value="Submit"> <input type="Reset" name="reset">

</form>

<p><a href="pw_check.php3?al_in=true"><b>Return</b></a> to the admin menu.</p>

</body></html>