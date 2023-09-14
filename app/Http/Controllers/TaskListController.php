<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:5',
        ],
        [
            'title.required' => '請填寫事項',
            'title.max' => '標題長度不能超過5個字',
        ]);
        TaskList::create($data);

        return redirect()->route('tasks.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('lists.show', compact('list'));
    }
    //
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('lists.edit', compact('list'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $taskList = TaskList::findOrFail($id);
        $taskList->delete();

        return redirect()->route('tasks.index')->with('success', '事項已刪除');
    }
}
