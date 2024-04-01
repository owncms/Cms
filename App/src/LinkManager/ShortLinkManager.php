<?php

namespace Modules\Cms\App\src\LinkManager;

use Illuminate\Support\Str;
use Modules\Cms\App\Models\CmsLink;

class ShortLinkManager
{
    private $url = '';
    private $data = [];

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * @return $this
     */
    public function encode()
    {
        $data = $this->data;
        $string = '';
        if (isset($data['item'])) {
            $string .= get_class($data['item']) . '::' . $data['item']->id;
        } else {
            if (!isset($data['url'])) {
                $url = request()->path();
            } else {
                $url = $data['url'];
            }
            $string .= $url;
        }
        if (isset($data['to'])) {
            $string .= '__' . $data['to'];
        }
        $hash = base64_encode($string);
        $this->data['encoded'] = $hash;

        return $this;
    }

    /**
     * Get route with hash
     * @return string
     */
    public function getEncodedUrl()
    {
        return route('Front::cms.short_link.redirect', ['hash' => $this->data['encoded']]);
    }

    /** Decode the current hash
     * @return $this|string
     */
    public function decode()
    {
        if (!isset($this->data['hash'])) {
            return '';
        }
        $decoded = base64_decode($this->data['hash'], true);
        $data = explode('__', $decoded);
        $data = array_values(array_filter($data));
        if (!count($data)) {
            return $this;
        }
        if (Str::contains($data[0], '::')) {
            list($modelClass, $modelId) = explode('::', $data[0]);
            $cmsLink = CmsLink::where('class_type', $modelClass)->where('model_id', $modelId)->first();
            if (!$cmsLink) {
                return $this;
            }
            $finalPath = $cmsLink->final_path;
            $locale = app()->getLocale();
            $url = '';
            if (is_array($finalPath)) {
                if (isset($finalPath[$locale])) {
                    $url = $finalPath[$locale];
                }
            }
        } else {
            $url = $data[0];
        }

        if (isset($data[1])) {
            $url .= $data[1];
        }
        $this->data['decoded'] = $url;
        return $this;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getDecodedUrl()
    {
        return url($this->data['decoded'] ?? '');
    }
}
