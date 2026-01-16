<?php
namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\CmsContentSection;
use Illuminate\Http\Request;


class CmsContentSectionController extends Controller
{
    public function show($key)
    {
        return CmsContentSection::where('section_key', $key)->firstOrFail();
    }

    public function update(Request $request, $key)
    {
        $data = CmsContentSection::updateOrCreate(
            ['section_key' => $key],
            [
                'content' => $request->all(),
                'is_active' => $request->input('is_active', true)
            ]
        );

        return response()->json(['success' => true, 'data' => $data]);
    }
}
