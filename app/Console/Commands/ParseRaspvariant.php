<?php

namespace App\Console\Commands;

use App\Modules\Parse\Parse;
use App\Modules\Parse\Transport\Raspvariant\RaspvariantXML;
use Illuminate\Console\Command;

class ParseRaspvariant extends Command
{
    const IMPORT_MODULE_NAME = RaspvariantXML::SOURCE_NAME;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'raspvariant:parse {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse raspvariant.xml and insert into DB';

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
        $this->info(
            "Import XML starting : '" . static::IMPORT_MODULE_NAME . "' < "
            . $this->argument('file')
        );

        (new Parse(static::IMPORT_MODULE_NAME))
            ->importFile($this->argument('file'));

        $this->info(
            "Import XML finished : '" . static::IMPORT_MODULE_NAME . "' < "
            . $this->argument('file')
        );

        return NULL;
    }
}
