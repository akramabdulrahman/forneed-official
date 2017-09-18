<?php

namespace App\Http\Requests;

use App\Models\Users\ServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class OrgRequest extends FormRequest
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
            $sp = ServiceProvider::find($this->route('id'));
            $user = $sp->user->id;

        }
        if (!$this->input('sp.is_accepted')) {

            $input = (object)$this->all();
            $input->sp['is_accepted'] = false;
            $this->replace((array)$input);
        }

        $formRules = collect([
            'user.name' => 'required|max:255',

            'user.email' => 'required|email|unique:users,email',
            'user.password' => 'required|confirmed',
            'organization_name' => 'required|max:255|unique:service_providers,organization_name',
            'mission_statement' => 'required|max:500',
            'phone_number' => 'required_without_all:mobile_number|max:255',
            'mobile_number' => 'required_without_all:phone_number|max:255',
            'fax' => 'max:255',
            'website' => 'max:255',
            'contact_person' => 'required|max:255',
            'contact_person_title' => 'required|max:255',
        ])->merge(collect(config('extra_types.service_provider'))->mapWithKeys(function ($item) {
            return ["extra.$item" => 'required'];
        }));

        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return $formRules->toArray();
            }
            case 'PUT':
            case 'PATCH': {
                return collect([
                    'name' => 'required|max:255',
                    'sp.mission_statement' => 'required|max:500',
                    'sp.phone_number' => 'required_without_all:mobile_number|max:255',
                    'sp.organization_name' => 'required|max:255|unique:service_providers,organization_name,'.$sp->id,
                    'sp.mobile_number' => 'required_without_all:phone_number|max:255',
                    'sp.fax' => 'max:255',
                    'sp.website' => 'max:255',
                    'sp.contact_person' => 'required|max:255',
                    'sp.contact_person_title' => 'required|max:255',
                    'email' => 'required|email|unique:users,email,' . $user,
                ])->merge(collect(config('extra_types.service_provider'))->mapWithKeys(function ($item) {
                    return ["extra.$item" => 'required'];
                }))->toArray();
            }
            default:
                break;
        }
    }
}
