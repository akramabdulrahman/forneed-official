<?php

namespace App\Http\Requests;

use App\Models\Users\SocialWorker;
use Illuminate\Foundation\Http\FormRequest;

class WorkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->route('id')) {
            $sp = SocialWorker::find($this->route('id'));
            $user = $sp->user->id;

        }
        if(!$this->input('is_accepted')){

            $input = (object) $this->all();
            $input->is_accepted = false;
            $this->replace((array) $input);
        }
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return collect([
                    'user.name' => 'required|max:255',
                    'area_id' => 'required',
                    'telephone' => 'required_without_all:mobile|max:255',
                    'mobile' => 'required_without_all:telephone|max:255',
                    'address' => 'required|max:255',
                    'cv' => 'required|mimes:pdf,doc,ppt,xls,docx,pptx,xlsx,rar,zip|max:2000',//required_if:update,false
                    'user.email' => 'required|email|unique:users,email',
                    'user.password' => 'required|confirmed',
                ])->merge(collect(config('extra_types.social_worker'))->mapWithKeys(function ($item) {
                    return ["extra.$item" => 'required'];
                }))->toArray();
            }
            case 'PUT':
            case 'PATCH': {
                return collect([
                    'user.name' => 'required|max:255',
                    'area_id' => 'required',
                    'telephone' => 'required_without_all:mobile|max:255',
                    'mobile' => 'required_without_all:telephone|max:255',
                    'address' => 'required|max:255',
                    'cv' => 'mimes:pdf,doc,ppt,xls,docx,pptx,xlsx,rar,zip|max:2000',//required_if:update,false
                    'user.email' => 'required|email|unique:users,email,' . $user,
                ])->merge(collect(config('extra_types.social_worker'))->mapWithKeys(function ($item) {
                    return ["extra.$item" => 'required'];
                }))->toArray();
            }
            default:
                break;
        }
    }
}
