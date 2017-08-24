<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Extra;
use App\Models\Surveys\Answer;
use App\Models\Surveys\Survey;
use App\User;
use App\Models\Users\Citizen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use Excel;

class ImportExportController extends Controller
{
    public function importExport($survey_id)
    {
        return view('endusers.organizations.importExport', ['survey' => Survey::find($survey_id)]);
    }

    public function downloadExcel($survey_id, $type)
    {
        $export_scheme_row_answers = collect([]);
        $user = new \App\User();
        $survey = Survey::find($survey_id);

        $export_scheme_row_answers->push($user->getFillable());
        $citizen = new Citizen();
        $export_scheme_row_answers->push($citizen->getFillable());
        $export_scheme_row_answers->push(['area_id', 'sector_id']);
        $criteria = $survey->extras()->pluck('extra', 'name');
        $export_scheme_row_answers->push(
            collect(config('extra_types.citizen'))
                ->map(function ($row) use ($criteria) {
                    return $row . (isset($criteria[$row]) ? ':' . $criteria[$row] : '');
                }));
        $export_scheme_row_answers = $export_scheme_row_answers->flatten()->flip()->forget('user_id')->flip();
        $data = $survey->questions;

        $data->each(function ($question) use (&$export_scheme_row_answers) {
            $question->answers->each(function ($answer, $key) use (&$export_scheme_row, &$export_scheme_row_answers, $question) {
                $export_scheme_row_answers->push($question->body . ":" . $answer->answer);
            });
        });

        $export_scheme_row_answers = array_values($export_scheme_row_answers->toArray());

        return Excel::create('survey_template', function ($excel) use ($export_scheme_row_answers, $survey) {
            $excel->sheet('mySheet', function ($sheet) use ($export_scheme_row_answers, $survey) {
                $sheet->loadView('excel.table-template', ['answers' => $export_scheme_row_answers]);
                //$last_index = range('a', 'z')[count($export_scheme_row_answers)];
            });
        })->download($type);
    }

    public function importExcel($survey_id, Request $request)
    {
        if ($request->hasFile('import_file')) {
            $path = $request->file('import_file')->getRealPath();
            $data = collect(Excel::load($path, function ($reader) {
            })->get())->filter(function ($row) {
                return ($row->filter()->count() > ($row->count() / 2));
            });
            $corrupted = [];
            if (!empty($data) && $data->count()) {
                DB::transaction(function () use ($data, $survey_id, $corrupted) {

                    $data->each(function ($row) use ($survey_id, &$corrupted) {
                        dump($row);
                        $fillable = $row;
                        $usr = new User();
                        try {

                            $user = User::where($row->only($usr->getFillable())->forget('password')->toArray())->first();
                            if (!$user) {
                                $user = User::create($row->only($usr->getFillable())->toArray());
                            }
                            $citizen = null;
                            if (!$user->isCitizen()) {
                                $citizen = new Citizen($row->only((new Citizen())->getFillable())->toArray());
                                $citizen->user()->associate($user);
                                $citizen->save();
                                $citizen->sectors()->attach((($row->get('sector_id'))));
                                $citizen->extras()->attach(Extra::whereIn('extra', $row->map(function ($extra, $key) {
                                    $cat = explode(':', $key);
                                    return ($extra && collect(config('extra_types.citizen'))->flip()->has($cat[0])) ? $cat[1] : null;
                                })->filter()->values())->pluck('id'));
                                $citizen->areas()->attach((($row->get('area_id'))));
                            } else {
                                $citizen = $user->citizen()->first();
                            }
                            if ((Survey::find($survey_id)->getTargetCriteria()->intersect($citizen->extras()->pluck('id'))->count() > 0)
                                && $citizen->surveys()->where('survey_id', '=', $survey_id)->count() == 0) {

                                $citizen->surveys()->attach($survey_id, array(
                                    'step' => 1,
                                    'is_final_step' => true
                                ));

                                $citizen->answers()->attach(Answer::whereIn('answer',
                                    $fillable->forget($usr->getFillable())
                                        ->forget($citizen->getFillable())
                                        ->forget(['area_id', 'sector_id'])->map(function ($val, $key) {
                                            $ans = explode(':', $key);
                                            return (isset($ans[1]) && $val) ? $ans[1] : null;
                                        })->filter()->values())->pluck('id'));
                            }
                        } catch (\Exception $e) {
                            $corrupted[] = $row;
                        }


                    });
                }, 5);

            }
        }
        return back();
    }


    public function downloadExtrasExcel($type)
    {
        $data =
            Extra::select(['id', 'name', 'extra'])->get();
        return Excel::create('survey_template', function ($excel) use ($data) {
            $excel->sheet('mySheet', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
}
