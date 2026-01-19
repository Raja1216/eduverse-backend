<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use App\Traits\UploadsFiles;

class AdminProgramController extends Controller
{
    use UploadsFiles;
    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|unique:programs,code',
            'category' => 'required|in:classroom,self_paced,mock_test',
            'sub_category' => 'nullable|string',
            'product_name' => 'required|string',
            'class' => 'required|string',
            'subject' => 'required|string',
            'duration' => 'required|string',
            'mode' => 'required|in:online,offline',
            'mrp' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'installments' => 'nullable|integer|min:1',
            'cost_per_month' => 'nullable|numeric',
            'image' => 'nullable|string',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'is_active' => 'boolean'
        ]);
        $data['category'] = match ($data['category']) {
            'classroom' => 'Live Classroom',
            'self_paced' => 'Self-Paced',
            'mock_test' => 'Mock Test Series',
        };

        $data['mode'] = match ($data['mode']) {
            'online' => 'Online',
            'offline' => 'Offline',
        };
        if (!empty($data['image'])) {
            $data['image'] = $this->handleImage($data['image'], 'programs');
        }
        return Program::create($data);
    }

    public function update(Request $request, $id)
    {
        $program = Program::findOrFail($id);

        $data = $request->validate([
            'code' => 'required|string|unique:programs,code,' . $program->id,
            'category' => 'required|in:classroom,self_paced,mock_test',
            'sub_category' => 'nullable|string',
            'product_name' => 'required|string',
            'class' => 'required|string',
            'subject' => 'required|string',
            'duration' => 'required|string',
            'mode' => 'required|in:online,offline,with_kit,without_kit',
            'mrp' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'installments' => 'nullable|integer|min:1',
            'cost_per_month' => 'nullable|numeric',
            'image' => 'nullable|string',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'is_active' => 'boolean'
        ]);
        $data['category'] = match ($data['category']) {
            'classroom' => 'Live Classroom',
            'self_paced' => 'Self-Paced',
            'mock_test' => 'Mock Test Series',
        };

        $data['mode'] = match ($data['mode']) {
            'online' => 'Online',
            'offline' => 'Offline',
            'with_kit' => 'With Kit',
            'without_kit' => 'With Out Kit',
        };
        if (!empty($data['image'])) {
            $data['image'] = $this->handleImage($data['image'], 'programs');
        }
        $program->update($data);
        return $program;
    }

    public function destroy($id)
    {
        Program::findOrFail($id)->delete();
        return response()->json(['message' => 'Program deleted']);
    }
}
