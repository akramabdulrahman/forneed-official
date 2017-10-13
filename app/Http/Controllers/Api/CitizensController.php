<?php

namespace App\Http\Controllers\Api;

use App\Models\Extra;
use App\Models\Surveys\Survey;
use App\Models\Users\Citizen;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\DB;

class CitizensController extends Controller
{
    public function index(Request $request, Survey $survey)
    {
        $user = Auth::user();
        if ($user->isWorker()) {
            return response()->json($survey->beneficiaries()->get());
        }
        return response()->json(['error' => 'Unauthorized User Type']);
    }

    public function extras()
    {
        return response()->json(Extra::whereIn('name', config('extra_types.citizen'))->get()->groupBy('name'));
    }

    public function store(Request $request)
    {
        $response = array();
        try {
            DB::transaction(function () use ($request) {
                $user = User::create($request->only('user')['user']);
                $citizen = new Citizen($request->only('contactable'));
                $citizen->user()->associate($user);
                $citizen->save();
                $citizen->extras()->attach(array_flatten(array_values($request->get('extra'))));
            }, 5);
            $response['success'] = true;

        } catch (Exception $e) {
            $response['error'] = $e;
        }
        return response()->json($response);
    }
}
