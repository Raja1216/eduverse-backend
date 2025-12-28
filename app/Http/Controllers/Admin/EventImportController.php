<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EventImportController extends Controller
{
    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:json'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        $events = json_decode(file_get_contents($request->file('file')), true);

        DB::beginTransaction();

        try {
            $inserted = 0;

            foreach ($events as $event) {
                Event::create([
                    'title' => $event['title'],
                    'description' => $event['description'],
                    'class' => $event['class'],
                    'price' => $event['price'],
                    'event_date' => $event['date'],
                    'event_time' => $event['time'],
                    'venue' => $event['venue'],
                    'max_participants' => $event['max_participants'],
                    'features' => $event['features'],
                    'is_active' => true
                ]);

                $inserted++;
            }

            DB::commit();

            return response()->json([
                'message' => 'Events imported successfully',
                'inserted' => $inserted
            ]);

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
