<?php

namespace Modules\Cms\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DomainRequest extends FormRequest
{
    protected $modelId = null;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => "required|unique:domains,name,$this->modelId|string|max:255",
            'url' => "required|unique:domains,url,$this->modelId|string|max:255",
            'selected_languages' => 'required',
            'default_language' => 'required',
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

    public function setModelId($id)
    {
        $this->modelId = $id;
    }
}
