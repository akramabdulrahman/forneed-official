<?php

namespace App\Http\Requests;

use App\Models\Users\Citizen;
use Illuminate\Foundation\Http\FormRequest;

class BenRequest extends FormRequest
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
            $citizen = Citizen::find($this->route('id'));
            $user = $citizen->user->id;

        }
        if (!$this->input('contactable')) {

            $input = (object)$this->all();
            $input->contactable = false;
            $this->replace((array)$input);

        }
        $formRules = collect([
            'user.name' => 'required|max:255',
            'user.email' => 'required|email|unique:users,email',
            'user.password' => 'required|confirmed',
        ])->merge(collect(config('extra_types.citizen'))->mapWithKeys(function ($item) {
            return ["extra.$item" => 'required'];
        }));
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return
                    $formRules->toArray();
            }
            case 'PUT':
            case 'PATCH': {
                return $formRules->forget(['user.password','user.email','user.name'])
                    ->merge(['email' => 'required|email|unique:users,email,' . $user,
                            'name' => 'required|max:255',
                        ]
                    )->toArray();
            }
            default:
                break;
        }
    }
}
