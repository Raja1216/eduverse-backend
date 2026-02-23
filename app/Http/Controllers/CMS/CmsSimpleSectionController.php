<?php
namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\CmsSimpleSection;
use Illuminate\Http\Request;


class CmsSimpleSectionController extends Controller
{
    public function show($key)
    {
        $site = app('currentSite');
        return CmsSimpleSection::where('section_key', $key)->where('site_id', $site->id)->firstOrFail();
    }

    public function update(Request $request, $key)
    {
        $site = app('currentSite');
        $data = CmsSimpleSection::updateOrCreate(
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
