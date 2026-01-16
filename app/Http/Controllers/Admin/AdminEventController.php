<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class AdminEventController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'class' => 'required|string',
            'price' => 'required|numeric',
            'event_date' => 'required|date',
            'event_time' => 'nullable',
            'venue' => 'nullable|string',
            'image' => 'nullable|string',
            'max_participants' => 'nullable|integer',
            'features' => 'nullable|array',
            'is_active' => 'boolean'
        ]);

        return Event::create($data);
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'class' => 'required|string',
            'price' => 'required|numeric',
            'event_date' => 'required|date',
            'event_time' => 'nullable',
            'venue' => 'nullable|string',
            'image' => 'nullable|string',
            'max_participants' => 'nullable|integer',
            'features' => 'nullable|array',
            'is_active' => 'boolean'
        ]);

        $event->update($data);
        return $event;
    }

    public function destroy($id)
    {
        Event::findOrFail($id)->delete();
        return response()->json(['message' => 'Event deleted']);
    }
}
