<?php

namespace App\Modules\Parse\Transport\Raspvariant;

use App\Models\Raspvariant\Raspvariant;
use App\Models\Bus\Event;
use App\Models\Bus\Graph;
use App\Models\Bus\Smena;
use App\Models\Bus\Stop;
use App\Modules\Parse\Exceptions\ParseLogicException;
use App\Modules\Parse\Interfaces\ConvertRulesInterface;
use App\Modules\Parse\Interfaces\ParseSourceInterface;
use App\Modules\Parse\Transport\Raspvariant\Object\EventConvertObject;
use App\Modules\Parse\Transport\Raspvariant\Object\GraphConvertObject;
use App\Modules\Parse\Transport\Raspvariant\Object\RaspvariantConvertObject;
use App\Modules\Parse\Transport\Raspvariant\Object\SmenaConvertObject;
use App\Modules\Parse\Transport\Raspvariant\Object\StopConvertObject;
use Symfony\Component\DomCrawler\Crawler;
use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class RaspvariantXML implements ParseSourceInterface
{
    const SOURCE_NAME = 'raspvariant';

    /**
     * @var Crawler
     */
    private $xml_parser;

    /**
     * @var ConvertRulesInterface[]
     */
    protected $converters = [
        RaspvariantConvertObject::class,
        GraphConvertObject::class,
        SmenaConvertObject::class,
        EventConvertObject::class,
        StopConvertObject::class,
    ];

    /**
     * @var ConvertRulesInterface[]
     */
    protected $object_converter = [];

    public function __construct()
    {
        foreach ($this->converters as $converter) {
            $converter = new $converter;
            $this->object_converter[$converter->getClassName()] = $converter;
        }
    }

    public function getConverter(string $class_name)
    {
        if (empty($this->object_converter[$class_name])) {
            throw new ParseLogicException("object_convert {$class_name} is not defined");
        }

        return $this->object_converter[$class_name];
    }

    public function setImportFile(string $import_file)
    {
        $this->setImportString(
            file_get_contents($import_file)
        );
    }

    public function setImportString(string $xml)
    {
        $this->xml_parser = new Crawler($xml);
    }

    public function import()
    {
        if (!$this->xml_parser) {
            throw new ParseLogicException('XML Not setted. Set XML first');
        }

        DB::transaction(function () {
            $this->run();
        },5);
    }

    protected function run()
    {
        foreach ($this->xml_parser as $raspvariantNode) {
            $raspvariant = $this->getObjectFromNode(
                $raspvariantNode,
                $this->getConverter(Raspvariant::class)
            );
            $raspvariant->save();

            foreach ($raspvariantNode->childNodes as $graphNode) {
                if (!$graphNode instanceof \DOMElement || $graphNode->nodeName != 'graph') {
                    continue;
                }

                $graph = $this->getObjectFromNode(
                    $graphNode,
                    $this->getConverter(Graph::class),
                    ['raspvariant_id' => $raspvariant->id]
                );

                $graph->save();

                $smena = $this->getObjectFromNode(
                    $graphNode,
                    $this->getConverter(Smena::class),
                    ['graph_id' => $graph->id]
                );

                $smena->save();

                foreach ($graphNode->childNodes as $eventNode) {
                    if (!$eventNode instanceof \DOMElement || $eventNode->nodeName != 'event') {
                        continue;
                    }
                    $event = $this->getObjectFromNode(
                        $eventNode,
                        $this->getConverter(Event::class),
                        ['smena_id' => $smena->id]
                    );
                    $event->save();

                    foreach ($eventNode->childNodes as $stopNode) {
                        if (!$stopNode instanceof \DOMElement || $stopNode->nodeName != 'stop') {
                            continue;
                        }
                        $stop = $this->getObjectFromNode(
                            $stopNode,
                            $this->getConverter(Stop::class),
                            ['event_id' => $event->id]
                        );
                        $stop->save();
                    }
                }
            }
        }

        DB::statement('INSERT INTO stop_points (id,name) SELECT DISTINCT st_id, CONCAT(\'Stop - \',st_id) FROM stops');

        Schema::table('stops', function (Blueprint $table) {
            $table->foreign('st_id')
                ->references('id')
                ->on('stop_points');
        });



    }

    protected function getObjectFromNode(
        \DOMElement $node,
        ConvertRulesInterface $converter,
        array $mixins = []
    )
    {
        $prop = [];
        foreach (array_keys($converter->getRules()) as $name) {

            if ($node->hasAttribute($name)) {
                $prop[$name] = $node->getAttribute($name);
            }
        }
        return  $converter->getObject($prop + $mixins);
    }

}
