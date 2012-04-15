<? 	/*
	 * HTML forms to manage the release table
	 */

	require("conf.inc.php");
	
	$dbh = mysql_connect(HOST, USER, PASS);
?>
<!-- MKelly 2000 -->
<!-- The Dead Heart http://www.deadheart.org.uk/ -->
<html><head>
<link href="discog.css" rel="STYLESHEET" type="text/css">
<title>Release Information</title></head>
<body bgcolor="#FFFFFF">

<?
	/* Main query */
	$query = "SELECT release_name, release_no_tracks, release_label,
					release_country_sale, release_country_manu, date_format(release_date, '%d %M, %Y'),
					release_year, release_format, release_type, release_notes,
					release_pic_slv, release_cover_url, release_cover_desc, 
					release_bar_code, release_code_1, release_code_2,
					release_code_3, release_code_4,	release_code_5, release_code_6,
					release_cb_code, release_lc_code
				FROM release
				WHERE release_id = '$id'";
	$result = mysql_db_query(DBNAME, $query, $dbh);
	
	list($release_name, $release_no_tracks, $release_label,
			$release_country_sale, $release_country_manu, $release_date,
			$release_year, $release_format, $release_type, $release_notes,
			$release_pic_slv, $release_cover_url, $release_cover_desc, 
			$release_bar_code, $release_code_1, $release_code_2,
			$release_code_3, $release_code_4, $release_code_5, $release_code_6,
			$release_cb_code, $release_lc_code) = mysql_fetch_row ($result);
	mysql_free_result($result);
	
	/* Expanding codes */
	
	$query = "SELECT country_name
				FROM country
				WHERE country_code = '$release_country_sale'";
	$result = mysql_db_query(DBNAME, $query, $dbh);
	list($exp_release_country_sale) = mysql_fetch_row($result);
	mysql_free_result($result);
	
	$query = "SELECT country_name
				FROM country
				WHERE country_code = '$release_country_manu'";
	$result = mysql_db_query(DBNAME, $query, $dbh);
	list($exp_release_country_manu) = mysql_fetch_row($result);
	mysql_free_result($result);
	
	$query = "SELECT format_name
				FROM format
				WHERE format_code = '$release_format'";
	$result = mysql_db_query(DBNAME, $query, $dbh);
	list($exp_release_format) = mysql_fetch_row($result);
	mysql_free_result($result);
	
	$query = "SELECT rel_type_name
				FROM rel_type
				WHERE rel_type_code = '$release_type'";
	$result = mysql_db_query(DBNAME, $query, $dbh);
	list($exp_release_type) = mysql_fetch_row($result);
	mysql_free_result($result);
	
	$query = "SELECT rec_label_name
				FROM rec_label
				WHERE rec_label_code = '$release_label'";
	$result = mysql_db_query(DBNAME, $query, $dbh);
	list($exp_release_label) = mysql_fetch_row($result);
	mysql_free_result($result);
	
	/* Display data */
	
	echo("<h1>$release_name</h1>\n");
	
	echo("<table border=0 width=100%>\n");
	echo("\t<tr>\n");
	echo("\t\t<td class=\"thead\" bgcolor=#A2C2F6>General</td>");
	echo("\t</tr>\n");
	echo("\t<tr>\n");
	echo("\t\t<td>");
	if ($release_cover_url) {
		echo("<img src=\"thumbs/$release_cover_url\" align=\"right\">\n");
	}
	echo("<p><b>Format:</b> <a href=#
onClick=\"window.open('key/format.php?format_code=$release_format','key','toolbar=no,location=no,directories=no,menubar=no,width=450,height=450'); return false;\">$exp_release_format</a><br>\n");
	echo("<b>Type of release:</b> <a href=#
onClick=\"window.open('key/rel_type.php?rel_type_code=$release_type','key','toolbar=no,location=no,directories=no,menubar=no,width=450,height=450'); return false;\">$exp_release_type</a></br>\n");
	echo("<b>Record label:</b> <a href=#
onClick=\"window.open('key/rec_label.php?rec_label_code=$release_label','key','toolbar=no,location=no,directories=no,menubar=no,width=450,height=450'); return false;\">$exp_release_label</a></p>");
	
	echo("<p><b>Country:</b> $exp_release_country_sale</p>\n");
	
	echo("<p><b>Year of Release:</b> $release_year<br>\n");
	echo("<b>Release Date:</b> ");
	if (!$release_date) {
		echo("Unknown");
	}
	else {
		echo($release_date);
	}
	echo("</p>\n");

	echo("\t\t</td>\n");
	echo("\t</tr>\n");
	
	/* Codes */

	echo("\t<tr>\n");
	echo("\t\t<td class=\"thead\" bgcolor=#A2C2F6>Codes</td>");
	echo("\t</tr>\n");
	echo("\t<tr>\n");
	echo("\t\t<td>");
	
	echo("<p><b>Main code:</b> $release_code_1<br>\n");
	
	echo("<b>Bar code:</b> ");
	if ($release_bar_code) {
		echo("$release_bar_code<br>\n");
	}
	else {
		echo("Unknown<br>");
	}
	
	echo("<table border=0 cellpadding=0 cellspacing=0>\n");
	echo("<tr>\n");
	if ($release_code_2) {
		echo("<td><b>Additional codes - 1:</b> $release_code_2&nbsp;</td>\n");
	}
	if ($release_code_3) {
		echo("<td>&nbsp;<b>Additional codes - 2:</b> $release_code_3</td>\n");
	}
	echo("</tr>\n");
	
	echo("<tr>\n");
	if ($release_code_4) {
		echo("<td><b>Additional codes - 3:</b> $release_code_4&nbsp;</td>\n");
	}
	if ($release_code_5) {
		echo("<td>&nbsp;<b>Additional codes - 4:</b> $release_code_5</td>\n");
	}
	echo("</tr>\n");
	
	echo("<tr>\n");
	if ($release_code_6) {
		echo("<td><b>Additional codes - 5:</b> $release_code_6</td>\n");
	}
	echo("</tr>\n");
	echo("</table>");
	
	echo("<b>'CB' Code:</b> ");	
	if ($release_cb_code) {
		echo("$release_cb_code<br>\n");
	}
	else {
		echo("Unknown<br>");
	}
	
	echo("<b>'LC' Code:</b> ");
	if ($release_lc_code) {
		echo("$release_lc_code<br>\n");
	}
	else {
		echo("Unknown</p>");
	}

	echo("\t\t</td>\n");
	echo("\t</tr>\n");
	
	/* Track details */
	
	echo("\t<tr>\n");
	echo("\t\t<td class=\"thead\" bgcolor=#A2C2F6>Tracks</td>");
	echo("\t</tr>\n");
	echo("\t<tr>\n");
	echo("\t\t<td>\n");
	
	//echo("<p><b>Number of tracks:</b> $release_no_tracks</p>\n");
	
	$query = "SELECT track_name, track_length, rel_order
				FROM track_rel_mpg trm, track t
				WHERE trm.track_id = t.track_id
					AND trm.rel_id = '$id'";
	$result = mysql_db_query(DBNAME, $query, $dbh);
	
	echo("<table cellpadding=0 cellspacing=0>\n");
	$skip_next = 0;
	for ($i = 1; $i <= $release_no_tracks ; $i++) {
		if (!$skip_next) {
			list($track_name, $track_length, $rel_order) = mysql_fetch_row($result);
		}
		if ($i == $rel_order) {
			$skip_next = 0;
		}
		else {
			$skip_next = 1;
		}

		if ($skip_next) {
			echo("<tr><td align=\"right\">$i</td>\n<td>- Unknown</td></tr>\n");
		}
		else {
			echo ("<tr><td align=\"right\">$i</td>\n<td>- $track_name");
			if ($track_length) {
				echo(" [$track_length]");
			}
			echo("</td></tr>\n");
		}
	}
	echo("</table>\n");


	echo("\t\t</td>\n");
	echo("\t</tr>\n");
	
	/* Sleeve info and further notes. */

	echo("\t<tr>\n");
	echo("\t\t<td class=\"thead\" bgcolor=#A2C2F6>Notes</td>");
	echo("\t</tr>\n");
	echo("\t<tr>\n");
	echo("\t\t<td>\n");
	
	if ($release_notes) {
		echo("$release_notes<br>\n");
	}
	else {
		echo("None<br>");
	}
	
	echo("<p><b>Picture sleeve:</b> ");
	if ($release_pic_slv == "Y") {
		echo("Yes<br>\n");
	}
	else {
		echo("No<br>\n");
	}
	
	echo("$release_cover_desc");
	echo("</p>\n");

	echo("\t\t</td>\n");
	echo("\t</tr>\n");
	
	echo("</table>\n");

	
	mysql_close($dbh);
	
?>

</body></html>