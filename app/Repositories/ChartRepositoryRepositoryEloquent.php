<?php

namespace App\Repositories;

use App\Models\Chart;
use App\Models\Extra;
use App\Models\ExtraType;
use App\Models\Surveys\Answer;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ChartRepositoryRepository;
use App\Validators\ChartRepositoryValidator;
use App\Models\Users\SocialWorker;
use App\Models\Project;
use App\Models\Surveys\Survey;
use Auth;
use DB;

/**
 * Class ChartRepositoryRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ChartRepositoryRepositoryEloquent extends BaseRepository implements ChartRepositoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Chart::class;
    }

    public function render($chart, $model, $target_model = Extra::class, $target_attr = 'name')
    {
        if (isset($chart['multi']) && $chart['multi']) {
            return $this->multiRender($chart, $model);
        }

        $model = str_plural(snake_case(class_basename($model)));

        $theme = explode('_', $chart['theme']);

        $target = $chart['attr_list'];

        $COUNT_FUNC = $model . '_count';

        $data = $target_model::whereIn($target_attr, [$target])->get()->groupBy($target_attr)
            ->map(function ($cat) use ($COUNT_FUNC) {
                return $cat->mapWithKeys(function ($row) use ($COUNT_FUNC) {
                    return [$row->extra => $row->$COUNT_FUNC];
                });
            })->toArray();

        $models = str_plural(trans('user.type_' . snake_case((str_singular($model)))));
        return Charts::create($theme[1], $theme[0])
            ->title($models . ' according to ' . $target)
            ->elementLabel($models . " Count")->labels(array_keys($data[$target]))
            ->values(array_values($data[$target]))->dimensions(1000, 500)
            ->responsive(false)->width(0)->height(300);
    }

    public function multiRender($chart, $model)
    {
        $theme = explode('_', $chart['theme']);

        $target = $chart['attr_list'];

        $x = $target['x'];

        $labels = Extra::where('name', '=', $x)->pluck('id', 'extra')->keys();
        $typesMap = ExtraType::getExtraTypes(config('extra_types.' . snake_case(str_singular(class_basename($model)))));

        $xs = Extra::where('name', '=', $x)->get();

        $data = collect([]);
        $xs->each(function ($x) use (&$data, $target, $typesMap, $model) {
            $records = ($x->attrs_populated($target['y'], $model)->map(function ($cat, $key) use ($typesMap) {
                $map = collect(array_flip($typesMap[$key]));
                return $map->map(function ($row, $mapKey) use ($cat) {
                    return isset($cat[$mapKey]) ? $cat[$mapKey] : 0;
                });
            }))->mapWithKeys(function ($cat, $key) {
                return $cat->mapWithKeys(function ($row, $class) use ($key, $cat) {
                    $empty_cat = array_fill_keys(array_keys($cat->toArray()), 0);
                    if ($cat[$class]) {
                        $empty_cat[$class] = $cat[$class];
                    }
                    return [$class => $empty_cat];
                });
            })->filter(function ($row) {
                return collect($row)->sum() != 0;
            });
            if (!$records->isEmpty()) {
                $data->push($records);
            }
        });
        $chart = Charts::multi($theme[1], $theme[0])
            ->responsive(false)
            ->dimensions(0, 300)
            ->colors(['#ff0000', '#00ff00', '#0000ff', '#c62828', '#ad1457', '#6a1b9a', '#4527a0', '#283593'])
            ->labels($labels);

        $data->mapWithKeys(function ($row, $key) {
            return $row->mapWithKeys(function ($val, $key) {
                return [$key => $val];
            });
        })->each(function ($dataset, $key) use (&$chart) {
            $chart->dataset($key, $dataset);
        });

        $elemnt_label = $x;
        $chart->title(str_plural(trans('user.type_' . snake_case(class_basename($model)))) . ' according to ' . $x);
        $chart->elementLabel("Count({$elemnt_label})");


        return $chart;
    }


    public function visualize($chart)
    {
        $theme = explode('_', $chart['theme']);
        $aggregate = isset($chart['func']) ? $chart['func'] : null;
        $survey = null;
        $answers = $chart['first_ans'];
        $data = collect();
        $data->push(Answer::with('citizens')->whereIn('id', $answers)->get()->map(function ($v) {
            return count($v->citizens);
        }));


        $labels = array_values(Answer::with('question')->whereIn('id', $answers)
            ->get()->map(function ($v) use (&$survey) {
                $survey = $v->question->survey()->first()->id;
                return $v->question->body . ':' . $v->answer;
            })->toArray());

        if ($aggregate) {
            $aggregate_result = 0;
            switch ($aggregate) {
                case 'avg':
                    $aggregate_result = $data->first()->avg();
                    break;
                case 'max':
                    $aggregate_result = $data->first()->max();
                    break;
                case 'min':
                    $aggregate_result = $data->first()->min();
                    break;
                case 'mode':
                    $aggregate_result = $data->first()->mode();
                    break;
                case 'median':
                    $aggregate_result = $data->first()->median();
                    break;
                case 'sum':
                        $aggregate_result = $data->first()->sum();
                    break;
                default:
                    break;
            }

            $data->push($data->first()->map(function () use ($aggregate_result) {
                return $aggregate_result;
            })->flatten(1)->slice(0,$data->first()->count()));
        }

        $chart = Charts::multi($theme[1], $theme[0])
            ->title('Citizens that satisfy : ' . collect($labels)->map(function ($v) {
                    return "({$v})";
                })->implode(','))
            ->elementLabel("Citizens")
            ->responsive(false)
            ->dimensions(0, 300)
            ->labels($labels);
        $datasets_labels = ['count relation', $aggregate];
        $data->each(function ($val, $key) use ($chart, $datasets_labels) {
            $chart->dataset($datasets_labels[$key], $val);
        });


        $chart->responsive(false)->width(0)->height(300);

        return $chart;
    }

    public function RenderFromRelation($chart, $datasets, $preaggregated, $elementLabel = "Total", $responsive = false)
    {
        $theme = explode('_', $chart['theme']);
        $time_unit = 'groupBy' . $chart['time_unit'];
        $time_unit_count = $chart['time_unit_count'];
        $chart = Charts::multiDatabase($theme[1], $theme[0])
            ->elementLabel($elementLabel)
            ->responsive($responsive)->width(0)->height(300);
        foreach ($datasets as $key => $dataset) {
            $chart->dataset($key, $dataset);
        }
        $chart->preaggregated($preaggregated);
        return $chart->$time_unit($time_unit_count, true);
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
