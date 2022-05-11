<?php

namespace Modules\Cms\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CmsLanguageRequest extends FormRequest
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
            'name' => "required|unique:cms_languages,name,$this->modelId|string|max:255",
            'locale' => "required",
            'date_format' => "required",
            'is_rtl' => "required",
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
