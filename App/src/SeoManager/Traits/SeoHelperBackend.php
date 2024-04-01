<?php

namespace Modules\Cms\App\src\SeoManager\Traits;

trait SeoHelperBackend
{
    /**
     * Hook into the Eloquent model events to create or
     * update the slug as required.
     */
    public static function bootSeoHelperBackend(): void
    {
        $request = request();
        if ($request->has('seo')) {
            static::saving(function ($model) use ($request) {
                $seoModel = $model->getSeo();
                if ($seoModel) {
                    $seoModel->update(['params' => $request->get('seo')]);
                }
            });
            static::deleted(function ($model) {
                $seoModel = $model->getSeo();
                if ($seoModel) {
                    $seoModel->delete();
                }
            });
        }
    }

    /**
     * @return void
     */
    public function renderSeoInputs()
    {
        $inputs = $this->getSeoInputs();
        foreach ($inputs as $inputName => $inputData) {
            $inputType = $inputData['type'] ?? 'text';
            $params = $inputData['params'] ?? [];
            $this->add('seo[' . $inputName . ']', $inputType, $params);
        }
    }

    /**
     * @return array
     */
    public function getSeoInputs()
    {
        return [
            'title' => [
                'params' => [
                    'label' => trans('cms::form.seo.title'),
                    'value' => 'title'
                ]
            ],
            'description' => [
                'type' => 'textarea',
                'params' => [
                    'label' => trans('cms::form.seo.description'),
                    'value' => 'description'
                ]
            ],
            'keywords' => [
                'params' => [
                    'label' => trans('cms::form.seo.keywords'),
                    'value' => 'keywords'
                ]
            ],
            'robots' => [
                'type' => 'select',
                'params' => [
                    'label' => trans('cms::form.seo.robots'),
                    'choices' => [
                        'index,follow' => 'index,follow',
                        'index,nofollow' => 'index,nofollow',
                        'noindex,follow' => 'noindex,follow',
                        'noindex,nofollow' => 'noindex,nofollow',
                    ],
                    'selected' => 2
                ]
            ],
        ];
    }
}
