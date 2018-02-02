<?php

namespace App\Modules\Parse\Traits;

use App\Modules\Parse\Converter;
use App\Modules\Parse\Exceptions\ParseLogicException;
use Illuminate\Database\Eloquent\Model;

trait ConverterObjectTrait
{
    private $rules;

    public function getObject(array $prop)
    {
        $converter = new Converter;
        $prop = $converter->getConvertedProp(
            $prop,
            $this->getRules()
        );
        if (property_exists($this, 'DO_NOT_STRIP')) {
            $prop = $converter->getStripedProp(
                $prop,
                $this->getRules()
            );
        }

        return $this->getPreparedObject($prop);
    }
    public function getPreparedObject($prop)
    {
        $object = null;

        $class = static::CLASS_NAME;

        /**
         * @var Model $model
         */
        $model = new $class;

        foreach (static::EXT_PRIMARY as $key) {

            $model = $model->where($key, $prop[$key]);
        }

        $model = $model->get();
        if ($model->count() > 1) {
            throw new ParseLogicException('duplicate by EXT_PRIMARY:' . get_class($this));
        } elseif ($model->count()) {
            $object = $model->first();
        } else {
            $object = new $class;
        }
        $object->fill($prop);

        return $object;
    }

}
