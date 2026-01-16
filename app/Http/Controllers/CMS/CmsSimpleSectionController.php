<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller\CMS;
use App\Models\CmsSimpleSection;
use Illuminate\Http\Request;


class CmsSimpleSectionController extends Controller
{
    public function show($key)
    {
        return CmsSimpleSection::where('section_key', $key)->firstOrFail();
    }

    public function update(Request $request, $key)
    {
        $data = CmsSimpleSection::updateOrCreate(
            ['section_key' => $key],
            [
                'content' => $request->all(),
                'is_active' => $request->input('is_active', true)
            ]
        );

        return response()->json(['success' => true, 'data' => $data]);
    }
}
