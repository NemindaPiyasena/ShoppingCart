<?php
    session_start();
    if(isset($_SESSION)) {
        echo "set"    ;
    } else {
        echo "not set";
    }

?>