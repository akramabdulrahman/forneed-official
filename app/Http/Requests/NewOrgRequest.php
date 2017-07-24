<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewOrgRequest extends FormRequest
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
        return collect([
            'sector_id' => 'required',
            'area_id' => 'required',
            'mission_statement' => 'required|max:500',
            'phone_number' => 'required_without_all:mobile_number|max:255',
            'mobile_number' => 'required_without_all:phone_number|max:255',
            'fax' => 'max:255',
            'website' => 'max:255',
            'contact_person' => 'required|max:255',
            'contact_person_title' => 'required|max:255',])
            ->merge(collect(config('extra_types.service_provider'))->mapWithKeys(function ($item) {
                return ["extra.$item" => 'required'];
            }))->toArray();
    }
}
