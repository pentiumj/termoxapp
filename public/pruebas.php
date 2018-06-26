<?php

date_default_timezone_set("America/Bogota");
$time = date_default_timezone_get();



    
    $date = date('Y-m-d H:i:s', time()+60*5);
    echo $date;

