<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            // This userId is the user we want to get the chat from.
            $userId = $request->user_id;
            return Message::where(function ($query) use ($userId) {
                $query->where('from_user_id', auth()->id())
                    ->where('to_user_id', $userId);
            })->orWhere(function ($query) use ($userId) {
                $query->where('from_user_id', $userId)
                    ->where('to_user_id', auth()->id());
            })->orderBy('created_at', 'ASC')->get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageRequest $request)
    {
        try {
            $message = Message::create([
                "message" => $request->get('message'),
                "to_user_id" => $request->get('to_user_id'),
                "from_user_id" => auth()->id()
            ]);
            return response()->json(['message' => 'Message created successfully'], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while creating a message'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
