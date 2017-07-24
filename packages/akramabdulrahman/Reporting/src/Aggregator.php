<?php
/**
 * Created by PhpStorm.
 * User: blackthrone91
 * Date: 5/11/2017
 * Time: 5:15 AM
 */

namespace packages\akramabdulrahman\Reporting\src;


class Aggregator
{
    private
        $subject,//model to inspect
        $relation_name,//subject relation name
        $measurement,//model baseline state
        $regarding_targets,//model relations
        $method;//count,max,min

    function __construct($subject, $relation, $measurement, $regarding_targets, $method = 'count')
    {

        $this->subject = $subject;
        $this->relation_name = $relation ? $relation : str_plural(class_basename($subject));
        $this->measurement = $measurement;
        $this->regarding_targets = $regarding_targets;
        $this->method = $method;
    }

    function belongsToMany()
    {
        $modelObj = new ($this->measurement)();
        $model_singular = str_singular($modelObj->getTable());
        $property_name = "{$this->relation_name}.{$model_singular}_id";
        return
            $modelObj[$this->relation_name]()
                ->selectRaw(
                    "{$this->method}({$this->relation_name}.id)  as aggregate ,$property_name")
                ->groupBy([$property_name])
                ->orderBy($property_name);
    }

    function hasMany()
    {
        $keys = [];
        $totals = [];
        $data = $model::with(['citizensCount' => function ($data) use (&$keys, &$totals) {
            $data->each(function ($v) use (&$keys, &$totals) {
                //    dump($v);
                $totals[$v->age_id] = ($v->aggregate);

            });
            return $data;
        }])->get();
        $keys = $data->mapWithKeys(function ($v) {
            return [$v->name];
        })->toArray();
    }
}