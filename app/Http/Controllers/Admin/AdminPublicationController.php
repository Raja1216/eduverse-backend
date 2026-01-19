<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use App\Traits\UploadsFiles;
use Illuminate\Http\Request;

class AdminPublicationController extends Controller
{
    use UploadsFiles;
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
        if (!empty($data['image'])) {
            $data['image'] = $this->handleImage($data['image'], 'publications');
        }
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
        if (!empty($data['image'])) {
            $data['image'] = $this->handleImage($data['image'], 'publications');
        }
        $item->update($data);
        return $item;
    }

    public function destroy($id)
    {
        Publication::findOrFail($id)->delete();
        return response()->json(['message' => 'Publication deleted']);
    }
}
