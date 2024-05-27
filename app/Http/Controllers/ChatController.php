<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            
            $query = DB::select('select fromuser.name as from_user, touser.name as to_user from messages 
            join users as touser on touser.id = to_user_id
            join users as fromuser on fromuser.id = from_user_id 
            where to_user_id in (SELECT sub.id from (SELECT distinct to_user_id, id from messages) as sub)
            or from_user_id in (SELECT sub.id from (SELECT distinct from_user_id, id from messages) as sub)');

            return $query;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
