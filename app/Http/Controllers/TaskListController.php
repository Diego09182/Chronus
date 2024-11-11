<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use App\Services\TaskListService;
use Illuminate\Http\Request;

class TaskListController extends Controller
{
    protected $taskListService;

    public function __construct(TaskListService $taskListService)
    {
        $this->taskListService = $taskListService;
    }

    public function store(Request $request)
    {
        try {
            $this->taskListService->checkTaskListLimit();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        $ValidatedData = $request->validate([
            'title' => 'required|string|max:5',
        ],
            [
                'title.required' => '請填寫事項',
                'title.max' => '標題長度不能超過5個字',
            ]);

        $list = new TaskList;
        $list->title = $ValidatedData['title'];
        $list->save();

        return redirect()->route('tasks.index')->with('success', '事項已成功新增！');
    }

    public function destroy(string $id)
    {
        $taskList = TaskList::findOrFail($id);
        $taskList->delete();

        return redirect()->route('tasks.index')->with('success', '事項已刪除');
    }
}
