<?php

namespace App\Listeners;

use App\Events\UpdateProduct;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Redis;

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

    
    public function handle(UpdateProduct $event)
    {
        Redis::set('P_'.$event->product->first()->id, json_encode($event->product));
        Redis::expire('P_'.$event->product->first()->id, 3600);
    }
}
