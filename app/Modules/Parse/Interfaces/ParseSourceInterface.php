<?php

namespace App\Modules\Parse\Interfaces;

interface ParseSourceInterface
{
    public function setImportFile(string $import_file);

    public function setImportString(string $xml);

    public function import();
}