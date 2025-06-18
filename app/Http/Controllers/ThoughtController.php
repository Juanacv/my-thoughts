<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Thought;
use Illuminate\Http\Request;

class ThoughtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $request->user()->thoughts()->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);
    
        $thought = $request->user()->thoughts()->create([
            'content' => $request->content,
        ]);
    
        return response()->json($thought, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function update(Request $request, Thought $thought)
    {
        $this->authorizeAction($request->user(), $thought);
    
        $request->validate([
            'content' => 'required|string|max:255',
        ]);
    
        $thought->update(['content' => $request->content]);
    
        return response()->json($thought);
    }
    
    public function destroy(Request $request, Thought $thought)
    {
        $this->authorizeAction($request->user(), $thought);
    
        $thought->delete();
    
        return response()->json(null, 204);
    }

    protected function authorizeAction(User $user, Thought $thought)
{
        if ($thought->user_id !== $user->id) {
            abort(403, 'No autorizado.');
        }
    }
}
