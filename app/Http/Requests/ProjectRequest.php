<?php

namespace App\Http\Requests;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
        //dd($this->all());
        if ($this->route('id')) {
            $project = Project::find($this->route('id'));
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
                    'name' => 'required|max:255',
                    'extras.Sector' => 'required',
                    'extras.Area' => 'required',
                    'sponsor' => 'required|max:255',
                    'starts_at' => 'required|max:255',
                    'expires_at' => 'required|max:255',
                    'targets'=>'required'
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => 'required|max:255',
                    'extras.Sector' => 'required',
                    'extras.Area' => 'required',
                    'sponsor' => 'required|max:255',
                    'starts_at' => 'required',
                    'expires_at' => 'required',
                    'targets'=>'required'

                ];
            }
            default:
                break;
        }
    }

}
