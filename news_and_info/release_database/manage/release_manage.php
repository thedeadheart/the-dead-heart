<? 	/*
	 * HTML forms to manage the release table
	 */

	require("conf.inc.php");
	
	$dbh = mysql_connect(HOST, USER, PASS);
?>
<!-- MKelly 2000 -->
<!-- The Dead Heart http://www.deadheart.org.uk/ -->
<html><head><title>Release Maintenance</title></head>
<body bgcolor="#FFFFFF">
<h1>Release Maintenance</h1>

<?
	if ($action == "lst" or $action == "") {
	
		echo("<p>\n");
		echo("<a href=\"release_manage.php?action=add&step=1\">Add a new release</a>\n");
		echo("</p>\n");
	
		$query = "SELECT release_id, release_name, release_country_sale, release_type, release_format
					FROM release
					ORDER BY release_name, release_type, release_country_sale, release_format";
		$result = mysql_db_query(DBNAME, $query, $dbh);
		
		echo("<p>\n");
		echo("<table border=1>\n");
		while (list($release_id, $release_name, $release_country_sale, $release_type, $release_format) = mysql_fetch_row($result)) {
			echo("\t<tr>\n");
			echo("\t\t<td>$release_name");
			echo(" ($release_type, $release_country_sale, $release_format)</td>\n");
			echo("\t\t<td><a href=\"release_manage.php?action=edt&item=$release_id\">Edit</a></td>\n");
			echo("\t\t<td><a href=\"release_manage.php?action=del&item=$release_id&step=1\">Delete</td>\n");
			echo("\t</tr>\n");
		}
		mysql_free_result($result);
		
		echo("</table>\n");
		echo("</p>\n\n");
		
	}
	
	if ($action == "edt") {
		$query = "SELECT release_id, release_name, release_no_tracks, release_label,
						release_country_sale, release_country_manu, release_date,
						release_year, release_format, release_type, release_notes,
						release_pic_slv, release_cover_url, release_cover_desc,
						release_bar_code, release_code_1, release_code_2,
						release_code_3, release_code_4,	release_code_5, release_code_6,
						release_cb_code, release_lc_code
					FROM release
					WHERE release_id = '$item'";
		$result = mysql_db_query(DBNAME, $query, $dbh);
		
		list($release_id, $release_name, $release_no_tracks, $release_label,
				$release_country_sale, $release_country_manu, $release_date,
				$release_year, $release_format, $release_type, $release_notes,
				$release_pic_slv, $release_cover_url, $release_cover_desc,
				$release_bar_code, $release_code_1, $release_code_2,
				$release_code_3, $release_code_4, $release_code_5, $release_code_6,
				$release_cb_code, $release_lc_code) = mysql_fetch_row ($result);
		mysql_free_result($result);
		
		echo("<form name=\"release_form\" method=\"GET\" action=\"release_manage.php\">\n\n");
		echo("<input type=\"hidden\" name=\"release_id\" value=\"$release_id\" size=\"80\" maxlength=\"80\">\n");
		echo("<table>\n");
		
		/* Name of Release */
		echo("\t<tr>\n");
		echo("\t\t<td>Name: </td>\n");
		echo("\t\t<td><input type=\"text\" name=\"release_name\" value=\"$release_name\" size=\"80\" maxlength=\"80\"></td>\n");
		echo("\t</tr>\n");
		
		/* Number of tracks */
		echo("\t<tr>\n");
		echo("\t\t<td>No. of tracks: </td>\n");
		echo("\t\t<td><input type=\"text\" name=\"release_no_tracks\" value=\"$release_no_tracks\" size=\"3\" maxlength=\"3\"></td>\n");
		echo("\t</tr>\n");
		
		/* Record label */
		$query = "SELECT rec_label_code, rec_label_name
					FROM rec_label
					ORDER BY rec_label_name";
		$result = mysql_db_query(DBNAME, $query, $dbh);
		
		$label_option = "";
		$label_sel = ""; 
		while(list($rec_label_code, $rec_label_name) = mysql_fetch_row($result)) {
			if ($rec_label_code == $release_label) {
				$label_sel = " selected";
			}
			else {
				$label_sel = "";
			}
			$label_option = $label_option."\t\t\t<option value=\"$rec_label_code\"$label_sel>$rec_label_name</option>\n";
		}
		mysql_free_result($result);
		
		echo("\t<tr>\n");
		echo("\t\t<td>Label: </td>\n");
		echo("\t\t<td><select name=\"release_label\">\n$label_option\t\t</select></td>\n");
		echo("\t</tr>\n");
		
		/* Release country */
		$query = "SELECT country_code, country_name
					FROM country
					ORDER BY country_name";
		$result = mysql_db_query(DBNAME, $query, $dbh);
		
		$ctry_sale_option = "";
		$ctry_sale_sel = ""; 
		while(list($country_code, $country_name) = mysql_fetch_row($result)) {
			if ($country_code == $release_country_sale) {
				$ctry_sale_sel = " selected";
			}
			else {
				$ctry_sale_sel = "";
			}
			$ctry_sale_option = $ctry_sale_option."\t\t\t<option value=\"$country_code\"$ctry_sale_sel>$country_name</option>\n";
		}
		mysql_free_result($result);
		
		echo("\t<tr>\n");
		echo("\t\t<td>Country: </td>\n");
		echo("\t\t<td><select name=\"release_country_sale\">\n$ctry_sale_option\t\t</select></td>\n");
		echo("\t</tr>\n");

		/* Country of manufacture */
		$query = "SELECT country_code, country_name
					FROM country
					ORDER BY country_name";
		$result = mysql_db_query(DBNAME, $query, $dbh);
		
		$ctry_manu_option = "";
		$ctry_manu_sel = ""; 
		while(list($country_code, $country_name) = mysql_fetch_row($result)) {
			if ($country_code == $release_country_manu) {
				$ctry_manu_sel = " selected";
			}
			else {
				$ctry_manu_sel = "";
			}
			$ctry_manu_option = $ctry_manu_option."\t\t\t<option value=\"$country_code\"$ctry_manu_sel>$country_name</option>\n";
		}
		mysql_free_result($result);
		
		echo("\t<tr>\n");
		echo("\t\t<td>Country of manufacture: </td>\n");
		echo("\t\t<td><select name=\"release_country_manu\">\n$ctry_manu_option\t\t</select></td>\n");
		echo("\t</tr>\n");
		
		/* Release date */
		list($release_date_y, $release_date_m, $release_date_d) = explode("-", $release_date);
		
		echo("\t<tr>\n");
		echo("\t\t<td>Release date: </td>\n");
		echo("\t\t<td>");
		echo("<input type=\"text\" name=\"release_date_y\" value=\"$release_date_y\" size=\"4\" maxlength=\"4\"> - ");
		echo("<input type=\"text\" name=\"release_date_m\" value=\"$release_date_m\" size=\"2\" maxlength=\"2\"> - ");
		echo("<input type=\"text\" name=\"release_date_d\" value=\"$release_date_d\" size=\"2\" maxlength=\"2\">");
		echo("</td>\n");
		echo("\t</tr>\n");
		
		/* Release year */
		echo("\t<tr>\n");
		echo("\t\t<td>Release year: </td>\n");
		echo("\t\t<td><input type=\"text\" name=\"release_year\" value=\"$release_year\" size=\"4\" maxlength=\"4\"></td>\n");
		echo("\t</tr>\n");

		/* Format */
		$query = "SELECT format_code, format_name
					FROM format
					ORDER BY format_name";
		$result = mysql_db_query(DBNAME, $query, $dbh);
		
		$format_option = "";
		$format_sel = ""; 
		while(list($format_code, $format_name) = mysql_fetch_row($result)) {
			if ($format_code == $release_format) {
				$format_sel = " selected";
			}
			else {
				$format_sel = "";
			}
			$format_option = $format_option."\t\t\t<option value=\"$format_code\"$format_sel>$format_name</option>\n";
		}
		mysql_free_result($result);
		
		echo("\t<tr>\n");
		echo("\t\t<td>Format: </td>\n");
		echo("\t\t<td><select name=\"release_format\">\n$format_option\t\t</select></td>\n");
		echo("\t</tr>\n");
		
		/* Type of Release */
		$query = "SELECT rel_type_code, rel_type_name
					FROM rel_type
					ORDER BY rel_type_name";
		$result = mysql_db_query(DBNAME, $query, $dbh);
		
		$rel_type_option = "";
		$rel_type_sel = ""; 
		while(list($rel_type_code, $rel_type_name) = mysql_fetch_row($result)) {
			if ($rel_type_code == $release_type) {
				$rel_type_sel = " selected";
			}
			else {
				$rel_type_sel = "";
			}
			$rel_type_option = $rel_type_option."\t\t\t<option value=\"$rel_type_code\"$rel_type_sel>$rel_type_name</option>\n";
		}
		mysql_free_result($result);
		
		echo("\t<tr>\n");
		echo("\t\t<td>Release Type: </td>\n");
		echo("\t\t<td><select name=\"release_type\">\n$rel_type_option\t\t</select></td>\n");
		echo("\t</tr>\n");
		
		/* Release Notes */
		echo("\t<tr>\n");
		echo("\t\t<td valign=\"top\">Notes: </td>\n");
		echo("\t\t<td><textarea name=\"release_notes\" cols=80 rows=6 wrap=\"physical\">$release_notes</textarea></td>\n");
		echo("\t</tr>\n");
		
		/* Picture Sleeve */
		$pic_slv_chk = "";
		if ($release_pic_slv == "Y") {
			$pic_slv_chk = " checked";
		}
		else {
			$pic_slv_chk = "";
		}
		echo("\t<tr>\n");
		echo("\t\t<td>Picture Sleeve: </td>\n");
		echo("\t\t<td><input type=\"checkbox\" name=\"release_pic_slv\" value=\"Y\" $pic_slv_chk></td>\n");
		echo("\t</tr>\n");
		
		/* Path to sleeve picture */
		echo("\t<tr>\n");
		echo("\t\t<td>Sleeve thumbnail: </td>\n");
		echo("\t\t<td><input type=\"text\" name=\"release_cover_url\" value=\"$release_cover_url\" size=\"80\" maxlength=\"80\"></td>\n");
		echo("\t</tr>\n");
		
		/* Sleeve description */
		echo("\t<tr>\n");
		echo("\t\t<td valign=\"top\">Cover description: </td>\n");
		echo("\t\t<td><textarea name=\"release_cover_desc\" cols=80 rows=6 wrap=\"physical\">$release_cover_desc</textarea></td>\n");
		echo("\t</tr>\n");
				
		/* Barcode */
		echo("\t<tr>\n");
		echo("\t\t<td>Barcode: </td>\n");
		echo("\t\t<td><input type=\"text\" name=\"release_bar_code\" value=\"$release_bar_code\" size=\"20\" maxlength=\"20\"></td>\n");
		echo("\t</tr>\n");
		
		/* Release Code 1 */
		echo("\t<tr>\n");
		echo("\t\t<td>Code 1: </td>\n");
		echo("\t\t<td><input type=\"text\" name=\"release_code_1\" value=\"$release_code_1\" size=\"20\" maxlength=\"20\"></td>\n");
		echo("\t</tr>\n");
		
		/* Release Code 2 */
		echo("\t<tr>\n");
		echo("\t\t<td>Code 2: </td>\n");
		echo("\t\t<td><input type=\"text\" name=\"release_code_2\" value=\"$release_code_2\" size=\"20\" maxlength=\"20\"></td>\n");
		echo("\t</tr>\n");

		/* Release Code 3 */
		echo("\t<tr>\n");
		echo("\t\t<td>Code 3: </td>\n");
		echo("\t\t<td><input type=\"text\" name=\"release_code_3\" value=\"$release_code_3\" size=\"20\" maxlength=\"20\"></td>\n");
		echo("\t</tr>\n");

		/* Release Code 4 */
		echo("\t<tr>\n");
		echo("\t\t<td>Code 4: </td>\n");
		echo("\t\t<td><input type=\"text\" name=\"release_code_4\" value=\"$release_code_4\" size=\"20\" maxlength=\"20\"></td>\n");
		echo("\t</tr>\n");		

		/* Release Code 5 */
		echo("\t<tr>\n");
		echo("\t\t<td>Code 5: </td>\n");
		echo("\t\t<td><input type=\"text\" name=\"release_code_5\" value=\"$release_code_5\" size=\"20\" maxlength=\"20\"></td>\n");
		echo("\t</tr>\n");

		/* Release Code 6 */
		echo("\t<tr>\n");
		echo("\t\t<td>Code 6: </td>\n");
		echo("\t\t<td><input type=\"text\" name=\"release_code_6\" value=\"$release_code_6\" size=\"20\" maxlength=\"20\"></td>\n");
		echo("\t</tr>\n");
		
		/* CB Code */
		echo("\t<tr>\n");
		echo("\t\t<td>CB Code: </td>\n");
		echo("\t\t<td><input type=\"text\" name=\"release_cb_code\" value=\"$release_cb_code\" size=\"10\" maxlength=\"10\"></td>\n");
		echo("\t</tr>\n");
		
		/* LC Code */
		echo("\t<tr>\n");
		echo("\t\t<td>LC Code: </td>\n");
		echo("\t\t<td><input type=\"text\" name=\"release_lc_code\" value=\"$release_lc_code\" size=\"10\" maxlength=\"10\"></td>\n");
		echo("\t</tr>\n");
		
		/* Submit button and "upd" hidden input */
		
		echo("\t\t<input type=\"hidden\" name=\"action\" value=\"upd\">\n");
		
		echo("\t<tr>\n");
		echo("\t\t<td colspan=2><input type=\"submit\" name=\"submit\" value=\"Update\"></td>\n");
		echo("\t</tr>\n");
		
		echo("</table>\n");
		echo("</form>\n\n");		
	}
	
	if ($action == "upd") {
		if ($release_pic_slv == "Y") {
			$release_pic_slv = "Y";
		}
		else {
			$release_pic_slv = "N";
		}
		
		$release_date = $release_date_y."-".$release_date_m."-".$release_date_d;
		
		$query = "UPDATE release
					SET release_name = '$release_name', 
						release_no_tracks = '$release_no_tracks', 
						release_label = '$release_label', 
						release_country_sale  = '$release_country_sale', 
						release_country_manu = '$release_country_manu', 
						release_date = '$release_date', 
						release_year = '$release_year', 
						release_format = '$release_format', 
						release_type = '$release_type', 
						release_notes = '$release_notes', 
						release_pic_slv = '$release_pic_slv',
						release_cover_url = '$release_cover_url',
						release_cover_desc = '$release_cover_desc',
						release_bar_code = '$release_bar_code', 
						release_code_1 = '$release_code_1', 
						release_code_2 = '$release_code_2', 
						release_code_3 = '$release_code_3', 
						release_code_4 = '$release_code_4', 
						release_code_5 = '$release_code_5', 
						release_code_6 = '$release_code_6', 
						release_cb_code = '$release_cb_code', 
						release_lc_code = '$release_lc_code'
					WHERE release_id = '$release_id'";
		$result = mysql_db_query(DBNAME, $query, $dbh);
		
		echo("<p>Back to <a href=\"release_manage.php?action=lst\">release list</a></p>\n");
		
	}
	
	if ($action == "add") {
		if ($step == "1") {
			echo("<form name=\"release_form\" method=\"GET\" action=\"release_manage.php\">\n\n");
		echo("<input type=\"hidden\" name=\"release_id\" value=\"$release_id\" size=\"80\" maxlength=\"80\">\n");
		echo("<table>\n");
		
		/* Name of Release */
		echo("\t<tr>\n");
		echo("\t\t<td>Name: </td>\n");
		echo("\t\t<td><input type=\"text\" name=\"release_name\" size=\"80\" maxlength=\"80\"></td>\n");
		echo("\t</tr>\n");
		
		/* Number of tracks */
		echo("\t<tr>\n");
		echo("\t\t<td>No. of tracks: </td>\n");
		echo("\t\t<td><input type=\"text\" name=\"release_no_tracks\" size=\"3\" maxlength=\"3\"></td>\n");
		echo("\t</tr>\n");
		
		/* Record label */
		$query = "SELECT rec_label_code, rec_label_name
					FROM rec_label
					ORDER BY rec_label_name";
		$result = mysql_db_query(DBNAME, $query, $dbh);
		
		$label_option = "";
		$label_sel = ""; 
		while(list($rec_label_code, $rec_label_name) = mysql_fetch_row($result)) {
			if ($rec_label_code == $release_label) {
				$label_sel = " selected";
			}
			else {
				$label_sel = "";
			}
			$label_option = $label_option."\t\t\t<option value=\"$rec_label_code\"$label_sel>$rec_label_name</option>\n";
		}
		mysql_free_result($result);
		
		echo("\t<tr>\n");
		echo("\t\t<td>Label: </td>\n");
		echo("\t\t<td><select name=\"release_label\">\n$label_option\t\t</select></td>\n");
		echo("\t</tr>\n");
		
		/* Release country */
		$query = "SELECT country_code, country_name
					FROM country
					ORDER BY country_name";
		$result = mysql_db_query(DBNAME, $query, $dbh);
		
		while(list($country_code, $country_name) = mysql_fetch_row($result)) {
			$ctry_sale_option = $ctry_sale_option."\t\t\t<option value=\"$country_code\">$country_name</option>\n";
		}
		mysql_free_result($result);
		
		echo("\t<tr>\n");
		echo("\t\t<td>Country: </td>\n");
		echo("\t\t<td><select name=\"release_country_sale\">\n$ctry_sale_option\t\t</select></td>\n");
		echo("\t</tr>\n");

		/* Country of manufacture */
		$query = "SELECT country_code, country_name
					FROM country
					ORDER BY country_name";
		$result = mysql_db_query(DBNAME, $query, $dbh);
		
		while(list($country_code, $country_name) = mysql_fetch_row($result)) {
			$ctry_manu_option = $ctry_manu_option."\t\t\t<option value=\"$country_code\">$country_name</option>\n";
		}
		mysql_free_result($result);
		
		echo("\t<tr>\n");
		echo("\t\t<td>Country of manufacture: </td>\n");
		echo("\t\t<td><select name=\"release_country_manu\">\n$ctry_manu_option\t\t</select></td>\n");
		echo("\t</tr>\n");
		
		/* Release date */
		echo("\t<tr>\n");
		echo("\t\t<td>Release date: </td>\n");
		echo("\t\t<td>");
		echo("<input type=\"text\" name=\"release_date_y\" size=\"4\" maxlength=\"4\"> - ");
		echo("<input type=\"text\" name=\"release_date_m\" size=\"2\" maxlength=\"2\"> - ");
		echo("<input type=\"text\" name=\"release_date_d\" size=\"2\" maxlength=\"2\">");
		echo("</td>\n");
		echo("\t</tr>\n");
		
		/* Release year */
		echo("\t<tr>\n");
		echo("\t\t<td>Release year: </td>\n");
		echo("\t\t<td><input type=\"text\" name=\"release_year\" size=\"4\" maxlength=\"4\"></td>\n");
		echo("\t</tr>\n");

		/* Format */
		$query = "SELECT format_code, format_name
					FROM format
					ORDER BY format_name";
		$result = mysql_db_query(DBNAME, $query, $dbh);
		
		while(list($format_code, $format_name) = mysql_fetch_row($result)) {
			$format_option = $format_option."\t\t\t<option value=\"$format_code\">$format_name</option>\n";
		}
		mysql_free_result($result);
		
		echo("\t<tr>\n");
		echo("\t\t<td>Format: </td>\n");
		echo("\t\t<td><select name=\"release_format\">\n$format_option\t\t</select></td>\n");
		echo("\t</tr>\n");
		
		/* Type of Release */
		$query = "SELECT rel_type_code, rel_type_name
					FROM rel_type
					ORDER BY rel_type_name";
		$result = mysql_db_query(DBNAME, $query, $dbh);
		
		while(list($rel_type_code, $rel_type_name) = mysql_fetch_row($result)) {
			$rel_type_option = $rel_type_option."\t\t\t<option value=\"$rel_type_code\">$rel_type_name</option>\n";
		}
		mysql_free_result($result);
		
		echo("\t<tr>\n");
		echo("\t\t<td>Release Type: </td>\n");
		echo("\t\t<td><select name=\"release_type\">\n$rel_type_option\t\t</select></td>\n");
		echo("\t</tr>\n");
		
		/* Release Notes */
		echo("\t<tr>\n");
		echo("\t\t<td valign=\"top\">Notes: </td>\n");
		echo("\t\t<td><textarea name=\"release_notes\" cols=80 rows=6 wrap=\"physical\"></textarea></td>\n");
		echo("\t</tr>\n");
		
		/* Picture Sleeve */
		echo("\t<tr>\n");
		echo("\t\t<td>Picture Sleeve: </td>\n");
		echo("\t\t<td><input type=\"checkbox\" name=\"release_pic_slv\" value=\"Y\"></td>\n");
		echo("\t</tr>\n");
		
		/* Sleeve thumbnail */
		echo("\t<tr>\n");
		echo("\t\t<td>Sleeve thumbnail: </td>\n");
		echo("\t\t<td><input type=\"text\" name=\"release_cover_url\" size=\"80\" maxlength=\"80\"></td>\n");
		echo("\t</tr>\n");
		
		/* Sleeve description */
		echo("\t<tr>\n");
		echo("\t\t<td valign=\"top\">Cover description: </td>\n");
		echo("\t\t<td><textarea name=\"release_cover_desc\" cols=80 rows=6 wrap=\"physical\"></textarea></td>\n");
		echo("\t</tr>\n");

		/* Barcode */
		echo("\t<tr>\n");
		echo("\t\t<td>Barcode: </td>\n");
		echo("\t\t<td><input type=\"text\" name=\"release_bar_code\" size=\"20\" maxlength=\"20\"></td>\n");
		echo("\t</tr>\n");
		
		/* Release Code 1 */
		echo("\t<tr>\n");
		echo("\t\t<td>Code 1: </td>\n");
		echo("\t\t<td><input type=\"text\" name=\"release_code_1\" size=\"20\" maxlength=\"20\"></td>\n");
		echo("\t</tr>\n");
		
		/* Release Code 2 */
		echo("\t<tr>\n");
		echo("\t\t<td>Code 2: </td>\n");
		echo("\t\t<td><input type=\"text\" name=\"release_code_2\" size=\"20\" maxlength=\"20\"></td>\n");
		echo("\t</tr>\n");

		/* Release Code 3 */
		echo("\t<tr>\n");
		echo("\t\t<td>Code 3: </td>\n");
		echo("\t\t<td><input type=\"text\" name=\"release_code_3\" size=\"20\" maxlength=\"20\"></td>\n");
		echo("\t</tr>\n");

		/* Release Code 4 */
		echo("\t<tr>\n");
		echo("\t\t<td>Code 4: </td>\n");
		echo("\t\t<td><input type=\"text\" name=\"release_code_4\" size=\"20\" maxlength=\"20\"></td>\n");
		echo("\t</tr>\n");		

		/* Release Code 5 */
		echo("\t<tr>\n");
		echo("\t\t<td>Code 5: </td>\n");
		echo("\t\t<td><input type=\"text\" name=\"release_code_5\" size=\"20\" maxlength=\"20\"></td>\n");
		echo("\t</tr>\n");

		/* Release Code 6 */
		echo("\t<tr>\n");
		echo("\t\t<td>Code 6: </td>\n");
		echo("\t\t<td><input type=\"text\" name=\"release_code_6\" size=\"20\" maxlength=\"20\"></td>\n");
		echo("\t</tr>\n");
		
		/* CB Code */
		echo("\t<tr>\n");
		echo("\t\t<td>CB Code: </td>\n");
		echo("\t\t<td><input type=\"text\" name=\"release_cb_code\" size=\"10\" maxlength=\"10\"></td>\n");
		echo("\t</tr>\n");
		
		/* LC Code */
		echo("\t<tr>\n");
		echo("\t\t<td>LC Code: </td>\n");
		echo("\t\t<td><input type=\"text\" name=\"release_lc_code\" size=\"10\" maxlength=\"10\"></td>\n");
		echo("\t</tr>\n");
		
		/* Submit button and "upd" hidden input */
		
		echo("\t\t<input type=\"hidden\" name=\"action\" value=\"add\">\n");
		echo("\t\t<input type=\"hidden\" name=\"step\" value=\"2\">\n");
		
		echo("\t<tr>\n");
		echo("\t\t<td colspan=2><input type=\"submit\" name=\"submit\" value=\"Add\"></td>\n");
		echo("\t</tr>\n");
		
		echo("</table>\n");
		echo("</form>\n\n");
		}
		else if ($step == "2") {
			if ($release_pic_slv == "Y") {
				$release_pic_slv = "Y";
			}
			else {
				$release_pic_slv = "N";
			}
			
			$release_date = $release_date_y."-".$release_date_m."-".$release_date_d;
			
			$query = "INSERT INTO release (
							release_name, release_no_tracks, release_label,
							release_country_sale, release_country_manu, release_date,
							release_year, release_format, release_type, release_notes,
							release_pic_slv, release_cover_url, release_cover_desc, 
							release_bar_code, release_code_1, release_code_2, 
							release_code_3, release_code_4, release_code_5, 
							release_code_6, release_cb_code, release_lc_code
						)
						VALUES (
							'$release_name', '$release_no_tracks', '$release_label', 
							'$release_country_sale', '$release_country_manu', '$release_date', 
							'$release_year', '$release_format', '$release_type', '$release_notes', 
							'$release_pic_slv', '$release_cover_url', '$release_cover_desc', 
							'$release_bar_code', '$release_code_1',	'$release_code_2', 
							'$release_code_3', '$release_code_4', '$release_code_5', 
							'$release_code_6', '$release_cb_code', '$release_lc_code'
						)";
			$result = mysql_db_query(DBNAME, $query, $dbh);
		
			echo("<p>Back to <a href=\"release_manage.php?action=lst\">release list</a></p>\n");
		
		
		}
	}
	
	if ($action == "del") {
		if ($step == "1") {
			echo("<p>\n");
			echo("Are you sure you want to delete this entry?<br>\n");
			echo("<a href=\"release_manage.php?action=del&item=$item&step=2\">Yes</a> &nbsp; &nbsp; &nbsp; &nbsp; <a href=\"release_manage.php?action=lst\">No</a>\n");
			echo("</p>\n");
		}
		else if ($step == "2") {
			$query = "DELETE FROM release
						WHERE release_id = '$item'";
			$result = mysql_db_query(DBNAME, $query, $dbh);
			
			echo("<p>Back to <a href=\"release_manage.php?action=lst\">release list</a></p>\n");
		}
		
	}
	
	
	mysql_close($dbh);
	
?>

</body></html>