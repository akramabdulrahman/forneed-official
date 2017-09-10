<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewCitizenRequest extends FormRequest
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
        if (!$this->input('contactable')) {

            $input = (object)$this->all();
            $input->contactable = false;
            $this->replace((array)$input);
        }

        return collect([])
            ->merge(collect(config('extra_types.citizen'))->mapWithKeys(function ($item) {
                return ["extra.$item" => 'required'];
            }))->toArray();
    }
}
