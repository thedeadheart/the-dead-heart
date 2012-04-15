<? 	/*
	 * HTML forms to manage the track_rel_mpg table
	 */

	require("conf.inc.php");
	
	$dbh = mysql_connect(HOST, USER, PASS);
?>
<!-- MKelly 2000 -->
<!-- The Dead Heart http://www.deadheart.org.uk/ -->
<html><head><title>Track-Release Mapping Maintenance</title></head>
<body bgcolor="#FFFFFF">
<h1>Track-Release Mapping Maintenance</h1>

<?
	if ($action == "lst" or $action == "") {
		$query = "SELECT release_id, release_name, release_country_sale, release_type, release_format
					FROM release
					ORDER BY release_name, release_type, release_country_sale, release_format";
		$result = mysql_db_query(DBNAME, $query, $dbh);
		
		echo ("<table>\n");
		while (list($release_id, $release_name, $release_country_sale, $release_type, $release_format) = mysql_fetch_row($result)) {
			echo("\t<tr>\n");
			echo("\t\t<td><a href=\"track_rel_mpg_manage.php?action=edt&item=$release_id\">$release_name</a>");
			echo(" ($release_type, $release_country_sale, $release_format)</td>\n");
			echo("\t</tr>\n");
		}
		echo ("</table>\n");
		
		mysql_free_result($result);
	}
	
	if ($action == "edt") {
		$selected = "";
		$query = "SELECT release_id, release_name, release_no_tracks
					FROM release
					WHERE release_id = '$item'";
		$result = mysql_db_query(DBNAME, $query, $dbh);
		list($release_id, $release_name, $release_no_tracks) = mysql_fetch_row($result);
		mysql_free_result($result);
		
		$query = "SELECT track_rel_mpg_id, track_id, rel_id, rel_order
					FROM track_rel_mpg
					WHERE rel_id = '$release_id'
					ORDER BY rel_order";
		$result = mysql_db_query(DBNAME, $query, $dbh);
		$skip_next = 0;
		
		echo("<form>\n");
		
		$count = 0;
		$query = "SELECT track_id, track_name, track_length
					FROM track
					ORDER BY track_name";
		$result2 = mysql_db_query(DBNAME, $query, $dbh);
		
		while(list($track_id2, $track_name, $track_length) = mysql_fetch_row($result2)) {
			$track_id_arr[$count] = $track_id2;
			$track_name_arr[$count] = $track_name;
			$track_length_arr[$count] = $track_length;
			$count++;
		}
		mysql_free_result($result2);
		
		$arr_size = sizeof($track_id_arr);		
		
		for ($i = 1; $i <= $release_no_tracks ; $i++) {
			$option_list = "<option value=\"\">Null entry</option>\n";
			if (!$skip_next) {
				list($track_rel_mpg_id, $track_id1, $rel_id, $rel_order) = mysql_fetch_row($result);
			}
			if ($i == $rel_order) {
				$skip_next = 0;
			}
			else {
				$skip_next = 1;
			}
			for($j = 0; $j < $arr_size; $j++) {
				if ($track_id1 == $track_id_arr[$j] and !$skip_next) {
					$selected = " selected";
				}
				else {
					$selected = "";
				}
				$option_list = $option_list."<option value=\"$track_id_arr[$j]\"$selected>$track_name_arr[$j] - $track_length_arr[$j]</option>\n";
			}
			if ($skip_next) {
				echo("<input type=\"hidden\" name=\"track_rel_mpg_id[$i]\" value=\"\">\n");
			}
			else {
				echo("<input type=\"hidden\" name=\"track_rel_mpg_id[$i]\" value=\"$track_rel_mpg_id\">\n");
			}
			echo("Track no. $i <select name=\"rel_order[$i]\">$option_list<select><br>\n\n");
		}
		if($rel_id == "") {
			$rel_id = $item;
		}
		echo("<input type=\"hidden\" name=\"rel_id\" value=\"$rel_id\">\n");
		echo("<input type=\"hidden\" name=\"action\" value=\"upd\">\n");
		echo("<input type=\"submit\" name=\"submit\" value=\"Update\">\n");
		echo("</form>\n\n");
		mysql_free_result($result);
		
		$query = "SELECT track_rel_mpg_id, track_id, rel_id, rel_order
					FROM track_rel_mpg
					WHERE rel_id = '$rel_id'
						AND rel_order > '$release_no_tracks'";
		$result = mysql_db_query(DBNAME, $query, $dbh);
		if (mysql_num_rows($result) > 0) {
			echo("<p>This release has ".mysql_num_rows($result)." unmatched track mappings</p>");
		}
		mysql_free_result($result);
		
	}
	
	if ($action == "upd") {
		$length = sizeof($rel_order);
	
		for ($i = 1; $i <= $length; $i++) {
			if($rel_order[$i]) {
				if ($track_rel_mpg_id[$i]) {
					$query = "UPDATE track_rel_mpg
								SET track_id = '$rel_order[$i]'
								WHERE track_rel_mpg_id = $track_rel_mpg_id[$i]";
				}
				else {
					$query = "INSERT INTO track_rel_mpg (track_id, rel_id, rel_order)
								VALUES($rel_order[$i], $rel_id, $i)";
				}
				$result = mysql_db_query(DBNAME, $query, $dbh);
			}
			else {
				$query = "DELETE from track_rel_mpg
							WHERE track_rel_mpg_id = $track_rel_mpg_id[$i]";
				$result = mysql_db_query(DBNAME, $query, $dbh);
			}
		}
		echo("<p>Return to the <a href=\"track_rel_mpg_manage.php?action=lst\">list of releases</a></p>\n");
	}
	
	
	
	
	mysql_close($dbh);
	
?>

</body></html>