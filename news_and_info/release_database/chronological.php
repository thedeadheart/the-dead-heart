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
<title><? echo("Chronological Releases for $name in $year"); ?></title></head>
<body bgcolor="#FFFFFF">

<?	echo("<h1>$name ($year)</h1>");

	$query = "SELECT country_code, country_name
				FROM country";
	$result = mysql_db_query(DBNAME, $query, $dbh);
	while(list($country_code, $country_name) = mysql_fetch_row($result)) {
		$arr_country_name[$country_code] = $country_name;
	}
	mysql_free_result($result);
	
	$query = "SELECT format_code, format_name
				FROM format";
	$result = mysql_db_query(DBNAME, $query, $dbh);
	while(list($format_code, $format_name) = mysql_fetch_row($result)) {
		$arr_format_name[$format_code] = $format_name;
	}
	mysql_free_result($result);	
	
	$query = "SELECT release_id, release_country_sale, release_format, release_type
				FROM release
				WHERE release_name = '$name'
					AND release_year = '$year'
				ORDER BY release_country_sale, release_date";
	$result = mysql_db_query(DBNAME, $query, $dbh);
	
	$rel_country_sale = "";
	echo("<table cellpadding=0 cellspacing=0 width=100%>\n");
	while (list($release_id, $release_country_sale, $release_format, $release_type) = mysql_fetch_row($result)) {
		if ($rel_country_sale != $release_country_sale) {
			$rel_country_sale = $release_country_sale;
			echo("\t<tr>\n");
			echo("\t\t<td colspan=2 class=\"thead\" bgcolor=#A2C2F6><b>$arr_country_name[$release_country_sale]</b></td>\n");
			echo("\t</tr>\n");
		}
		echo("\t<tr>\n");
		echo("\t\t<td><a href=\"entry.php?id=$release_id\">$arr_format_name[$release_format]</a></td>\n");
		echo("\t</tr>\n");
	}
	echo("</table>\n\n");
	mysql_free_result($result);
?>


</body></html>