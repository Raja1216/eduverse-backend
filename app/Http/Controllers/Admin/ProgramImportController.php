<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProgramImportController extends Controller
{
    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:json|max:10240',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $data = json_decode(file_get_contents($request->file('file')), true);

        if (!is_array($data)) {
            return response()->json(['message' => 'Invalid JSON format'], 400);
        }

        $inserted = 0;
        $updated = 0;
        $failed = [];

        DB::beginTransaction();

        try {
            foreach ($data as $index => $item) {
                $rowValidator = Validator::make($item, [
                    'code' => 'required|string',
                    'category' => 'required|string',
                    'subCategory' => 'required|string',
                    'productName' => 'required|string',
                    'class' => 'required|string',
                    'subject' => 'required|string',
                    'duration' => 'required|string',
                    'mode' => 'required|string',
                    'mrp' => 'required|numeric',
                    'sellingPrice' => 'required|numeric',
                    'installments' => 'required|integer',
                    'costPerMonth' => 'nullable|numeric',
                    'image' => 'nullable|string',
                    'description' => 'nullable|string',
                    'features' => 'nullable|array',
                ]);

                if ($rowValidator->fails()) {
                    $failed[] = [
                        'row' => $index + 1,
                        'errors' => $rowValidator->errors()->all()
                    ];
                    continue;
                }

                $payload = [
                    'category' => $item['category'],
                    'sub_category' => $item['subCategory'],
                    'product_name' => $item['productName'],
                    'class' => $item['class'],
                    'subject' => $item['subject'],
                    'duration' => $item['duration'],
                    'mode' => $item['mode'],
                    'mrp' => $item['mrp'],
                    'selling_price' => $item['sellingPrice'],
                    'installments' => $item['installments'],
                    'cost_per_month' => $item['costPerMonth'] ?? null,
                    'image' => $item['image'] ?? null,
                    'description' => $item['description'] ?? null,
                    'features' => $item['features'] ?? null,
                    'is_active' => true,
                ];

                $program = Program::where('code', $item['code'])->first();

                if ($program) {
                    $program->update($payload);
                    $updated++;
                } else {
                    Program::create(array_merge($payload, [
                        'code' => $item['code'],
                    ]));
                    $inserted++;
                }
            }

            DB::commit();

            return response()->json([
                'message' => 'Import completed',
                'inserted' => $inserted,
                'updated' => $updated,
                'failed' => $failed,
            ]);

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Import failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

