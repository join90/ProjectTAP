<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Product;


class UpdateProduct
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $product;


    public function __construct(Product $product)
    {
        $this->product = $product;
        
    }

    
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
