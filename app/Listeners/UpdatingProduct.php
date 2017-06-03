<?php

namespace App\Listeners;

use App\Events\UpdateProduct;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdatingProduct
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
     * @param  UpdateProduct  $event
     * @return void
     */
    public function handle(UpdateProduct $event)
    {
        //
    }
}
