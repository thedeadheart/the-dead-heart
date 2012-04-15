<!-- MKelly 2000 -->
<!-- The Dead Heart www.deadheart.org.uk -->
<HTML><HEAD>
<LINK REL=stylesheet HREF="songdb.css" TYPE="text/css">
<STYLE type="text/css">
A {	text-decoration : none;
	color : #FFFFFF;}
B { font-weight : bold;}
</STYLE>
<TITLE>Search</TITLE></HEAD>
<body bgcolor="#000000">

<?	require( "db_conf.inc.php3" );
	require( "sdb.func.inc.php3" );
	
	/* if input params, perform a query */
	if ($string and ($song_name or $writers or $orig_ver or $ver_details or $prod_details or $lyrics)) {
		echo("<h2>Results...</h2>");
		
		/*
		 * Create DB connection and get string to match writers by.
		 */
		$dbh = @mysql_connect($host, $user, $pass) or die ("Problem connecting to database");
		/* 
		 * Search writer names specifically. This is based on 
		 * the function writer_name_to_id but is more complex
		 */
		$writer_names = split("/", $string);
		$array_len = sizeof($writer_names);
		for ($i = 0 ; $i < $array_len ; $i++) {
			$writer_name_query = "select writer_id from writers where writer_name like '$writer_names[$i]'";
			$result = mysql_db_query($dbname, $writer_name_query, $dbh);
			list($writer_id_temp) = mysql_fetch_row($result);
			if ($writer_id_temp != "") {
				$writer_id_output = $writer_id_output.$writer_id_temp."/";
			}
			else {
				$writer_id_output = "No possible match";
				break;
			}
		}
		$writer_id_output = preg_replace("/\/$/", "", $writer_id_output);
		//$writer_id_output = "/".$writer_id_output;
		//$writer_id_output_slashes = "/".$writer_id_output."/";
		
		$query = "select id_name, full_name from songs where ";
		/* set up where clauses */
		if ($song_name) {$query .= "full_name like '%$string%' or ";}
		if ($orig_ver) {$query .= "orig_ver like '%$string%' or ";}
		if ($ver_details) {$query .= "ver_details like '%$string%' or ";}
		if ($prod_details) {$query .= "prod_details like '%$string%' or ";}
		if ($lyrics) {$query .= "lyrics like '%$string%' or ";}
		if ($writers) {$query .= "(writers like '$writer_id_output/%' or writers like '%/$writer_id_output/%' or writers like '%/$writer_id_output' or writers = '$writer_id_output') or ";}
		
		$query = substr($query, 0, -4);
		
		$query .= " order by id_name";

		if ($stats_on) {
			$stat_query = "update stats set searches = searches + 1";
			mysql_db_query($dbname, $stat_query, $dbh);
		}
		
		$result = mysql_db_query($dbname, $query, $dbh);
		
		$matches = "";
		
		if (($no_matches = mysql_num_rows($result)) > 0) {
			if ($no_matches == 1) {
				echo("<p><b>1 match...</b></p><p>");
			}
			else {
				echo("<p><b>$no_matches matches...</b></p><p>");
			}
		}
		while(list($id_name, $full_name) = mysql_fetch_row($result)) {
			echo ("<a href=\"song.php3?song_id=".rawurlencode($id_name)."&srchstr=".rawurlencode(stripslashes($string))."\" target=\"details\">$full_name</a><br>\n");
			$matches = "some";
		}
		if (!$matches) {
			echo ("<b>Sorry, no matches.</b>");
		}
		echo ("</p>");
	}

?>



<form action="search.php3" method="get">

<p>Search for...<br>
<? 	echo("<input type=\"Text\" name=\"string\" size=\"20\" maxlength=\"60\" value=\"".stripslashes($string)."\"></p>"); ?>

<p>...on fields: -<br>

<? 	$checked = "";
	if ($song_name) {$checked = "checked";}
	else {$checked = "";}
	echo("<input type=\"Checkbox\" name=\"song_name\" value=\"yes\" $checked> Song name<br>");
	if ($writers) {$checked = "checked";}
	else {$checked = "";}
	echo("<input type=\"Checkbox\" name=\"writers\" value=\"yes\" $checked> Writers<br>");
	if ($orig_ver) {$checked = "checked";}
	else {$checked = "";}
	echo("<input type=\"Checkbox\" name=\"orig_ver\" value=\"yes\" $checked> Major appearance on<br>");
	if ($ver_details) {$checked = "checked";}
	else {$checked = "";}
	echo("<input type=\"Checkbox\" name=\"ver_details\" value=\"yes\" $checked> Version Details<br>");
	if ($prod_details) {$checked = "checked";}
	else {$checked = "";}
	echo("<input type=\"Checkbox\" name=\"prod_details\" value=\"yes\" $checked> Production details<br>");
	if ($lyrics) {$checked = "checked";}
	else {$checked = "";}
	echo("<input type=\"Checkbox\" name=\"lyrics\" value=\"yes\" $checked> Lyrics</p>");
?>
<p><input type="Submit" name="submit" value="Submit"> <input type="Reset" name="reset"></p>

<p><a href="search.html" target="details">Search guidelines...</a></p>

</form>

</BODY></HTML>
