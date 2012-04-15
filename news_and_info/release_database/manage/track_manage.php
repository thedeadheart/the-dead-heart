<? 	/*
	 * HTML forms to manage the track table
	 */

	require("conf.inc.php");
	
	$dbh = mysql_connect(HOST, USER, PASS);
?>
<!-- MKelly 2000 -->
<!-- The Dead Heart http://www.deadheart.org.uk/ -->
<html><head><title>Track Maintenance</title></head>
<body bgcolor="#FFFFFF">
<h1>Track Maintenance</h1>

<?
	echo("<form name=\"addedt\" action=\"track_manage.php\" method=\"POST\">\n");
	echo("<table>\n");
	/* if edit select, then fill in form with details */
	if ($action == "edt") {	
		$query = "SELECT track_id, track_name, track_length
					FROM track
					WHERE track_id = '$item'";
		$result = mysql_db_query(DBNAME, $query, $dbh);
		list($track_id, $track_name, $track_length) = mysql_fetch_row($result);
		echo("\t\t<input type=\"hidden\" name=\"track_id\" value=\"$track_id\">\n");
		echo("\t<tr>\n");
		echo("\t\t<td>Name</td>\n");
		echo("\t\t<td><input type=\"text\" name=\"track_name\" size=\"80\" maxlength=\"80\" value=\"$track_name\"></td>\n");
		echo("\t</tr>\n");
		echo("\t<tr>\n");
		echo("\t\t<td>Length</td>\n");
		echo("\t\t<td><input type=\"text\" name=\"track_length\" size=\"5\" maxlength=\"5\" value=\"$track_length\"></td>\n");
		echo("\t</tr>\n");
		echo("\t<tr>\n");
		echo("\t\t<td colspan=2><input type=\"hidden\" name=\"action\" value=\"upd\">\n");
		echo("\t\t<input type=\"submit\" name=\"submit\" value=\"Update\"></td>\n");
		echo("\t</tr>\n");

		mysql_free_result($result);
	}
	else {
		echo("\t\t<td>Name</td>\n");
		echo("\t\t<td><input type=\"text\" name=\"track_name\" size=\"80\" maxlength=\"80\"></td>\n");
		echo("\t</tr>\n");
		echo("\t\t<td>Length</td>\n");
		echo("\t\t<td><input type=\"text\" name=\"track_length\" size=\"5\" maxlength=\"5\"></td>\n");
		echo("\t</tr>\n");
		echo("\t<tr>\n");
		echo("\t\t<td colspan=2><input type=\"hidden\" name=\"action\" value=\"add\">\n");
		echo("\t\t<input type=\"submit\" name=\"submit\" value=\"Add\"></td>\n");
		echo("\t</tr>\n");
	}

	echo("</table>\n");
	echo("</form>\n\n");
	
	/* Add a new track */
	if ($action == "add") {
	
		if ($track_name == "") {
			$error_num = 65535;
		}
		else {
			$query = "INSERT INTO track (track_name, track_length)
						VALUES ('$track_name', '$track_length')";
			$result = mysql_db_query(DBNAME, $query, $dbh);
			$error_num = mysql_errno($dbh);
		}
		
		if ($error_num > 0) {
			if ($error_num == 1062) {
				echo("<p>That id already exists, please go back and choose another.</p>\n");
			}
			else if ($error_num == 65535) {
				echo("<p>You must enter data for the name field.</p>\n");
			}
			else {
				echo("<p>An error ($error_num) occurred, please go back and check the data, then try again.</p>\n");
			}
		}
	}
	
	/* Delete an existing track */
	else if ($action == "del") {
		$query = "DELETE FROM track
					WHERE track_id = '$item'";
		$result = mysql_db_query(DBNAME, $query, $dbh);
	}
	
	/* Update an existing track */
	else if ($action == "upd") {
		$query = "UPDATE track
					SET track_name = '$track_name', track_length = '$track_length'
					WHERE track_id = '$track_id'";
		$result = mysql_db_query(DBNAME, $query, $dbh);
	
	}

	$query = "SELECT track_id, track_name, track_length
				FROM track
				ORDER BY track_name";
	$result = mysql_db_query(DBNAME, $query, $dbh);

	echo("<table border=1>\n");
	while (list($track_id, $track_name, $track_length) = mysql_fetch_row($result)) {
		echo("\t<tr>\n");
		echo("\t\t<td>$track_name</td>\n");
		echo("\t\t<td>$track_length</td>\n");
		echo("\t\t<td><a href=\"track_manage.php?action=edt&item=$track_id\">Edit</a></td>\n");
		echo("\t\t<td><a href=\"track_manage.php?action=del&item=$track_id\">Delete</a></td>\n");
		echo("\t</tr>\n");
	}
	echo("</table>\n\n\n");
	mysql_free_result($result);
	
	mysql_close($dbh);
	
?>

</body></html>