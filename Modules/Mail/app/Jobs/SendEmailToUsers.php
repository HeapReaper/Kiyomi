<?php

namespace Modules\Mail\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendEmailToUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userEmails;
    protected $subject;
    protected $content;

    public function __construct($userEmails, $subject, $content)
    {
        $this->userEmails = $userEmails;
        $this->subject = $subject;
        $this->content = $content;
    }

    public function handle(): void
    {
        Mail::html($this->content, function ($message) {
            $message->bcc($this->userEmails)
                ->subject($this->subject);
        });
    }
}
