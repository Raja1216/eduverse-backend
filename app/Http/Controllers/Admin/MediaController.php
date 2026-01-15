<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240|mimes:jpg,jpeg,png,webp,pdf'
        ]);

        $file = $request->file('file');

        $path = $file->store('uploads', 'public');

        $media = Media::create([
            'file_name' => $file->getClientOriginalName(),
            'file_path' => '/storage/' . $path,
            'mime_type' => $file->getMimeType(),
            'type' => str_contains($file->getMimeType(), 'image') ? 'image' : 'file'
        ]);

        return response()->json($media, 201);
    }
}
