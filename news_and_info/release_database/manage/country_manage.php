<? 	/*
	 * HTML forms to manage the country table
	 */

	require("conf.inc.php");
	
	$dbh = mysql_connect(HOST, USER, PASS);
?>
<!-- MKelly 2000 -->
<!-- The Dead Heart http://www.deadheart.org.uk/ -->
<html><head><title>Country Maintenance</title></head>
<body bgcolor="#FFFFFF">
<h1>Country Maintenance</h1>

<?
	echo("<form name=\"addedt\" action=\"country_manage.php\" method=\"POST\">\n");
	echo("<table>\n");
	/* if edit select, then fill in form with details */
	if ($action == "edt") {	
		$query = "SELECT country_code, country_name
					FROM country
					WHERE country_code = '$item'";
		$result = mysql_db_query(DBNAME, $query, $dbh);
		list($country_code, $country_name) = mysql_fetch_row($result);
		echo("\t<tr>\n");
		echo("\t\t<td>Code</td>\n");
		echo("\t\t<td>$country_code<input type=\"hidden\" name=\"country_code\" value=\"$country_code\"></td>\n");
		echo("\t</tr>\n");
		echo("\t<tr>\n");
		echo("\t\t<td>Name</td>\n");
		echo("\t\t<td><input type=\"text\" name=\"country_name\" size=\"25\" maxlength=\"25\" value='$country_name'></td>\n");
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
		echo("\t\t<td><input type=\"text\" name=\"country_code\" size=\"3\" maxlength=\"3\"></td>\n");
		echo("\t</tr>\n");
		echo("\t<tr>\n");
		echo("\t\t<td>Name</td>\n");
		echo("\t\t<td><input type=\"text\" name=\"country_name\" size=\"25\" maxlength=\"25\"></td>\n");
		echo("\t</tr>\n");
		echo("\t<tr>\n");
		echo("\t\t<td colspan=2><input type=\"hidden\" name=\"action\" value=\"add\">\n");
		echo("\t\t<input type=\"submit\" name=\"submit\" value=\"Add\"></td>\n");
		echo("\t</tr>\n");
	}

	echo("</table>\n");
	echo("</form>\n\n");
	
	/* Add a new country */
	if ($action == "add") {
	
		if ($country_code == "" or $country_name == "") {
			$error_num = 65535;
		}
		else {
			$query = "INSERT INTO country (country_code, country_name)
						VALUES ('".strtoupper($country_code)."', '$country_name')";
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
	
	/* Delete an existing country */
	else if ($action == "del") {
		$query = "DELETE FROM country
					WHERE country_code = '$item'";
		$result = mysql_db_query(DBNAME, $query, $dbh);
	}
	
	/* Update an existing country */
	else if ($action == "upd") {
		$query = "UPDATE country
					SET country_name = '$country_name'
					WHERE country_code = '$country_code'";
		$result = mysql_db_query(DBNAME, $query, $dbh);
	
	}

	$query = "SELECT country_code, country_name
				FROM country
				ORDER BY country_code";
	$result = mysql_db_query(DBNAME, $query, $dbh);

	echo("<table border=1>\n");
	while (list($country_code, $country_name) = mysql_fetch_row($result)) {
		echo("\t<tr>\n");
		echo("\t\t<td>$country_code</td>\n");
		echo("\t\t<td>$country_name</td>\n");
		echo("\t\t<td><a href=\"country_manage.php?action=edt&item=$country_code\">Edit</a></td>\n");
		echo("\t\t<td><a href=\"country_manage.php?action=del&item=$country_code\">Delete</a></td>\n");
		echo("\t</tr>\n");
	}
	echo("</table>\n\n\n");
	mysql_free_result($result);
	
	mysql_close($dbh);
	
?>

</body></html>