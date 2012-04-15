<? 	/*
	 * HTML forms to manage the release table
	 */

	require("../conf.inc.php");
	
	$dbh = mysql_connect(HOST, USER, PASS);
?>
<!-- MKelly 2000 -->
<!-- The Dead Heart http://www.deadheart.org.uk/ -->
<html><head>
<link href="../discog.css" rel="STYLESHEET" type="text/css">
<title>Record Label Information</title></head>
<body bgcolor="#FFFFFF">

<?
	/* Main query */
	$query = "SELECT rec_label_name, rec_label_desc
				FROM rec_label
				WHERE rec_label_code = '$rec_label_code'";
	$result = mysql_db_query(DBNAME, $query, $dbh);
	
	list($rec_label_name, $rec_label_desc) = mysql_fetch_row ($result);
	mysql_free_result($result);
	
	/* Display data */
	
	echo("<h1>Record Label Information</h1>\n");
	
	echo("<table border=0 width=100%>\n");
	echo("\t<tr>\n");
	echo("\t\t<td class=\"thead\" bgcolor=#A2C2F6>$rec_label_name</td>");
	echo("\t</tr>\n");
	echo("\t<tr>\n");
	echo("\t\t<td>");
	echo("<p>$rec_label_desc</p>");
	
	echo("\t\t</td>\n");
	echo("\t</tr>\n");
	
	$query = "SELECT rec_label_code, rec_label_name
				FROM rec_label
				ORDER BY rec_label_name";
	$result = mysql_db_query(DBNAME, $query, $dbh);
		
	$rec_label_option = "";
	$rec_label_sel = ""; 
	while(list($rec_label_id, $rec_label_name) = mysql_fetch_row($result)) {
		if ($rec_label_id == $rec_label_code) {
			$rec_label_sel = " selected";
		}
		else {
			$rec_label_sel = "";
		}
		$rec_label_option = $rec_label_option."\t\t\t<option value=\"$rec_label_id\"$rec_label_sel>$rec_label_name</option>\n";
	}
	mysql_free_result($result);
	
	echo("\t<tr>\n");
	echo("\t\t<td><form name=\"rec_label_key\" method=\"POST\" action=\"rec_label.php\">\n");
	echo("\t\t<select name=\"rec_label_code\">\n$rec_label_option\t\t</select>\n");
	echo("\t\t<input type=\"submit\" value=\"Re-query\"></form></td>\n");
	echo("\t</tr>\n");
	
	echo("\t<tr>\n");
	echo("\t\t<td class=\"thead\" bgcolor=#A2C2F6><a href=# onClick='top.close();' style='color: #000000; text-decoration: none;'>Close</a></td>\n");
	echo("\t</tr>\n");	
	
	echo("</table>\n");
	
	mysql_close($dbh);
	
?>

</body></html>