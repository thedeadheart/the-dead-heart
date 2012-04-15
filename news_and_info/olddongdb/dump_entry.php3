<!-- MKelly 2000 -->
<!-- The Dead Heart www.deadheart.org.uk -->
<HTML>
<link href="songdb.css" rel="STYLESHEET" type="text/css">
<style type="text/css">
A {	text-decoration : none;
	color : White;}
P { color : White;}
</style>
<HEAD><TITLE>Dump Loading</TITLE></HEAD>
<body bgcolor="#000000">

<?	require('conf.inc.php3'); ?>

<? 	if(!$al_in) {
		echo ("<p>Sorry, you have attempted to access an admin page directly, without first going through the password pages.<br>Please <b><a href=\"pw_check.html\">return</a></b> and enter your username and password.</p>");
		exit();
	}
?>

<h1>Dump Loading</h1>

<form action="dump_load.php3" method="POST">

<p>Query statements (semi-colon separated)</p>
<p><textarea name="sqlquery" cols="50" rows="10" wrap="PHYSICAL"></textarea></p>

<input type="Submit" name="submit" value="Submit">

</form>

<p><a href="pw_check.php3?al_in=true"><b>Return</b></a> to the admin menu.</p>

</body></html>