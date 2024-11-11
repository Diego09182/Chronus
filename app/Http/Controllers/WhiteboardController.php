<?php

namespace App\Http\Controllers;

use App\Models\Whiteboard;
use Illuminate\Http\Request;

class WhiteboardController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'whiteboard' => 'required|string|max:30',
        ], [
            'whiteboard.required' => '請填寫白板',
            'whiteboard.max' => '白板長度不能超過30個字',
        ]);

        if (Whiteboard::count() > 0) {
            Whiteboard::latest()->first()->delete();
        }

        $whiteboard = new Whiteboard;
        $whiteboard->whiteboard = $validatedData['whiteboard'];
        $whiteboard->save();

        return redirect()->route('tasks.index');
    }

    public function destroy(string $id)
    {
        $whiteboard = Whiteboard::findOrFail($id);
        $whiteboard->delete();

        return redirect()->route('tasks.index');
    }
}
