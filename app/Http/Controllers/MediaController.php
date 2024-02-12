<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends BaseController
{
    public function uploadMedia(Request $request)
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');

            $filePath = 'store/'.time().'_'.$image->getClientOriginalName();

            // Upload the image to S3
            Storage::disk('s3')->put($filePath, file_get_contents($image), 'public-read');

            $fileUrl = Storage::disk('s3')->url($filePath);

            // Get relevant information about the file
            $fileName = $image->getClientOriginalName();
            $fileSize = $image->getSize();
            $originalFileName = $image->getClientOriginalName();
            $mimeType = $image->getClientMimeType();

            // Save the image information to your database
            $media = Media::create([
                'file_name' => $fileName,
                'file_path' => $fileUrl,
                'file_size' => $fileSize,
                'original_file_name' => $originalFileName,
                'mime_type' => $mimeType,
                'status' => 1,
            ]);

            return response()->json(['success' => true, 'file' => $media->id], 200);
        }

        return response()->json(['success' => false, 'message' => 'Invalid image file'], 400);
    }
}
