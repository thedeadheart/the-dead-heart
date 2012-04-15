<? 	/*
	 * HTML forms to manage the format table
	 */

	require("conf.inc.php");
	
	$dbh = mysql_connect(HOST, USER, PASS);
?>
<!-- MKelly 2000 -->
<!-- The Dead Heart http://www.deadheart.org.uk/ -->
<html><head><title>Format Maintenance</title></head>
<body bgcolor="#FFFFFF">

<h1>Format Maintenance</h1>

<?
	echo("<form name=\"addedt\" action=\"format_manage.php\" method=\"POST\">\n");
	echo("<table>\n");
	/* if edit select, then fill in form with details */
	if ($action == "edt") {	
		$query = "SELECT format_code, format_name, format_desc
					FROM format
					WHERE format_code = '$item'";
		$result = mysql_db_query(DBNAME, $query, $dbh);
		list($format_code, $format_name, $format_desc) = mysql_fetch_row($result);
		echo("\t<tr>\n");
		echo("\t\t<td>Code</td>\n");
		echo("\t\t<td>$format_code<input type=\"hidden\" name=\"format_code\" value=\"$format_code\"></td>\n");
		echo("\t</tr>\n");
		echo("\t<tr>\n");
		echo("\t\t<td>Name</td>\n");
		echo("\t\t<td><input type=\"text\" name=\"format_name\" size=\"25\" maxlength=\"25\" value='$format_name'></td>\n");
		echo("\t</tr>\n");
		echo("\t<tr>\n");
		echo("\t\t<td>Description</td>\n");
		echo("\t\t<td><textarea name=\"format_desc\" cols=\"60\" rows=\"4\" wrap=\"physical\">$format_desc</textarea></td>\n");
		echo("\t</tr>\n");
		echo("\t<tr>\n");
		echo("\t\t<td colspan=2><input type=\"hidden\" name=\"action\" value=\"upd\">\n");
		echo("\t\t<input type=\"submit\" name=\"submit\" value=\"Update\"></td>\n");
		echo("\t</tr>\n");

		mysql_free_result($result);
	}
	else {
		echo("\t<tr>\n");
		echo("\t\t<td>Code</td>\n");
		echo("\t\t<td><input type=\"text\" name=\"format_code\" size=\"3\" maxlength=\"3\"></td>\n");
		echo("\t</tr>\n");
		echo("\t<tr>\n");
		echo("\t\t<td>Name</td>\n");
		echo("\t\t<td><input type=\"text\" name=\"format_name\" size=\"25\" maxlength=\"25\"></td>\n");
		echo("\t</tr>\n");
		echo("\t<tr>\n");
		echo("\t\t<td>Description</td>\n");
		echo("\t\t<td><textarea name=\"format_desc\" cols=\"60\" rows=\"4\" wrap=\"physical\"></textarea></td>\n");
		echo("\t</tr>\n");
		echo("\t<tr>\n");
		echo("\t\t<td colspan=2><input type=\"hidden\" name=\"action\" value=\"add\">\n");
		echo("\t\t<input type=\"submit\" name=\"submit\" value=\"Add\"></td>\n");
		echo("\t</tr>\n");
	}

	echo("</table>\n");
	echo("</form>\n\n");
	
	/* Add a new format */
	if ($action == "add") {
	
		if ($format_code == "" or $format_name == "") {
			$error_num = 65535;
		}
		else {
			$query = "INSERT INTO format (format_code, format_name, format_desc)
						VALUES ('".strtoupper($format_code)."', '$format_name', '$format_desc')";
			$result = mysql_db_query(DBNAME, $query, $dbh);
			$error_num = mysql_errno($dbh);
		}
		
		if ($error_num > 0) {
			if ($error_num == 1062) {
				echo("<p>That code already exists, please go back and choose another.</p>\n");
			}
			else if ($error_num == 65535) {
				echo("<p>You must enter data for the code and name fields.</p>\n");
			}
			else {
				echo("<p>An error ($error_num) occurred, please go back and check the data, then try again.</p>\n");
			}
		}
	}
	
	/* Delete an existing format */
	else if ($action == "del") {
		$query = "DELETE FROM format
					WHERE format_code = '$item'";
		$result = mysql_db_query(DBNAME, $query, $dbh);
	}
	
	/* Update an existing format */
	else if ($action == "upd") {
		$query = "UPDATE format
					SET format_name = '$format_name', format_desc = '$format_desc'
					WHERE format_code = '$format_code'";
		$result = mysql_db_query(DBNAME, $query, $dbh);
	
	}

	$query = "SELECT format_code, format_name, format_desc
				FROM format
				ORDER BY format_code";
	$result = mysql_db_query(DBNAME, $query, $dbh);

	echo("<table border=1>\n");
	while (list($format_code, $format_name, $format_desc) = mysql_fetch_row($result)) {
		echo("\t<tr>\n");
		echo("\t\t<td>$format_code</td>\n");
		echo("\t\t<td>$format_name</td>\n");
		echo("\t\t<td>".substr($format_desc, 0, 50)."</td>\n");
		echo("\t\t<td><a href=\"format_manage.php?action=edt&item=$format_code\">Edit</a></td>\n");
		echo("\t\t<td><a href=\"format_manage.php?action=del&item=$format_code\">Delete</a></td>\n");
		echo("\t</tr>\n");
	}
	echo("</table>\n\n\n");
	mysql_free_result($result);
	
	mysql_close($dbh);
	
?>

</body></html>