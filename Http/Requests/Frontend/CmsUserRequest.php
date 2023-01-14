<?php

namespace Modules\Cms\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class CmsUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $passwordRequired = true;
        if (!$this->request->get('password')) {
            $passwordRequired = false;
        }
        $rules = [
            'username' => 'required|unique:cms_users,username,' . $this->user()->id . '|min:2|max:255',
//            'email' => 'required|email|max:255|unique:cms_users,email',
        ];
        if ($passwordRequired) {
            $rules['password'] = 'required|confirmed|min:6';
        }
        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
