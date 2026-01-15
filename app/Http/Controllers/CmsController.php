<?php
namespace App\Http\Controllers;

use App\Services\CmsService;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    public function get(string $key, CmsService $service)
    {
        return response()->json([
            'key' => $key,
            'content' => $service->get($key)
        ]);
    }

    public function set(string $key, Request $request, CmsService $service)
    {
        return response()->json(
            $service->set($key, $request->all())
        );
    }

    public function getAll(CmsService $service)
    {
        return response()->json(
            $service->getAll()
        );
    }
}
