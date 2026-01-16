<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller\CMS;
use App\Models\CmsContent;
use Illuminate\Http\Request;

class CmsContentController extends Controller
{
    public function show($key)
    {
        return CmsContent::where('section_key', $key)->firstOrFail();
    }

    public function update(Request $request, $key)
    {
        $content = CmsContent::updateOrCreate(
            ['section_key' => $key],
            [
                'content' => $request->all(),
                'is_active' => $request->input('is_active', true)
            ]
        );

        return response()->json(['success' => true, 'data' => $content]);
    }
}
