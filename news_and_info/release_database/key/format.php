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
<title>Format Information</title></head>
<body bgcolor="#FFFFFF">

<?
	/* Main query */
	$query = "SELECT format_name, format_desc
				FROM format
				WHERE format_code = '$format_code'";
	$result = mysql_db_query(DBNAME, $query, $dbh);
	
	list($format_name, $format_desc) = mysql_fetch_row ($result);
	mysql_free_result($result);
	
	/* Display data */
	
	echo("<h1>Format Information</h1>\n");
	
	echo("<table border=0 width=100%>\n");
	echo("\t<tr>\n");
	echo("\t\t<td class=\"thead\" bgcolor=#A2C2F6>$format_name</td>");
	echo("\t</tr>\n");
	echo("\t<tr>\n");
	echo("\t\t<td>");
	echo("<p>$format_desc</p>");
	
	echo("\t\t</td>\n");
	echo("\t</tr>\n");
	
	$query = "SELECT format_code, format_name
				FROM format
				ORDER BY format_name";
	$result = mysql_db_query(DBNAME, $query, $dbh);
		
	$format_option = "";
	$format_sel = ""; 
	while(list($format_id, $format_name) = mysql_fetch_row($result)) {
		if ($format_id == $format_code) {
			$format_sel = " selected";
		}
		else {
			$format_sel = "";
		}
		$format_option = $format_option."\t\t\t<option value=\"$format_id\"$format_sel>$format_name</option>\n";
	}
	mysql_free_result($result);
	
	echo("\t<tr>\n");
	echo("\t\t<td><form name=\"format_key\" method=\"POST\" action=\"format.php\">\n");
	echo("\t\t<select name=\"format_code\">\n$format_option\t\t</select>\n");
	echo("\t\t<input type=\"submit\" value=\"Re-query\"></form></td>\n");
	echo("\t</tr>\n");
	
	echo("\t<tr>\n");
	echo("\t\t<td class=\"thead\" bgcolor=#A2C2F6><a href=# onClick='top.close();' style='color: #000000; text-decoration: none;'>Close</a></td>\n");
	echo("\t</tr>\n");	
	
	echo("</table>\n");
	
	mysql_close($dbh);
	
?>

</body></html>