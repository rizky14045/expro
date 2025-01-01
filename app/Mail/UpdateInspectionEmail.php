<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdateInspectionEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $inspection;
    protected $user;
    
    public function __construct($inspection,$user)
    {
        $this->inspection = $inspection;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data['inspection'] = $this->inspection;
        $data['user'] = $this->user;
        return $this->subject('Pemberitahuan inspeksi anda telah diupdate!!')
        ->view('update-inspection',$data);
    }
}
