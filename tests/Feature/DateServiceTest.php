<?php

namespace Tests\Feature;

use App\Http\Services\DateService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DateServiceTest extends TestCase
{
    public function testGetDatesFromDateRange()
    {
        $cronString = '0 0 * * *';
        $startDate = '2025-04-13';
        $endDate = '2025-04-15';

        $expectedDates = ['2025-04-13', '2025-04-14', '2025-04-15'];

        $actualDates = DateService::getDatesFromDateRange($cronString, $startDate, $endDate);

        $this->assertEquals($expectedDates, $actualDates);
    }

    public function testGetDatesFromIteration()
    {
        $cronString = '0 0 * * *';
        $iterations = 3;

        $expectedDates = [
            Carbon::now()->format('Y-m-d'), 
            Carbon::now()->addDay()->format('Y-m-d'), 
            Carbon::now()->addDays(2)->format('Y-m-d') 
        ];

        $actualDates = DateService::getDatesFromIteration($cronString, $iterations);

        $this->assertEquals($expectedDates, $actualDates);
    }
}
