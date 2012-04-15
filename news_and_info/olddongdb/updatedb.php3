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

<? 	require('conf.inc.php3');

	require('func.inc.php3');
		
	/* 
	 * Strip slashes away from quoted characters so that the form 
	 * data is exactly as it was when it was passed to the page 
	 * originally. Only for $song_name, as in this else statement 
	 * it is the only data that was passed *through* the form
	 */
	$song_name = stripslashes($song_name);
	/*
	 * Prepare remaining fields
	 */
	$id_name = strtolower(ereg_replace(" +", "_", $song_name));
	$id_name = ereg_replace("'+", '', $id_name);
	if ($writers == "") {$writers = "Unspecified";}
	if ($ver_details == "") {$ver_details = "&nbsp;";}
	if ($prod_details == "") {$prod_details = "&nbsp;";}
	if ($lyrics == "") {$lyrics = "&nbsp;";}
	if ($tab == "") {$tab = "None";}
	
	/* 
	 * If "Update" has not been set to "yes" then just query the database 
	 * in order to fetch the information for the specified song...
	 */
	if ($update == "no") {
		$dbh = @mysql_connect($host, $user, $pass) or die ("Problem connecting to DataBase");
		$query = "select writers, orig_ver, ver_details, prod_details, lyrics, tab from songs where id_name='$id_name'";
		$result = mysql_db_query($dbname, $query, $dbh);
		list($writers, $orig_ver, $ver_details, $prod_details, $lyrics, $tab) = mysql_fetch_row($result);
		/* 
		 * $writers should always contain something, so if it does, create
		 * the form for changes to be made into...
		 */
		if($writers != "") {
			/* Change writer ids to names */
			$writer_name_output = writer_id_to_name($writers, $dbname, $dbh);
			
			/* Draw up form for confirmation */
			echo ("<form method=\"post\" action=\"updatedb.php3\">\n
					<p>Song Name: - <br>\n
						<input type=\"text\" name=\"song_name\" value=\"$song_name\" size=\"50\" maxlength=\"60\"></p>\n
					<p>Writers: - <br>\n
						<input type=\"text\" name=\"writers\" value=\"$writer_name_output\" size=\"50\" maxlength=\"60\"></p>\n
					<p>Original Version: - <br>\n
						<input type=\"text\" name=\"orig_ver\" value=\"$orig_ver\" size=\"50\" maxlength=\"60\"></p>\n
					<p>Tab: - <br>\n
						<input type=\"text\" name=\"tab\" value=\"$tab\" size=\"50\" maxlength=\"60\"></p>\n
					<p>Version Details: - </p>\n
						<textarea name=\"ver_details\" cols=\"50\" rows=\"5\" 
						wrap=\"PHYSICAL\">$ver_details</textarea><br>\n
					<p>Production Details: - </p>\n
						<textarea name=\"prod_details\" cols=\"50\" rows=\"5\" 
						wrap=\"PHYSICAL\">$prod_details</textarea><br>\n
					<p>Lyrics: -</p>\n
						<textarea name=\"lyrics\" cols=\"50\" rows=\"5\" 
						wrap=\"PHYSICAL\">$lyrics</textarea><br>\n
					<p>Update: - 
						<select name=\"update\" size=\"1\">
							<option value=\"no\">No</option>\n
							<option value=\"yes\">Yes</option>
						</select>
					</p>\n
					<p><input type=\"Submit\" name=\"submit\" value=\"Submit\">\n
					<input type=\"Reset\" name=\"reset\"></p>\n
					</form>\n");
			echo ("<p><a href=\"pw_check.php3?al_in=true\"><b>Return</b></a> to the admin menu.</p>");
		}
		/* 
		 * ...otherwise redisplay entry field
		 */
		else {
			/* 
			 * Strip slashes away from quoted characters so that the form 
			 * data is exactly as it was when it was passed to the page 
			 * originally. Only for $song_name, as in this else statement 
			 * it is the only data that was passed *through* the form
			 */
			//$song_name = stripslashes($song_name);
			echo("<p>Sorry that song name doesn't exist - please try again!</p>\n
				<form method=\"post\" action=\"updatedb.php3\">
				<p>Song Name: - <br>
				<input type=\"Text\" name=\"song_name\" size=\"60\" maxlength=\"60\" value=\"$song_name\"></p>
				<input type=\"Hidden\" name=\"update\" value=\"no\">
				<input type=\"Submit\" name=\"submit\" value=\"Submit\"> 
				<input type=\"Reset\" name=\"reset\"></form>");
		}		
	}
	/* 
	 * ...otherwise perform checks, then update the database
	 */
	else  if ($update == "yes") {
		/* 
		 * Check if essential fields have not been populated...
		 */
		if ($id_name == "" or $song_name == "" or $orig_ver == "") {
			echo ("<p>You did not specify enough fields</p>");
		}
		/* 
		 * ...otherwise if they have been populated, convert writer 
		 * names to ids, then run the update query.
		 */
		else {
			$dbh = @mysql_connect($host, $user, $pass) or die ("Problem connecting to database");
			$writer_id_output = writer_name_to_id($writers, $dbname, $dbh);
			$query = "update songs set writers = '$writer_id_output', orig_ver = '$orig_ver', ver_details = '$ver_details', prod_details = '$prod_details', lyrics = '$lyrics', tab = '$tab' where id_name = '$id_name'";
			$result = @mysql_db_query($dbname, $query, $dbh) or die("<p>$query Update query failed</p>");
			
			if ($result) {
				echo ("<p>Updated successfully</p>");
				$fd = fopen ("sqllog", "a");
				fwrite ($fd, $query.";\n");
				fclose ($fd);
			}
			else {
				echo ("<p>Failed due to $phperrmsg</p>");
			}
		echo ("<p><a href=\"pw_check.php3?al_in=true\"><b>Return</b></a> to the admin menu.</p>");
		}
	}
	
?>

</body></html>