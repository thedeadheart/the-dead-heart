<?	/*
	 * Functions for use in Song Database
	 */
	
	/*
	 * Function writer_name_to_id
	 * Input:
	 *		$writers - a list of writer names seperated by forward slashes
	 *		$dbname - the name of the MySQL database (defined in the conf file)
	 *		$dbh - the database handle, which must be defined prior to 
	 *			calling the function
	 * Output:
	 * 		$writer_id_output - a list of writer ids separated by 
	 *			forward slashes
	 */
	function writer_name_to_id($writers, $dbname, $dbh) {
		/* 
		 * Split the names into the array according to slashes
		 * then get length of array (ie number of writers)
		 */
		$writer_names = split("/", $writers);
		$array_len = sizeof($writer_names);
		
		/*
		 * For each writer in the array, build a query string, and 
		 * then request the ids which correspond to the names from
		 * the DB. Then build a string of ids separated by forward
		 * slashes.
		 */
		for ($i = 0 ; $i < $array_len ; $i++) {
			$writer_name_query = "select writer_id from writers where writer_name = '$writer_names[$i]'";
			$result = mysql_db_query($dbname, $writer_name_query, $dbh);
			list($writer_id_temp) = mysql_fetch_row($result);
			$writer_id_output = $writer_id_output.$writer_id_temp."/";
		}
		
		/* Remove final slash and return the string */
		$writer_id_output = preg_replace("/\/$/", "", $writer_id_output);
		return $writer_id_output;
	}
	
	/*
	 * Function writer_id_to_name
	 * Input:
	 *		$writers - a list of writer ids seperated by forward slashes
	 *		$dbname - the name of the MySQL database (defined in the conf file)
	 *		$dbh - the database handle, which must be defined prior to 
	 *			calling the function
	 * Output:
	 * 		$writer_name_output - a list of writer names separated by 
	 *			forward slashes
	 */
	function writer_id_to_name($writers, $dbname, $dbh) {
		/* 
		 * Split the ids into the array according to slashes
		 * then get length of array (ie number of writers)
		 */
		$writer_ids = split ("/", $writers);
		$array_len = sizeof($writer_ids);
		
		/*
		 * For each writer in the array, build a query string, and 
		 * then request the names which correspond to the ids from
		 * the DB. Then build a string of names separated by forward
		 * slashes.
		 */
		for ($i = 0; $i < $array_len ; $i++ ) {
			$writer_id_query = "select writer_name from writers where writer_id = '$writer_ids[$i]'";
			$result = mysql_db_query($dbname, $writer_id_query, $dbh);
			list($writer_name_temp) = mysql_fetch_row($result);
			$writer_name_output = $writer_name_output.$writer_name_temp."/";
		}
		
		/* Remove final slash and return the string */
		$writer_name_output = preg_replace("/\/$/", "", $writer_name_output);
		return $writer_name_output;
	}
?>