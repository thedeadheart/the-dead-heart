<!-- MKelly 2000 -->
<!-- The Dead Heart www.deadheart.org.uk -->
<HTML>
<link href="songdb.css" rel="STYLESHEET" type="text/css">
<style type="text/css">
A {	text-decoration : none;
	color : White;}
P { color : White;}
</style>
<HEAD><TITLE>Load Results</TITLE></HEAD>
<body bgcolor="#000000">

<h1>Load Results</h1>

<?	require('conf.inc.php3'); 

	
	function split_sql($sql)
{
    $sql = trim($sql);
    $buffer = array();
    $ret = array();
    $in_string = false;

    for($i=0; $i<strlen($sql); $i++)
    {
		
         if($sql[$i] == ";" && !$in_string)
        {
            $ret[] = substr($sql, 0, $i);
            $sql = substr($sql, $i + 1);
            $i = 0; 
		}
		
        if($in_string && ($sql[$i] == $in_string) && $buffer[0] != "\\")
        {
             $in_string = false;
        }
        elseif(!$in_string && ($sql[$i] == "\"" || $sql[$i] == "'") && $buffer[0] != "\\")
        {
             $in_string = $sql[$i];
        }
        if(isset($buffer[1]))
        {
            $buffer[0] = $buffer[1];
        }
        $buffer[1] = $sql[$i];
		
		$sql[$i];
     }    
    
    if (!empty($sql))
    {
        $ret[] = $sql;
    }
	
    return($ret);
}

	$dbh = mysql_connect($host, $user, $pass) or die ("<p>Could not connect to database</p><a href=\"pw_check.php3?al_in=true\"><b>Return</b></a> to the admin menu.</p>");
	
	$sqlquery = trim($sqlquery);
	$pieces = split_sql($sqlquery);

	for ($i=0; $i<count($pieces); $i++)
    {

    $result = mysql_db_query ($dbname, stripslashes($pieces[$i]), $dbh) or die("<p>Query could not be executed.</p><a href=\"pw_check.php3?al_in=true\"><b>Return</b></a> to the admin menu.</p>");
	
    }
	
	echo("<p>The query has been executed successfully.</p>");
?>

<p><a href="pw_check.php3?al_in=true"><b>Return</b></a> to the admin menu.</p>

</body></html>