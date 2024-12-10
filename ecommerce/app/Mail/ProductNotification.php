<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductCreatedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $productName;

    /**
     * Create a new message instance.
     */
    public function __construct($productName)
    {
        $this->productName = $productName;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Nuevo Producto Creado')
                    ->view('emails.product_created')
                    ->with(['productName' => $this->productName]);
    }
}



