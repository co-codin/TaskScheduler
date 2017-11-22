<?php

use Carbon\Carbon;
use App\Scheduler\Event;
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{
    /** @test */
    public function event_has_default_cron_expression()
    {

        $event = $this->getMockForAbstractClass(Event::class);

        $this->assertEquals($event->expression,'* * * * *');
    }

    /** @test */
    public function event_should_be_run()
    {

        $event = $this->getMockForAbstractClass(Event::class);

        $this->assertTrue($event->isDueToRun(Carbon::now()));
    }

    /** @test */
    public function event_should_not_be_run()
    {

        $event = $this->getMockForAbstractClass(Event::class);
        $event->expression = '0 0 1 * *';

        $this->assertFalse($event->isDueToRun(Carbon::create(2017, 10, 2, 0, 0, 0)));
    }
}
