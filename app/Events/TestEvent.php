<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;

class TestEvent implements ShouldBroadcastNow
{
    use Dispatchable;

    public function broadcastOn() { return new Channel('test'); }
    public function broadcastAs()  { return 'TestEvent'; }
    public function broadcastWith() { return ['hello' => 'world']; }
}