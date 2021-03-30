<?php

namespace app\utils;


class Utils
{
    public static function stringifyDate($asoDate) {
        $year = substr($asoDate, 0, 4);
        $month = substr($asoDate, 4, 2);
        $day = substr($asoDate, 6);
        $date = $day . "/" . $month . "/" . $year;
        return $date;
    }
}
