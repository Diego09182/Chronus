<?php

namespace App\Http\Controllers;

use App\Models\Whiteboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WhiteboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'whiteboard' => 'required|string|max:30',
        ],
        [
            'whiteboard.required' => '請填寫白板',
            'whiteboard.max' => '白板長度不能超過30個字',
        ]);
        Whiteboard::create($data);

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
        $whiteboard = Whiteboard::findOrFail($id);
        $whiteboard->delete();

        return redirect()->route('tasks.index');
    }
}
