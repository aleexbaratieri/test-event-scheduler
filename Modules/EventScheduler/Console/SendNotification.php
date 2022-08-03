<?php

namespace Modules\EventScheduler\Console;

use Illuminate\Console\Command;
use Modules\EventScheduler\Jobs\SendEventMailJob;
use Modules\EventScheduler\Services\EventService;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SendNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'events:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification of next 10 minutes events.';

    protected $service;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(EventService $eventService)
    {
        parent::__construct();

        $this->service = $eventService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $events = $this->service->nextEvents();

        $events->each(function($event) {

            dispatch(new SendEventMailJob($event));
            
        });
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            //['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            //['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
