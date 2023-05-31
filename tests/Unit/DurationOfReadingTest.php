<?php

namespace Tests\Unit;

use App\Helpers\DurationOfReading;
use PHPUnit\Framework\TestCase;

class DurationOfReadingTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCanGetDurationOfReadingText()
    {
        // 1 second per word
        $text = 'this is for test';

        $dor = new DurationOfReading();
        $dor->setText($text);

        $this->assertEquals(4, $dor->getTimePerSecond());
        $this->assertEquals(4 / 60, $dor->getTimePerMinute());
    }
}
