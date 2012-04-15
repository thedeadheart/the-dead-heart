<? 	/*
	 * HTML forms to manage the rel_type table
	 */

	require("conf.inc.php");
	
	$dbh = mysql_connect(HOST, USER, PASS);
?>
<!-- MKelly 2000 -->
<!-- The Dead Heart http://www.deadheart.org.uk/ -->
<html><head><title>Release Type Maintenance</title></head>
<body bgcolor="#FFFFFF">

<h1>Release Type Maintenance</h1>

<?
	echo("<form name=\"addedt\" action=\"rel_type_manage.php\" method=\"POST\">\n");
	echo("<table>\n");
	/* if edit select, then fill in form with details */
	if ($action == "edt") {	
		$query = "SELECT rel_type_code, rel_type_name, rel_type_desc
					FROM rel_type
					WHERE rel_type_code = '$item'";
		$result = mysql_db_query(DBNAME, $query, $dbh);
		list($rel_type_code, $rel_type_name, $rel_type_desc) = mysql_fetch_row($result);
		echo("\t<tr>\n");
		echo("\t\t<td>Code</td>\n");
		echo("\t\t<td>$rel_type_code<input type=\"hidden\" name=\"rel_type_code\" value=\"$rel_type_code\"></td>\n");
		echo("\t</tr>\n");
		echo("\t<tr>\n");
		echo("\t\t<td>Name</td>\n");
		echo("\t\t<td><input type=\"text\" name=\"rel_type_name\" size=\"25\" maxlength=\"25\" value='$rel_type_name'></td>\n");
		echo("\t</tr>\n");
		echo("\t<tr>\n");
		echo("\t\t<td>Description</td>\n");
		echo("\t\t<td><textarea name=\"rel_type_desc\" cols=\"60\" rows=\"4\" wrap=\"physical\">$rel_type_desc</textarea></td>\n");
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
		echo("\t\t<td><input type=\"text\" name=\"rel_type_code\" size=\"3\" maxlength=\"3\"></td>\n");
		echo("\t</tr>\n");
		echo("\t<tr>\n");
		echo("\t\t<td>Name</td>\n");
		echo("\t\t<td><input type=\"text\" name=\"rel_type_name\" size=\"25\" maxlength=\"25\"></td>\n");
		echo("\t</tr>\n");
		echo("\t<tr>\n");
		echo("\t\t<td>Description</td>\n");
		echo("\t\t<td><textarea name=\"rel_type_desc\" cols=\"60\" rows=\"4\" wrap=\"physical\"></textarea></td>\n");
		echo("\t</tr>\n");
		echo("\t<tr>\n");
		echo("\t\t<td colspan=2><input type=\"hidden\" name=\"action\" value=\"add\">\n");
		echo("\t\t<input type=\"submit\" name=\"submit\" value=\"Add\"></td>\n");
		echo("\t</tr>\n");
	}

	echo("</table>\n");
	echo("</form>\n\n");
	
	/* Add a new rel_type */
	if ($action == "add") {
	
		if ($rel_type_code == "" or $rel_type_name == "") {
			$error_num = 65535;
		}
		else {
			$query = "INSERT INTO rel_type (rel_type_code, rel_type_name, rel_type_desc)
						VALUES ('".strtoupper($rel_type_code)."', '$rel_type_name', '$rel_type_desc')";
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
	
	/* Delete an existing rel_type */
	else if ($action == "del") {
		$query = "DELETE FROM rel_type
					WHERE rel_type_code = '$item'";
		$result = mysql_db_query(DBNAME, $query, $dbh);
	}
	
	/* Update an existing rel_type */
	else if ($action == "upd") {
		$query = "UPDATE rel_type
					SET rel_type_name = '$rel_type_name', rel_type_desc = '$rel_type_desc'
					WHERE rel_type_code = '$rel_type_code'";
		$result = mysql_db_query(DBNAME, $query, $dbh);
	
	}

	$query = "SELECT rel_type_code, rel_type_name, rel_type_desc
				FROM rel_type
				ORDER BY rel_type_code";
	$result = mysql_db_query(DBNAME, $query, $dbh);

	echo("<table border=1>\n");
	while (list($rel_type_code, $rel_type_name, $rel_type_desc) = mysql_fetch_row($result)) {
		echo("\t<tr>\n");
		echo("\t\t<td>$rel_type_code</td>\n");
		echo("\t\t<td>$rel_type_name</td>\n");
		echo("\t\t<td>".substr($rel_type_desc, 0, 50)."</td>\n");
		echo("\t\t<td><a href=\"rel_type_manage.php?action=edt&item=$rel_type_code\">Edit</a></td>\n");
		echo("\t\t<td><a href=\"rel_type_manage.php?action=del&item=$rel_type_code\">Delete</a></td>\n");
		echo("\t</tr>\n");
	}
	echo("</table>\n\n\n");
	mysql_free_result($result);
	
	mysql_close($dbh);
	
?>

</body></html>