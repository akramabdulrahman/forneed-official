<?php

namespace App\Http\Controllers\EndUsers\SocialWorkers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Location\Area;
use App\Models\Extra;
use DB;
use App\User;
use Laracasts\Flash\Flash;
use App\Http\Requests\WorkRequest;
use App\Models\Users\SocialWorker;
use Auth;
class RegistrationController extends Controller
{
    public function index()
    {
        return view('social_workers.register', [ 
            'areas' => Area::pluck('name', 'id'),
            'extras' => Extra::whereIn('name', config('extra_types.social_worker'))->get()->groupBy('name'),
        ]);
    }
    public function store(WorkRequest $request)
    {

        $user=null;
        DB::transaction(function () use ($request,&$user) {
            $user = User::create($request->only('user')['user']);
            $sw = new  SocialWorker ($request->except('user'));
            $sw->cv = ($request->cv->store('public/cvs'));
            $sw->user()->associate($user);
            $sw->save();
            $sw->extras()->attach(array_values($request->get('extra')));

        }, 5);
        Auth::loginUsingId($user->id);
        Flash::success('Your Application Completed Successfully !');
                return redirect()->route('endusers.worker.index');

    }
}
