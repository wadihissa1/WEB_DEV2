<?php

namespace App\Event;
use App\Models\Bid;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewBid implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $bid;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Bid $bid)
    {
        $this->bid = $bid;
        \Log::info("Bid is: $bid");
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        \Log::info('NewBid event is being broadcasted.');
        $event_id = $this->bid->event_id;
        $channelName = 'event-' . $event_id;
        \Log::info("Broadcasting NewBid event on channel: $channelName");
        return new Channel('event-'.$event_id);
    }


    public function broadcastAs(): string
    {
        return 'NewBid';
    }



}
