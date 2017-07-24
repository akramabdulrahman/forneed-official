<?php

namespace App\Http\Controllers\EndUsers\Citizens\ServiceRequests;

use App\Models\Location\Area;
use App\Models\Location\District;
use App\Models\ServiceRequest;
use Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Input;
use Validator;
class ServiceRequestsController extends Controller
{

    private function multiple_upload($fileInput, $citizenId)
    {
        // getting all of the post data
        $files = $fileInput;
        // Making counting of uploaded images
        $file_count = count($files);
        $file_names = [];
        // start count how many uploaded
        $uploadcount = 0;
        foreach ($files as $file) {
            $rules = array('file' => 'image');
            $validator = Validator::make(array('file' => $file), $rules);
            if ($validator->passes()) {
                $destinationPath = 'uploads/service_requests';
                $filename = uniqid($citizenId . '_',true).'.'.$file->getClientOriginalExtension();
                $file_names[] = $filename;
                $upload_success = $file->move($destinationPath, $filename);
                $uploadcount++;
            }
        }
        if ($uploadcount == $file_count) {
            return $file_names;
        }
        return [];
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['citizen_id'] = Auth::user()->citizen()->first()->id;
        if ($imgs = Input::file('images')) {
            $files = $this->multiple_upload($imgs, $input['citizen_id']);
            $input['images'] = ($files);
        }
        $serviceRequest=new ServiceRequest();
        $serviceRequest = ServiceRequest::firstOrCreate((array_intersect_key($input,array_flip($serviceRequest->getFillable()))));
        Flash::success('ServiceRequests saved successfully.');
        return redirect()->back();
    }
}

