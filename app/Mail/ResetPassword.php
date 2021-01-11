<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $data;
    protected $name;
    public function __construct($data,$name)
    {
        $this->data=$data;
        $this->name=$name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email')
        ->subject('Buku-Online Id')
        ->replyTo('noreply@buku-online.id')
        ->from('noreply@buku-online.id','buku-online.id')
        ->with(['token' => $this->data,'name'=>$this->name]);
    }
}
