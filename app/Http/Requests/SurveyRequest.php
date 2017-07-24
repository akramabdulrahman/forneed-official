<?php

namespace App\Http\Requests;

use App\Models\Surveys\Survey;
use Illuminate\Foundation\Http\FormRequest;

class SurveyRequest extends FormRequest
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
            $survey = Survey::find($this->route('id'));
        }
        if (!$this->input('is_accepted')) {

            $input = (object)$this->all();
            $input->is_accepted = false;
            $this->replace((array)$input);
        }

        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'subject' => 'required|max:255',
                    'project_id' => 'required',
                    'description' => 'required|max:255',
                    'starts_at' => 'required|max:255',
                    'expires_at' => 'required|max:255',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'subject' => 'required|max:255',
                    'project_id' => 'required',
                    'description' => 'required|max:255',
                    'starts_at' => 'required|max:255',
                    'expires_at' => 'required|max:255',
                ];
            }
            default:
                break;
        }
    }
}
