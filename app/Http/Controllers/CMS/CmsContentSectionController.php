<?php
namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\CmsContentSection;
use Illuminate\Http\Request;


class CmsContentSectionController extends Controller
{
    public function show($key)
    {
        $site = app('currentSite');
        return CmsContentSection::where('section_key', $key)->where('site_id', $site->id)->firstOrFail();
    }

    public function update(Request $request, $key)
    {
        $site = app('currentSite');
        $data = CmsContentSection::updateOrCreate(
            [
                'site_id' => $site->id,
                'section_key' => $key
            ],
            [
                'content' => $request->all(),
                'is_active' => $request->input('is_active', true)
            ]
        );

        return response()->json(['success' => true, 'data' => $data]);
    }
}
