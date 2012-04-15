<? 	/*
	 * HTML forms to manage the rec_label table
	 */

	require("conf.inc.php");
	
	$dbh = mysql_connect(HOST, USER, PASS);
?>
<!-- MKelly 2000 -->
<!-- The Dead Heart http://www.deadheart.org.uk/ -->
<html><head><title>Record Label Maintenance</title></head>
<body bgcolor="#FFFFFF">

<h1>Record Label Maintenance</h1>

<?
	echo("<form name=\"addedt\" action=\"rec_label_manage.php\" method=\"POST\">\n");
	echo("<table>\n");
	/* if edit select, then fill in form with details */
	if ($action == "edt") {	
		$query = "SELECT rec_label_code, rec_label_name, rec_label_desc
					FROM rec_label
					WHERE rec_label_code = '$item'";
		$result = mysql_db_query(DBNAME, $query, $dbh);
		list($rec_label_code, $rec_label_name, $rec_label_desc) = mysql_fetch_row($result);
		echo("\t<tr>\n");
		echo("\t\t<td>Code</td>\n");
		echo("\t\t<td>$rec_label_code<input type=\"hidden\" name=\"rec_label_code\" value=\"$rec_label_code\"></td>\n");
		echo("\t</tr>\n");
		echo("\t<tr>\n");
		echo("\t\t<td>Name</td>\n");
		echo("\t\t<td><input type=\"text\" name=\"rec_label_name\" size=\"25\" maxlength=\"25\" value='$rec_label_name'></td>\n");
		echo("\t</tr>\n");
		echo("\t<tr>\n");
		echo("\t\t<td>Description</td>\n");
		echo("\t\t<td><textarea name=\"rec_label_desc\" cols=\"60\" rows=\"4\" wrap=\"physical\">$rec_label_desc</textarea></td>\n");
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
		echo("\t\t<td><input type=\"text\" name=\"rec_label_code\" size=\"3\" maxlength=\"3\"></td>\n");
		echo("\t</tr>\n");
		echo("\t<tr>\n");
		echo("\t\t<td>Name</td>\n");
		echo("\t\t<td><input type=\"text\" name=\"rec_label_name\" size=\"25\" maxlength=\"25\"></td>\n");
		echo("\t</tr>\n");
		echo("\t<tr>\n");
		echo("\t\t<td>Description</td>\n");
		echo("\t\t<td><textarea name=\"rec_label_desc\" cols=\"60\" rows=\"4\" wrap=\"physical\"></textarea></td>\n");
		echo("\t</tr>\n");
		echo("\t<tr>\n");
		echo("\t\t<td colspan=2><input type=\"hidden\" name=\"action\" value=\"add\">\n");
		echo("\t\t<input type=\"submit\" name=\"submit\" value=\"Add\"></td>\n");
		echo("\t</tr>\n");
	}

	echo("</table>\n");
	echo("</form>\n\n");
	
	/* Add a new rec_label */
	if ($action == "add") {
	
		if ($rec_label_code == "" or $rec_label_name == "") {
			$error_num = 65535;
		}
		else {
			$query = "INSERT INTO rec_label (rec_label_code, rec_label_name, rec_label_desc)
						VALUES ('".strtoupper($rec_label_code)."', '$rec_label_name', '$rec_label_desc')";
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
	
	/* Delete an existing rec_label */
	else if ($action == "del") {
		$query = "DELETE FROM rec_label
					WHERE rec_label_code = '$item'";
		$result = mysql_db_query(DBNAME, $query, $dbh);
	}
	
	/* Update an existing rec_label */
	else if ($action == "upd") {
		$query = "UPDATE rec_label
					SET rec_label_name = '$rec_label_name', rec_label_desc = '$rec_label_desc'
					WHERE rec_label_code = '$rec_label_code'";
		$result = mysql_db_query(DBNAME, $query, $dbh);
	
	}

	$query = "SELECT rec_label_code, rec_label_name, rec_label_desc
				FROM rec_label
				ORDER BY rec_label_code";
	$result = mysql_db_query(DBNAME, $query, $dbh);

	echo("<table border=1>\n");
	while (list($rec_label_code, $rec_label_name, $rec_label_desc) = mysql_fetch_row($result)) {
		echo("\t<tr>\n");
		echo("\t\t<td>$rec_label_code</td>\n");
		echo("\t\t<td>$rec_label_name</td>\n");
		echo("\t\t<td>".substr($rec_label_desc, 0, 50)."</td>\n");
		echo("\t\t<td><a href=\"rec_label_manage.php?action=edt&item=$rec_label_code\">Edit</a></td>\n");
		echo("\t\t<td><a href=\"rec_label_manage.php?action=del&item=$rec_label_code\">Delete</a></td>\n");
		echo("\t</tr>\n");
	}
	echo("</table>\n\n\n");
	mysql_free_result($result);
	
	mysql_close($dbh);
	
?>

</body></html>