<?php

namespace App\Console\Commands;

use App\Models\Bus\Graph;
use Illuminate\Console\Command;

class EventsRaspvariant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'raspvariant:get_events {graph_num?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Events';

    /**
     * @var string
     */
    protected $import_file;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $graph_query = $this->argument('graph_num')
            ? Graph::where('num', $this->argument('graph_num'))
            : Graph::query();
        $event_count = 0;
        $time_count = 0;
        foreach ($graph_query->get() as $graph) {
            /**
             * @var $graph Graph
             */
            $event_count += $graph->getRaspEventCount();
            $time_count += $graph->getRaspTimeCount();
        }

        $this->info('Statistics: Industrial Event for '
            . ($this->argument('graph_num') ? '#' . $this->argument('graph_num') : 'All')
            . " Graph is:\nCOUNT: {$event_count}\nTIME: {$time_count} min"
        );

        return NULL;
    }
}
