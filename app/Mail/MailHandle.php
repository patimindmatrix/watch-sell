<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailHandle extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $data;

    public function __construct($data)
    {
        $this -> data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this -> data['type'] == "MessageFromUser"){
            return $this->from($this -> data['email'], $this -> data['name'])
                ->view($this -> data['pathView'])
                ->subject($this -> data['subject']);
        }
        else{
            return $this->from("ndtdeveloper1705@gmail.com", "Đức Thủy")
                ->view($this -> data['pathView'])
                ->subject("[RuizClock] Đặt lại mật khẩu ứng dụng");
        }
    }
}
