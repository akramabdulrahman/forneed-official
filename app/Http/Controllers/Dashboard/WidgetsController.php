<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Chart;
use App\Models\Surveys\Survey;
use App\Models\Users\Citizen;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class WidgetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function storeVisualRelation(Request $request)
    {
        $theme = explode('_', $request->input('theme'));
        $model = $request->input('model');

        Chart::updateOrCreate([
            'user_id' => Auth::user()->id,
            'multi' => 3,
            'theme_lib' => $theme[0],
            'theme_chart' => $theme[1],
            'model' => Citizen::class,
            'attr_list' => json_encode([
                'first_ans' => $request->input('first_ans'),
                'second_ans' => $request->input('second_ans')]),
            'chartable_id' => $request->input('survey_id'),
            'chartable_type' => Survey::class
        ])->exists() ? ['state' => true] : ['state' => false];;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeChart(Request $request)
    {
        $theme = explode('_', $request->input('theme'));
        $model = $request->input('model');
        return Chart::updateOrCreate([
            'user_id' => Auth::user()->id,
            'multi' => $request->has('multi'),
            'theme_lib' => $theme[0],
            'theme_chart' => $theme[1],
            'model' => $model,
            'attr_list' => json_encode($request->input('attr_list')),
            'chartable_id' => Auth::user()->id,
            'chartable_type' => User::class
        ])->exists() ? ['state' => true] : ['state' => false];

    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
