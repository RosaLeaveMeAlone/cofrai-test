<?php

namespace App\Http\Services;


class DateService
{

    public static function translateCron($cronString)
    {
        $cronParts = explode(' ', $cronString);
    
        $daysOfWeek = $cronParts[4] == '*' ? '' : 'every ' . implode(', ', self::mapDaysOfWeek($cronParts[4]));
    
        if ($cronParts[2] != '*' && $cronParts[4] == '*') {
            $result = 'every ' . self::ordinalSuffix($cronParts[2]) . " day of each month";
        } elseif ($cronParts[2] == '*' && $cronParts[4] != '*') {
            $result = $daysOfWeek;
        } else {
            $result = "every day";
        }
    
        return $result;
    }

    private static function ordinalSuffix($number) {

        switch ($number % 10) {
            case 1: return $number.'st';
            case 2: return $number.'nd';
            case 3: return $number.'rd';
            default: return $number.'th';
        }
    }

    private static function mapDaysOfWeek($daysString) {
        $days = explode(',', $daysString);
        $result = [];
        foreach ($days as $day) {
            switch ($day) {
                case 0:
                    $result[] = 'Sunday';
                    break;
                case 1:
                    $result[] = 'Monday';
                    break;
                case 2:
                    $result[] = 'Tuesday';
                    break;
                case 3:
                    $result[] = 'Wednesday';
                    break;
                case 4:
                    $result[] = 'Thursday';
                    break;
                case 5:
                    $result[] = 'Friday';
                    break;
                case 6:
                    $result[] = 'Saturday';
                    break;
                case 7:
                    $result[] = 'Sunday';
                    break;
            }
        }
        return $result;
    }


}
