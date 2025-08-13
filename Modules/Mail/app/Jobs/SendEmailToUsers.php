<?php

namespace Modules\Mail\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
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
        foreach ($this->userEmails as $email) {
            try {
                Mail::html($this->content, function ($message) use ($email) {
                    $message->to($email)
                        ->subject($this->subject);
                });
            } catch (\Exception $e) {
                Log::error("Mail not delivered to: {$email} - " . $e->getMessage());
            }
        }
    }
}
