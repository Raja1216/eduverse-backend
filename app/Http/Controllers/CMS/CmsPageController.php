<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\CmsContent;
use App\Models\CmsContentSection;
use App\Models\CmsSimpleSection;

class CmsPageController extends Controller
{
    public function pageContent()
    {
        $site = app('currentSite'); // ✅ important

        return response()->json([
            'success' => true,
            'data' => [
                'hero' => CmsContent::where('site_id', $site->id)->where('section_key','hero')->value('content'),
                'why_how' => CmsContent::where('site_id', $site->id)->where('section_key','why_how')->value('content'),
                'impact' => CmsContent::where('site_id', $site->id)->where('section_key','impact')->value('content'),
                'about' => CmsContent::where('site_id', $site->id)->where('section_key','about')->value('content'),
                'contact' => CmsContent::where('site_id', $site->id)->where('section_key','contact')->value('content'),
                'navbar' => CmsContent::where('site_id', $site->id)->where('section_key','navbar')->value('content'),
                'footer' => CmsContent::where('site_id', $site->id)->where('section_key','footer')->value('content'),
                'store_meta' => CmsContent::where('site_id', $site->id)->where('section_key','store_meta')->value('content'),
                'programs_meta' => CmsContent::where('site_id', $site->id)->where('section_key','programs_meta')->value('content'),

                'simple_sections' => CmsSimpleSection::where('site_id', $site->id)
                    ->where('is_active',1)
                    ->get(),

                'content_sections' => CmsContentSection::where('site_id', $site->id)
                    ->where('is_active',1)
                    ->get(),
            ]
        ]);
    }
}