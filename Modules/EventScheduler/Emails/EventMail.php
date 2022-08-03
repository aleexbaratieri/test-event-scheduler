<?php

namespace Modules\EventScheduler\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\EventScheduler\Entities\Event;

class EventMail extends Mailable
{
    use Queueable, SerializesModels;

     /**
     * The order instance.
     *
     * @var \Modules\EventScheduler\Entities\Event
     */
    protected $event;

    /**
     * Create a new message instance.
     * 
     * @param \Modules\EventScheduler\Entities\Event $event
     * @return void
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('eventscheduler::mails.event', $this->event->toArray());
    }
}
