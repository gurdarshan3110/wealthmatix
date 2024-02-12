<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class BaseController extends Controller
{
    public function __construct()
    {
    }

    public function uploadFile($filemeta, $file, $upload = false, $multiple = false)
    {
        $return = [];
        Storage::disk('s3')->put($filemeta['filepath'], file_get_contents($file), 'public');
        $return['filepath'] = Storage::disk('s3')->url($filemeta['filepath']);
        if ($upload) {
            $return['filepath'] = Storage::disk('s3')->url($filemeta['filepath']);
            $return['filesize'] = $filemeta['filesize'];
            $return['filename'] = $filemeta['filename'];
            $return['filetype'] = $filemeta['filetype'];
            $return['description'] = $filemeta['description'];
            $return['user_id'] = $filemeta['user_id'];
            $return['file_key'] = $filemeta['file_key'];
        }

        return $return;
    }
}
