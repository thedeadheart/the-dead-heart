<!-- MKelly 2000 -->
<!-- The Dead Heart www.deadheart.org.uk -->
<HTML>
<link href="songdb.css" rel="STYLESHEET" type="text/css">
<style type="text/css">
A {	text-decoration : none;
	color : White;}
P { color : White;}
</style>
<HEAD><TITLE>Insert Results</TITLE></HEAD>
<body bgcolor="#000000">

<h1>Insert Results</h1>

<? 	require('conf.inc.php3');

	require('func.inc.php3');

	/* 
	 * Prepare fields
	 * Get rid of spaces and apostrophes in song titles in order to form 
	 * good id_name's. Note: need to stripslashes other wise regexp 
	 * doesn't work. Remove brackets also!
	 * Also set up defaults for when fields are not filled in.
	 */
		 
	$id_name = strtolower(ereg_replace(" +", "_", stripslashes($song_name)));
	$id_name = ereg_replace("'+", '', $id_name);
	$id_name = ereg_replace("\(+", '', $id_name);
	$id_name = ereg_replace("\)+", '', $id_name);
	if ($writers == "") {$writers = "Unspecified";}
	if ($ver_details == "") {$ver_details = "&nbsp;";}
	if ($prod_details == "") {$prod_details = "&nbsp;";}
	if ($lyrics == "") {$lyrics = "&nbsp;";}
	if ($tab == "") {$tab ="None";}
	
	/* temp stuff here */ 
	
	/* end of temp */
	
	/* 
	 * If the confirm flag is set to "yes", it is okay to proceed with 
	 * the insert of the information.
	 */
	if ($confirm == "yes") {
		/* 
		 * if not enough fields specified print error message...
		 */
		if ($id_name == "" or $song_name == "" or $orig_ver == "") {
			echo ("<p>You did not specify enough fields</p>");
		}
		/*
		 * ...otherwise insert the data. 
		 */
		else {
			$dbh = mysql_connect($host, $user, $pass) or die ("Problem connecting to DataBase");

			$writer_id_output = writer_name_to_id($writers, $dbname, $dbh);
			
			$query = "insert into songs values ('$id_name','$song_name','$writer_id_output','$orig_ver','$ver_details','$prod_details','$lyrics','$tab')";
			$result = mysql_db_query($dbname, $query, $dbh);
			$numrows = mysql_affected_rows();
			if ($numrows == 1) {		
				echo("<p>The entry for ".stripslashes($song_name)." has been added</p>");
				$fd = fopen ("sqllog", "a");
				fwrite ($fd, $query.";\n");
				fclose ($fd);
			}
			else {
				echo("<p>The entry for ".stripslashes($song_name)." has <b>not</b> been added</p>");
			}
		}
	}
	
	else  if ($confirm == "no") {
	/* 
	 * Strip slashes away from quoted characters so that the form 
	 * data is exactly as it was when it was passed to the page 
	 * originally.
	 */
	$id_name = stripslashes($id_name);
	$song_name = stripslashes($song_name);
	$writers = stripslashes($writers);
	$orig_ver = stripslashes($orig_ver);
	$ver_details = stripslashes($ver_details);
	$prod_details = stripslashes($prod_details);
	$tab = stripslashes($tab);
	$lyrics = stripslashes($lyrics);
	
	/*
	 * Create form for confirmation of entry data
	 */ 
	echo ("<form method=\"post\" action=\"insertdb.php3\"><p>Song Name: - <br>\n
	<input type=\"text\" name=\"song_name\" value=\"$song_name\" size=50 maxlength=60></p>\n
	<p>Writers: - <br><input type=\"text\" name=\"writers\" value=\"$writers\" size=50 maxlength=60></p>\n
	<p>Original Version: - <br><input type=\"text\" name=\"orig_ver\" value=\"$orig_ver\" size=50 maxlength=60></p>\n
	<p>Tab: - <br><input type=\"text\" name=\"tab\" value=\"$tab\" size=50 maxlength=60></p>\n
	<p>Version Details: - </p>\n<textarea name=\"ver_details\" cols=50 rows=5 wrap=\"PHYSICAL\">$ver_details</textarea>\n
	<p>Production Details: - </p>\n<textarea name=\"prod_details\" cols=50 rows=5 wrap=\"PHYSICAL\">$prod_details</textarea>\n
	<p>Lyrics: - </p>\n<textarea name=\"lyrics\" cols=50 rows=5 wrap=\"PHYSICAL\">$lyrics</textarea>\n
	<p>Submit: - <select name=\"confirm\" size=\"1\"><option value=\"no\">No</option>\n
	<option value=\"yes\">Yes</option></select></p>\n
	<p><input type=\"Submit\" name=\"submit\" value=\"Submit\">\n</p>\n
	</form>\n");	
	}
	
	echo ("<p><a href=\"pw_check.php3?al_in=true\"><b>Return</b></a> to the admin menu.</p>");
	
?>

</body></html>