<?  //  MRKelly 2003
    //  Functions for use in the song database admin.

    //  This function will conenct to the MySQL server using the
    //  authentication specificied in the config file, and use the resulting
    //  DB handle to select a database.
    //  The DB handle is returned for use by further sections of code.
    function initDB()
    {
        $varDBHandle = mysql_connect( HOST, USER, PASS );
        mysql_select_db( DBNAME, $varDBHandle );

        return $varDBHandle;
    }

    //  If the global DEBUG variable is set then this function will output the
    //  contents of the string/variable passed to it.
    function debugEcho( $varDebugVariable )
    {
        if( DEBUG )
        {
            echo( $varDebugVariable );
        }
    }

    //  This function will return the integer value corresponding to the
    //  string of artists names supplied to it.
    function getArtistsAsInt( $varArtistsAsString )
    {
        //  Define output variable as initially 0 - Unspecified.
        $varArtistsAsInteger = 0;
        
        //  Connect to the DB using own connection so as not to feck up
        //  another connection!
        $varDBHandle = initDB();
        
        
        //  Split the list of names into an array
        $varArrayArtists = explode( "/", $varArtistsAsString );
        $varNumArtists = count( $varArrayArtists );
        for( $varCount = 0; $varCount < $varNumArtists ; $varCount++ )
        {
            $varQuery = "SELECT writer_id
                FROM writers
                WHERE writer_name = '".$varArrayArtists[ $varCount ]."'";
            $varResult = mysql_query( $varQuery, $varDBHandle );

            if( !$varResult )
            {
                //  No match for one of the entries - return unspecified
                return 0;
            }
            
            list( $dbVarWriterId ) = mysql_fetch_row( $varResult );
            $varArtistsAsInt = $varArtistsAsInt + $dbVarWriterId;
        }

        return $varArtistsAsInt;
    }


    //  This function will return a string of artist names corresponding to
    //  the integer value supplied to it
    function getArtistsAsString( $varArtistsAsInt )
    {
        $varArtistsAsString = "";
        
        //  Connect to the DB using own connection so as not to feck up
        //  another connection!
        $varDBHandle = initDB();

        //  Read all the info from the database
        $varQuery = "SELECT writer_id, writer_name
            FROM writers
            WHERE writer_id != 0
            ORDER BY writer_id ASC";
        $varResult = mysql_query( $varQuery, $varDBHandle );

        if( !$varResult )
        {
            //  No result - return unspecified
            return "";
        }
        
        $varWriter = array();
        while( list( $dbVarWriterId, $dbVarWriterName) 
                = mysql_fetch_row( $varResult ) )
        {
            $varWriter[ $dbVarWriterId ] = $dbVarWriterName;
        }
        
        foreach ( $varWriter as $varWriterKey => $varWriterValue )
        {
            if( $varWriterKey & $varArtistsAsInt )
            {
                if( $varArtistsAsString )
                {
                    $varArtistsAsString = $varArtistsAsString."/";
                }
                $varArtistsAsString = $varArtistsAsString.$varWriterValue;
            }
        }
        
        return $varArtistsAsString;
    }

    //  This function will return a time string as a time in seconds
    //  Assumes string format is xx:xx
    function getTimeAsSeconds( $varTimeAsString )
    {
        $varTempArray = explode( ":", $varTimeAsString );
        $varTimeAsSeconds = $varTimeAsSeconds + ( $varTempArray[ 0 ] * 60 );
        $varTimeAsSeconds = $varTimeAsSeconds + $varTempArray[ 1 ];

        return $varTimeAsSeconds;
    }

    //  This function will return a time value as a string
    //  Assumes the time is an integer value
    function getTimeAsString( $varTimeAsSeconds )
    {
        $varTimeAsString = 
            ( int )( $varTimeAsSeconds / 60 ).":";
        $varTimeAsString = $varTimeAsString.sprintf( "%02d", ( $varTimeAsSeconds % 60 ) );
        return $varTimeAsString;
    }
        
?>
    
