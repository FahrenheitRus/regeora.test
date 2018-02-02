<?php

namespace App\Modules\Parse;

use App\Modules\Parse\Exceptions\ParseLogicException;
use App\Modules\Parse\Interfaces\ParseSourceInterface;
use App\Modules\Parse\Transport\Raspvariant\RaspvariantXML;

class Parse
{
    /**
     * @var ParseSourceInterface
     */
    private $sync_source;
    private $source_name;

    public function __construct(string $source_name)
    {
        $this->source_name = $source_name;
        switch ($this->source_name) {
            case RaspvariantXML::SOURCE_NAME:
                $this->sync_source = new RaspvariantXML();
                break;
            default:
                throw new ParseLogicException("Type not supported: {$this->source_name}");
        }
    }

    public function getSyncSource() : ParseSourceInterface
    {
        return $this->sync_source;
    }

    public function importFile(string $import_file)
    {
        $this->getSyncSource()->setImportFile($import_file);
        $this->getSyncSource()->import();
    }

    public function importString(string $data)
    {
        $this->getSyncSource()->setImportString($data);
        $this->getSyncSource()->import();
    }
}
