<?php

namespace Modules\Users\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendUserContactEmail extends Mailable
{
    use Queueable, SerializesModels;
	
    public function __construct()
    {
        //
    }
	
    public function build(): self
    {
        return $this->view('view.name');
    }
}
