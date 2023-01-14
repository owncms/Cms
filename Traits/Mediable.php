<?php

namespace Modules\Cms\Traits;

use Illuminate\Http\Request;
use Plank\Mediable\Mediable as BaseMediable;
use MediaUploader;

trait Mediable
{
    use BaseMediable;

    public function syncFiles($currFiles = [], $tag = 'image')
    {
        $files = $this->getMedia($tag);
    }

    /**
     * @param $files
     * @return void
     */
    public function uploadWithAttachFiles($files)
    {
        foreach ($files as $tag => $file) {
            $media = MediaUploader::fromSource($file)
                ->toDestination('files', $tag)
                ->upload();
            $this->attachMedia($media, [$tag]);
        }
    }

    public function syncFormMedia(Request $request)
    {
        if ($currFiles = $request->get('curr_files')) {
//            $this->syncFiles($currFiles);
        }
        if ($request->hasFile('files')) {
            $this->uploadWithAttachFiles($request->file('files'));
        }
    }
}
