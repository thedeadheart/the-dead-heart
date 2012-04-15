<? 

    function to_human_date($mysql_date, $show_time)
    {
        $month_array = array
        (
            "Jan", "Feb", "Mar", "Apr", "May", "Jun",
            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
        );

        $human_date = "";
        if ( $halves = split(" ", $mysql_date) )
        {
            $date = $halves[0];
            if ( $date_parts = split("-", $date) )
            {
                $year = $date_parts[0];
                $month = $month_array [$date_parts[1] - 1];
                $day = $date_parts[2];
                
                $human_date = $day." ".$month." ".$year;
            }
            else
            {
                $human_date = $date;
            }
            
            if ($show_time)
            {
                $time = $halves[1];
                if ( $time_parts = split(":", $time) )
                {
                    $hour = $time_parts[0];
                    $minute = $time_parts[1];
                    
                    if ( $hour == "00" and $minute == "00" )
                    {
                        $human_date = $human_date;
                    }
                    else
                    {
                        $human_date = $human_date.", ".$hour.":".$minute;
                    }
                }
                else
                {
                    $human_date = $human_date.", ".$date;
                }
            }        
            return $human_date;
        }
        else
        {
            return $human_date;
        }
    }
?>
