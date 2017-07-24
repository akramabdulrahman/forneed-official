<?php

namespace App\Repositories;

use App\Models\Chart;
use App\Models\Extra;
use App\Models\ExtraType;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ChartRepositoryRepository;
use App\Validators\ChartRepositoryValidator;

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

    public function render(Request $request, $model)
    {

        if ($request->has('multi')) {
            return $this->multiRender($request,$model);
        }
        $model = str_plural(snake_case(class_basename($model)));
        $theme = explode('_', $request->input('theme'));
        $target = $request->input('attr_list');
        $COUNT_FUNC = $model . '_count';
        $data = Extra::whereIn('name', [$target])->get()->groupBy('name')
            ->map(function ($cat) use ($COUNT_FUNC) {
                return $cat->mapWithKeys(function ($row) use ($COUNT_FUNC) {
                    return [$row->extra => $row->$COUNT_FUNC];
                });
            })->toArray();

        return Charts::create($theme[1], $theme[0])
            ->title(ucfirst($model) . ' according to ' . $target)
            ->elementLabel(ucfirst($model) . " Count")->labels(array_keys($data[$target]))
            ->values(array_values($data[$target]))->dimensions(1000, 500)
            ->responsive(false)->width(0)->height(300);

    }

    public function multiRender(Request $request, $model)
    {
        $theme = explode('_', $request->input('theme'));
        $target = $request->input('attr_list');
        $x = explode(':', $target['x']);
        $labels = Extra::where('name', '=', $x[2])->pluck('id', 'extra')->keys();

        $typesMap = ExtraType::getExtraTypes(config('extra_types.' . snake_case(str_singular(class_basename($model)))));
        $xs = Extra::where('name', '=', $x[2])->get();
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
            if (!$records->isEmpty())
                $data->push($records);
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


        $elemnt_label = $x[1];
        $chart->title('Beneficiaries according to ' . $x[2]);
        $chart->elementLabel("Count({$elemnt_label})");

        return $chart;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
