<?php

namespace Modules\EventScheduler\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\EventScheduler\Emails\EventMail;
use Modules\EventScheduler\Entities\Event;

class SendEventMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $event;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Event $event)
    {
       $this->event = $event;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            
            Mail::to($this->event->email_to_notification)->send(new EventMail($this->event));
            
            $this->event->update([
                'sent' => true,
                'sent_time' => Carbon::now()->timestamp
            ]);
        
        } catch (\Exception $err) {

            Log::error($err->getMessage());
        }
    }
}
