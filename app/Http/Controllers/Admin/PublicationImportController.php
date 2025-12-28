<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PublicationImportController extends Controller
{
    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:json'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        $publications = json_decode(file_get_contents($request->file('file')), true);

        DB::beginTransaction();

        try {
            $inserted = 0;

            foreach ($publications as $item) {
                Publication::create([
                    'title' => $item['title'],
                    'description' => $item['description'],
                    'class' => $item['class'],
                    'price' => 599,
                    'image' => $item['image'] ?? null,
                    'is_active' => true
                ]);

                $inserted++;
            }

            DB::commit();

            return response()->json([
                'message' => 'Publications imported successfully',
                'inserted' => $inserted
            ]);

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
