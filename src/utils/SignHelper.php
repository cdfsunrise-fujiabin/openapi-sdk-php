<?php

namespace utils;

require_once(__DIR__.'/../../index.php');

class SignHelper
{
    public static function sign($dataArray): string {
        uksort($dataArray, function($a, $b) {
            return $a <=> $b;
        });

        $keys = array_keys($dataArray);
        $jointStr = "";
        foreach ($keys as $key) {
            $val = $dataArray[$key];
            $jointStr .= $key . "=" . $val . "&";
        }
        $jointStr = trim($jointStr, "&");

        return md5($jointStr);
    }

    public static function getTimestamp(): string {
        return (string)time();
    }
}