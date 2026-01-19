<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Traits\UploadsFiles;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    use UploadsFiles;
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
            'images' => 'nullable|array',
            'class' => 'nullable|string',
            'subject' => 'nullable|string',
            'category' => 'required|string',
            'colors' => 'nullable|array',
            'sizes' => 'nullable|array',
            'stock' => 'required|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean'
        ]);
        if (!empty($data['image'])) {
            $data['image'] = $this->handleImage($data['image'], 'products');
        }
        return Product::create($data);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
            'images' => 'nullable|array',
            'class' => 'nullable|string',
            'subject' => 'nullable|string',
            'category' => 'required|string',
            'colors' => 'nullable|array',
            'sizes' => 'nullable|array',
            'stock' => 'required|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean'
        ]);
        if (!empty($data['image'])) {
            $data['image'] = $this->handleImage($data['image'], 'products');
        }
        $product->update($data);
        return $product;
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return response()->json(['message' => 'Product deleted']);
    }
}
