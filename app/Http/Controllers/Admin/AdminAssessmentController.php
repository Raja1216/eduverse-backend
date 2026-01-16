<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use Illuminate\Http\Request;
class AdminAssessmentController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'class' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
            'features' => 'nullable|array',
            'is_active' => 'boolean'
        ]);

        return Assessment::create($data);
    }

    public function update(Request $request, $id)
    {
        $item = Assessment::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'class' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
            'features' => 'nullable|array',
            'is_active' => 'boolean'
        ]);

        $item->update($data);
        return $item;
    }

    public function destroy($id)
    {
        Assessment::findOrFail($id)->delete();
        return response()->json(['message' => 'Assessment deleted']);
    }
}
