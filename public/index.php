<?php
include("../src/includes.php");
 Symulation::symulateOneGame();
    foreach ($GLOBALS["logs"] as $log) {
        echo $log."<br>";
    }
?>
