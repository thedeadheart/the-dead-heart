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
<title>Release Type Information</title></head>
<body bgcolor="#FFFFFF">

<?
	/* Main query */
	$query = "SELECT rel_type_name, rel_type_desc
				FROM rel_type
				WHERE rel_type_code = '$rel_type_code'";
	$result = mysql_db_query(DBNAME, $query, $dbh);
	
	list($rel_type_name, $rel_type_desc) = mysql_fetch_row ($result);
	mysql_free_result($result);
	
	/* Display data */
	
	echo("<h1>Release Type Information</h1>\n");
	
	echo("<table border=0 width=100%>\n");
	echo("\t<tr>\n");
	echo("\t\t<td class=\"thead\" bgcolor=#A2C2F6>$rel_type_name</td>");
	echo("\t</tr>\n");
	echo("\t<tr>\n");
	echo("\t\t<td>");
	echo("<p>$rel_type_desc</p>");
	
	echo("\t\t</td>\n");
	echo("\t</tr>\n");
	
	$query = "SELECT rel_type_code, rel_type_name
				FROM rel_type
				ORDER BY rel_type_name";
	$result = mysql_db_query(DBNAME, $query, $dbh);
		
	$rel_type_option = "";
	$rel_type_sel = ""; 
	while(list($rel_type_id, $rel_type_name) = mysql_fetch_row($result)) {
		if ($rel_type_id == $rel_type_code) {
			$rel_type_sel = " selected";
		}
		else {
			$rel_type_sel = "";
		}
		$rel_type_option = $rel_type_option."\t\t\t<option value=\"$rel_type_id\"$rel_type_sel>$rel_type_name</option>\n";
	}
	mysql_free_result($result);
	
	echo("\t<tr>\n");
	echo("\t\t<td><form name=\"rel_type_key\" method=\"POST\" action=\"rel_type.php\">\n");
	echo("\t\t<select name=\"rel_type_code\">\n$rel_type_option\t\t</select>\n");
	echo("\t\t<input type=\"submit\" value=\"Re-query\"></form></td>\n");
	echo("\t</tr>\n");

	echo("\t<tr>\n");
	echo("\t\t<td class=\"thead\" bgcolor=#A2C2F6><a href=# onClick='top.close();' style='color: #000000; text-decoration: none;'>Close</a></td>\n");
	echo("\t</tr>\n");	
	
	echo("</table>\n");
	
	mysql_close($dbh);
	
?>

</body></html>