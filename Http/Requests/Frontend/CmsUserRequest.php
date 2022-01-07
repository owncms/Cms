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
        return [
            'username' => 'required|unique:cms_users,username|min:2|max:255',
            'email' => 'required|email|max:255|unique:cms_users,email',
            'password' => 'required|confirmed|min:6',
        ];
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
