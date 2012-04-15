<!-- MKelly 2000 -->
<!-- The Dead Heart www.deadheart.org.uk -->
<HTML>
<link href="songdb.css" rel="STYLESHEET" type="text/css">
<style type="text/css">
A {	text-decoration : none;
	color : White;}
P { color : White;}
</style>
<HEAD><TITLE>Update An Existing Entry</TITLE></HEAD>
<body bgcolor="#000000">

<h1>Update An Existing Entry</h1>

<? 	if(!$al_in) {
		echo ("<p>Sorry, you have attempted to access an admin page directly, without first going through the password pages.<br>Please <b><a href=\"pw_check.html\">return</a></b> and enter your username and password.</p></body></html>");
		exit();
	}
?>

<form method="post" action="updatedb.php3">

<p>Song Name: - <br><input type="Text" name="song_name" size="50" maxlength="60"></p>

<input type="Hidden" name="update" value="no">

<input type="Submit" name="submit" value="Submit"> <input type="Reset" name="reset">

</form>

<p><a href="update_list.php3">List of songs</a></p>

<p><a href="pw_check.php3?al_in=true"><b>Return</b></a> to the admin menu.</p>

</body></html>