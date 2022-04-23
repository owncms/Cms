<?php

if (!function_exists('get_short_link')) {
    function get_short_link($data = [])
    {
        return (new \Modules\Cms\src\LinkManager\ShortLinkManager($data))->encode()->getEncodedUrl();
    }
}
