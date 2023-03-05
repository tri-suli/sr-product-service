<?php

namespace App\Events;

use App\Contracts\Models\Product;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\SerializesModels;

class SyncUploadedImagesWithProduct
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The product model instance
     *
     * @var Product
     */
    public Product $product;

    /**
     * The uploaded images list
     *
     * @var array<int, UploadedFile>
     */
    public array $images;

    /**
     * Create a new event instance.
     *
     * @param   Product     $product
     * @param   array<UploadedImage>   $images
     * @return  void
     */
    public function __construct(Product $product, array $images)
    {
        $this->product = $product;
        $this->images = $images;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
