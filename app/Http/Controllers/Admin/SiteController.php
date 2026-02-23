<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Site;

class SiteController extends Controller
{
    public function index()
    {
        $sites = Site::where('is_active', true)
            ->select('id', 'name', 'slug', 'domain', 'logo_url')
            ->orderBy('name')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $sites
        ]);
    }
}