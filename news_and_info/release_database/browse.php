<? 	/*
	 * HTML forms to manage the rec_label table
	 */

	require("conf.inc.php");
	
	$dbh = mysql_connect(HOST, USER, PASS);
?>
<!-- MKelly 2000 -->
<!-- The Dead Heart http://www.deadheart.org.uk/ -->
<html><head>
<link href="discog.css" rel="STYLESHEET" type="text/css">
<title>Browse</title></head>
<body bgcolor="#FFFFFF">
<h1>Browse 

<?	

	if ($style == "reltype" or $style == "") {

	    echo("by Release Type</h1>\n");

		$query = "SELECT rel_type_code, rel_type_name
					FROM rel_type";
		$result = mysql_db_query(DBNAME, $query, $dbh);
		
		while(list($rel_type_code, $rel_type_name) = mysql_fetch_row($result)) {
			$arr_rel_type_name[$rel_type_code] = $rel_type_name;
		}
		
		mysql_free_result($result);
	
		$query = "SELECT DISTINCT release_type, release_name
					FROM release
					ORDER BY release_type, release_name";
		$result = mysql_db_query(DBNAME, $query, $dbh);
		
		$rel_type = "";
		echo("<table cellpadding=0 cellspacing=0 width=100%>\n");
		while (list($release_type, $release_name) = mysql_fetch_row($result)) {
			if ($rel_type != $release_type) {
				$rel_type = $release_type;
				echo("\t<tr>\n");
				echo("\t\t<td colspan=2 class=\"thead\" bgcolor=#A2C2F6><b>$arr_rel_type_name[$release_type]</b></td>\n");
				echo("\t</tr>\n");
			}
			echo("\t<tr>\n");
			echo("\t\t<td><a href=\"release.php?name=".urlencode($release_name)."&type=".urlencode($release_type)."\">$release_name</a></td>\n");
			echo("\t</tr>\n");
		}
		echo("</table>\n\n");
		mysql_free_result($result);
	}
	
	if ($style == "chrono") {
	
		echo("by Release Date</h1>\n");
	
		$query = "SELECT DISTINCT release_name, release_date, release_year
					FROM release
					GROUP BY release_year, release_name
					ORDER BY release_year, release_date, release_name";
		$result = mysql_db_query(DBNAME, $query, $dbh);
		
		$rel_year = "";
		echo("<table cellpadding=0 cellspacing=0 width=100%>\n");
		while (list($release_name, $release_date, $release_year) = mysql_fetch_row($result)) {
			if ($rel_year != $release_year) {
				$rel_year = $release_year;
				echo("\t<tr>\n");
				echo("\t\t<td colspan=2 class=\"thead\" bgcolor=#A2C2F6><b>$release_year</b></td>\n");
				echo("\t</tr>\n");
			}
			echo("\t<tr>\n");
			echo("\t\t<td><a href=\"chronological.php?name=".urlencode($release_name)."&year=".urlencode($release_year)."\">$release_name</a></td>\n");
			echo("\t</tr>\n");
		}
		echo("</table>\n");
	}
	
	if ($style == "alpha") {
	
		echo("Alphabetically</h1>\n");
		
		$query = "SELECT DISTINCT release_name
					FROM release
					ORDER BY release_name";
		$result = mysql_db_query(DBNAME, $query, $dbh);
		if ($result == -1) {
			echo("Error: $phperrmsg\n");
			exit(1);
		}
		$letter = "";
		echo("<table cellpadding=0 cellspacing=0 width=100%>\n");
		while(list($release_name) = mysql_fetch_row($result)) {
		$new_letter = substr($release_name, 0, 1);
			if ($letter != $new_letter) {
				$high_letter = strtoupper($new_letter);
				echo("\t<tr>\n");
				echo("\t\t<td class=\"thead\" bgcolor=#A2C2F6><b><a name=\"$new_letter\">$high_letter</a></b></td>\n");
				echo("\t</tr>\n");
				$letter = $new_letter;
			}
			echo("\t<tr>\n");
			echo("\t\t<td><a href=\"alphabetical.php?release_name=".urlencode($release_name)."\">$release_name</a></td>\n");
			echo("\t</tr>\n");
		}
		
		echo("</table>\n");
	}
	
	mysql_close($dbh)
?>


</body></html>