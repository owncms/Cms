<?php

namespace Modules\Cms\App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'max:255',
            'email' => 'required|unique:cms_users,email',
            'username' => 'required|min:2|max:255|unique:cms_users,username',
            'password' => 'required|confirmed|max:255'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
