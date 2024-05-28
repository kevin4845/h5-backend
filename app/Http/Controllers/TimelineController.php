<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTimelineRequest;
use App\Http\Requests\UpdateTimelineRequest;
use App\Models\Timeline;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->has('user_id')) {
                return Timeline::where('user_id', $request->get('user_id'))->orderBy('start', 'ASC')->get();
            } else {
                return Timeline::where('user_id', auth()->id())->orderBy('start', 'ASC')->get();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTimelineRequest $request)
    {
        try {
            $timeline = Timeline::create([
                "title" => $request->get('title'),
                "start" => $request->get('start'),
                "description" => $request->get('description'),
                "end" => $request->get('end'),
                "user_id" => auth()->id()
            ]);
            return response()->json(['message' => 'Timeline created successfully'], 201);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Timeline $timeline)
    {
        try {
            return $timeline;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTimelineRequest $request, Timeline $timeline)
    {
        try {
            $timeline->update($request->all());
            return response()->json(['message' => 'Timeline updated successfully'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Timeline $timeline)
    {
        try {
            $timeline->delete();
            return response()->json(['message' => 'Timeline deleted successfully'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
