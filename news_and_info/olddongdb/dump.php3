<HTML><HEAD><TITLE></TITLE></HEAD>
<BODY>
<? mysql_connect('localhost', 'mkelly', 'midnight');
$result = mysql_db_query('mkelly', "SELECT * FROM songs") or mysql_die();
 while ($row = mysql_fetch_row($result))
       {
       $schema_insert = "INSERT INTO songs VALUES(";
       for ($j=0; $j<mysql_num_fields($result);$j++)
           {
           if (!isset($row[$j]))
              {
              $schema_insert .= " NULL,";
              }
           elseif ($row[$j] != "")
              {
              $schema_insert .= " '".addslashes($row[$j])."',";
              }
           else
              {
              $schema_insert .= " '',";
              }
           }
       $schema_insert = ereg_replace(",$", "", $schema_insert);
       $schema_insert .= ")";
       }

        echo ("<pre>".$schema_insert."</pre>");

	$query = "SELECT id_name, full_name from songs";
	$result = mysql('mkelly', $query);
	if ($result == -1) {
		echo("Error: $phperrmsg\n");
		exit(1);
	}
	
	$upinitial = strtoupper($initial);
	echo ("<h2>$upinitial</h2>\n");
	while(list($id_name, $full_name) = mysql_fetch_row($result)) {
		echo ("<a href=\"song.php3?song_id=$id_name\" target=\"details\">$full_name</a><br>\n");
	}

?>
</BODY></HTML>