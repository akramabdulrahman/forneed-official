<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class UserRequest extends FormRequest
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
            $user = User::find($this->route('id'));
        }

        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|min:6|confirmed',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => 'required|max:255',
                    'email' => 'required|email||max:255|unique:users,email,' . $user->id,
                ];
            }
            default:
                break;
        }
    }
}
