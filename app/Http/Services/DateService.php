<?php

namespace App\Http\Services;

use Cron\CronExpression;
use Carbon\Carbon;


class DateService
{

    public static function getDatesFromDateRange($cronString, $startDate, $endDate)
    {
        $cron = new CronExpression($cronString);
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);
        $dates = [];
        
        $nextRunDate = $startDate;
        while ($nextRunDate->lte($endDate)){
            $nextRunDate = $cron->getNextRunDate($nextRunDate, 0, true);
            $nextRunDateCarbon = Carbon::parse($nextRunDate->format('Y-m-d'));
            if ($nextRunDateCarbon->lte($endDate)) {
                $dates[] = $nextRunDate->format('Y-m-d');
            }
            $nextRunDate = $nextRunDateCarbon->addDay();
        }
        return $dates;
    }

    public static function getDatesFromIteration($cronString, $iterations)
    {
        $cron = new CronExpression($cronString);
        $nextRunDate = Carbon::now();
        $dates = [];
        
        for ($i = 0; $i < 3; $i++) {
            $nextRunDate = $cron->getNextRunDate($nextRunDate, 0, true);
            $nextRunDateCarbon = Carbon::parse($nextRunDate->format('Y-m-d'));
            $dates[] = $nextRunDate->format('Y-m-d');
            $nextRunDate = $nextRunDateCarbon->addDay();
        }
        return $dates;
    }

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
