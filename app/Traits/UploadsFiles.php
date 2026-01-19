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

    public function handleImage($image, $folder)
    {
        // If empty, do nothing
        if (empty($image)) {
            return null;
        }

        // If already a URL, return as-is
        if (filter_var($image, FILTER_VALIDATE_URL)) {
            return $image;
        }

        // If base64 image
        if (str_starts_with($image, 'data:image')) {

            // Extract mime type and data
            preg_match('/^data:image\/(\w+);base64,/', $image, $matches);

            $extension = $matches[1] ?? 'png';

            $base64Data = substr($image, strpos($image, ',') + 1);
            $imageData = base64_decode($base64Data);

            // Safety check
            if ($imageData === false) {
                throw new \Exception("Invalid base64 image data");
            }

            // Generate filename
            $fileName = $folder . '/' . uniqid() . '_' . time() . '.' . $extension;

            // Save to storage
            Storage::disk('public')->put($fileName, $imageData);

            // Return public URL
            return asset('storage/' . $fileName);
        }

        // Fallback: return as-is (maybe frontend sent plain path)
        return $image;
    }

}
