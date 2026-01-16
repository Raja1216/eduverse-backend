<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Http\Request;

class AdminPublicationController extends Controller
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

        return Publication::create($data);
    }

    public function update(Request $request, $id)
    {
        $item = Publication::findOrFail($id);

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
        Publication::findOrFail($id)->delete();
        return response()->json(['message' => 'Publication deleted']);
    }
}
