<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdateLicenseEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $license;
    protected $user;
    
    public function __construct($license,$user)
    {
        $this->license = $license;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data['license'] = $this->license;
        $data['user'] = $this->user;
        return $this->subject('Pemberitahuan lisensi anda telah diupdate!!')
        ->view('update-license',$data);
    }
}
