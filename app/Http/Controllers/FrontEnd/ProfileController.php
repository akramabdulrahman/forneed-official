<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\AcademicLevel;
use App\Models\Disability;
use App\Models\Location\Area;
use App\Models\MarginalizedSituation;
use App\Models\MaritalStatus;
use App\Models\Project;
use App\Models\RefugeeState;
use App\Models\Sector;
use App\Models\Target;
use App\Models\Users\Company;
use App\Models\Users\ServiceProvider;
use App\Models\Users\ServiceProviderType;
use App\Models\WorkingState;
use App\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Session;
use App\Models\Age;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['checkUserType:serviceProvider,citizen,worker'])->only('index', 'settings', 'surveys');
        $this->middleware('checkUserType:serviceProvider')->only('dashboard');
        $this->middleware('checkUserType:citizen')->only('serviceRequests');
        $this->middleware('checkUserType:admin')->only('serviceRequests');
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            return $this->admin();
        } else if ($user->isServiceProvider()) {
            return redirect()->route('endusers.org.index');
        } else if ($user->isCitizen()) {
            return redirect()->route('endusers.ben.index');
        }else if ($user->isWorker()) {
            return redirect()->route('endusers.worker.index');
        }
    }

    public function admin()
    {
        return redirect()->route('Dashboard.landing');
    }

    private function serviceProviderProfile()
    {
        $user = Auth::user();
        $targets = collect(Target::$types);;
        $sp = $user->serviceProvider()->first();
        return view('profiles.sp.index1', [
            "user" => $user,
            "sp" => $sp,
            'surveys' => $sp->surveys()->get(),
            'projects' => $sp->projects()->pluck('name', 'id'),
            'sectors' => $sp->sectors()->pluck('name', 'id'),
            'companies' => Company::pluck('name', 'id'),
            'areas' => $sp->areas()->pluck('name', 'id'),
            'target_types' => array_flip($targets->map(function ($key, $val) {
                return str_replace('\\', '-', $key);
            })->toArray())
        ]);
    }

    private function citizenProfile()
    {
        $user = Auth::user();
        $sRequests = $user->citizen->servicesRequests;
        return view('profiles.citizen.index', [
            "user" => $user,
            "sRequests" => $sRequests,
            'areas' => Area::all(),
            'sectors' => Sector::all()->pluck('name', 'id')->toarray(),
            'sectors' => Sector::all()->pluck('name', 'id')->toarray(),
            'surveys' => $user->citizen->applicable_surveys()->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function dashboard()
    {
        return 'Dashboard';
    }

    public function serviceRequests()
    {
        return 'service requests';
    }

    public function settings()
    {
        $user = Auth::user();
        if ($user->isServiceProvider()) {
            return $this->serviceProviderSettings();
        } else if ($user->isCitizen()) {
            return $this->citizenSettings($user);
        }
    }

    public function surveys()
    {
        $user = Auth::user();
        if ($user->isServiceProvider()) {
            return $this->serviceProviderSurveys();
        } else if ($user->isCitizen()) {
            return $this->citizenSurveys();
        }
    }

    private function serviceProviderSettings()
    {
        $user = Auth::user();
        return view('profiles.sp.settings1', [
            "user" => $user->with('ServiceProvider')->first(),
            "sp" => $user->serviceProvider()->first(),
            'sectors' => Sector::pluck('name', 'id'),
            'companies' => Company::pluck('name', 'id'),
            'areas' => Area::pluck('name', 'id')
        ]);

    }

    private function citizenSettings(User $user)
    {
        $sRequests = $user->citizen->servicesRequests;
//            dd($sRequests);

        return view('profiles.citizen.settings1', [
            "user" => $user->with('citizen')->first(),
            'citizen' => $user->citizen()->first(),
            'sectors' => Sector::pluck('name', 'id'),
            'maritals' => MaritalStatus::pluck('name', 'id'),
            'ages' => Age::pluck('name', 'id'),
            'areas' => Area::pluck('name', 'id'),
            'workingstates' => WorkingState::pluck('name', 'id'),
            'refugee' => RefugeeState::pluck('name', 'id'),
            'disabilities' => Disability::pluck('name', 'id'),
            'academic' => AcademicLevel::pluck('name', 'id'),

        ]);
    }

    private function serviceProviderSurveys()
    {
        return 'service provider Surveys';
    }

    private function citizenSurveys()
    {
        return 'citizen Surveys';
    }

    public function postImage(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'file' => 'image',
        ];

        $this->validate($request, $rules);

//        return Response::json(array('success' => true), 200);

        //   dd(array_add($request->all(), 'user_id', $user->id));

//        $serviceProvider->save();

        if ($request->hasFile('file')) {
            if ($request->file('file')->isValid()) {
                $destinationPath = storage_path('assets\images\users\\');
                $fileName = str_random(20) . '.' . $request->file('file')->getClientOriginalExtension();
                $request->file('file')->move($destinationPath, $fileName); // uploading file to given path
                $user->avatar = $fileName;
                $user->save();
            }
        }

        Session::flash('flash_message', 'Profile updated successfully');

        return ['flash_message' => 'Profile updated successfully'];

//        return Image::make(storage_path('assets\images\\' . $user->avatar));
    }

    public function getImage()
    {
        $user = Auth::user();
        if ($user->avatar != null) {
            $img = Image::make(storage_path('assets\images\users\\' . $user->avatar))->resize(150, 150);
        } else
            $img = Image::make("http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image")->resize(150, 150);


        return $img->response('jpg');
//        return Image::make(storage_path('assets\images\\' . $user->avatar));
    }

    private function postSPUpdate(Request $request, User $user)
    {
        $sv = $user->serviceProvider;
        $sv->update($request->input('serviceProvider'));
        $sv->save();
        $user->update($request->all());
        $user->save();
    }

    private function postCitizenUpdate(Request $request, User $user)
    {


        $citizen = $user->citizen;
        $citizen->update($request->input('citizen'));
        $citizen->save();
        $user->update($request->all());
        $user->save();

        return true;
    }

    public function postUpdate(Request $request)
    {
        $user = Auth::user();
        $success = false;
        if ($user->isServiceProvider()) {
            $success = $this->postSPUpdate($request, $user);
        } else if ($user->isCitizen()) {
            $success = $this->postCitizenUpdate($request, $user);
        }

        if ($success) {
            Session::flash('flash_message', 'Profile updated successfully');

            return ['flash_message' => 'Profile updated successfully'];
        } else {
            Session::flash('flash_message', 'Profile updated error');

            return ['flash_message' => 'Profile updated error'];
        }

    }

}
