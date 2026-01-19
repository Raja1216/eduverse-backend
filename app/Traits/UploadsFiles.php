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

    public function handleImage($image, $folder = 'programs')
    {
        if (empty($image)) return null;

        if (filter_var($image, FILTER_VALIDATE_URL)) {
            return $image;
        }

        if (str_starts_with($image, 'data:image')) {

            preg_match('/^data:image\/(\w+);base64,/', $image, $matches);
            $extension = $matches[1] ?? 'png';

            $base64Data = substr($image, strpos($image, ',') + 1);
            $imageData = base64_decode($base64Data);

            if ($imageData === false) {
                throw new \Exception("Invalid base64 image");
            }

            $fileName = $folder . '/' . uniqid() . '_' . time() . '.' . $extension;

            $path = public_path($fileName);

            // Ensure directory exists
            if (!file_exists(dirname($path))) {
                mkdir(dirname($path), 0755, true);
            }

            file_put_contents($path, $imageData);

            return asset($fileName);
        }

            return $image;
    }


}
