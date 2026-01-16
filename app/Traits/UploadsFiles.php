<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadsFiles
{
    public function handleFileOrUrl($request, $field, $folder = 'cms')
    {
        // If file uploaded
        if ($request->hasFile($field)) {
            $path = $request->file($field)->store($folder, 'public');
            return asset('storage/' . $path);
        }

        // If normal URL sent
        if ($request->filled($field)) {
            return $request->input($field);
        }

        return null;
    }
}
