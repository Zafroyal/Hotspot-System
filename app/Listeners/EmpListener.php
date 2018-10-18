<?php

namespace App\Listeners;

use App\Events\EmpEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmpListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EmpEvent  $event
     * @return void
     */
    public function handle(EmpEvent $event)
    {
        //
    }
}
