<?php


class Utils
{
    public static function tryLuck($chance): bool {
        $rNum = rand(1, 100);
        if($rNum<$chance)
            return true;
        return false;
    }
    public static function log($message) {
        $logs = [];
        if(isset($GLOBALS["logs"]))
            $logs = $GLOBALS["logs"];
        array_push($logs, $message);
        $GLOBALS["logs"] = $logs;
    }
}