<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\CmsContent;
use App\Traits\UploadsFiles;
use Illuminate\Http\Request;

class CmsContentController extends Controller
{
    use UploadsFiles;
    public function show($key)
    {
        $site = app('currentSite');
        return CmsContent::where('section_key', $key)->where('site_id', $site->id)->firstOrFail();
    }

    public function update(Request $request, $key)
    {
        $site = app('currentSite');
        $data = $request->all();

        // Handle common CMS file fields
        $fileFields = [
            'background_image_url',
            'background_video_url',
            'image_url',
            'logo_url',
            'since_image_url',
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field) || $request->filled($field)) {
                $uploaded = $this->handleFileOrUrl($request, $field, 'cms/' . $key);
                if ($uploaded) {
                    $data[$field] = $uploaded;
                }
            }
        }

        $content = CmsContent::updateOrCreate(
            [
                'site_id' => $site->id,
                'section_key' => $key
            ],
            [
                'content' => $data,
                'is_active' => $request->input('is_active', true),
            ]
        );

        return response()->json([
            'success' => true,
            'data' => $content
        ]);
    }
}
