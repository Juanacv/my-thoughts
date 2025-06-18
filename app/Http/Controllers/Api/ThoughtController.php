<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Thought;

class ThoughtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Thought::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:255',
        ]);

        return Thought::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate(['content' => 'required|string|max:255']);

        $thought = Thought::findOrFail($id);
        $thought->content = $request->content;
        $thought->save();

        return response()->json($thought);
    }

    public function destroy($id)
    {
        $thought = Thought::findOrFail($id);
        $thought->delete();

        return response()->json(null, 204);
    }
}
