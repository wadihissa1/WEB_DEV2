<?php

namespace App\Mail;

use App\Models\Product;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class HighestBidWinnerNotification extends Mailable
{
    use Queueable, SerializesModels;

    use Queueable, SerializesModels;

    public $user;
    public $product;
    public $bidAmount;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Product $product, $bidAmount)
    {
        $this->user = $user;
        $this->product = $product;
        $this->bidAmount = $bidAmount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Congratulations! You won the product')->view('emails.highest_bid_winner');
    }
}
