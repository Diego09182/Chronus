<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\TaskService;
use DateTime;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function progress(Request $request, $id)
    {
        $validatedData = $request->validate([
            'progress' => 'required|integer|min:0|max:100',
        ], [
            'progress.required' => '請填寫進度',
            'progress.integer' => '進度必須是整數',
            'progress.min' => '進度必須是0到100的整數',
            'progress.max' => '進度必須是0到100的整數',
        ]);

        $task = Task::find($id);

        if ($task) {
            $task->progress = $validatedData['progress'];

            if ($validatedData['progress'] == 100) {
                $task->status = 1;
                $task->finish_time = now();
            } else {
                $task->status = 0;
            }

            $task->save();

            return response()->json(['success' => true, 'status' => $task->status, 'progress' => $task->progress]);
        }

        return response()->json(['success' => false, 'message' => 'Task not found'], 404);
    }

    public function index()
    {
        return view('main.index', $this->taskService->index());
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        try {
            $this->taskService->checkTaskLimit();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        $ValidatedData = $request->validate([
            'title' => 'required|max:15',
            'content' => 'required|max:30',
            'progress' => 'required|numeric',
            'importance' => 'required|numeric|between:1,5',
            'tag' => 'required',
        ], [
            'title.required' => '請填寫標題',
            'title.max' => '標題長度不能超過15個字',
            'content.required' => '請填寫內容',
            'content.max' => '內容長度不能超過30個字',
            'progress.required' => '請填寫進度',
            'progress.numeric' => '進度必須是數字',
            'importance.required' => '請填寫重要性',
            'importance.numeric' => '重要性必須是數字',
            'importance.between' => '重要性必須在1和5之間',
            'tag.required' => '請填寫標籤',
        ]);

        $task = new Task;
        $task->title = $ValidatedData['title'];
        $task->tag = $ValidatedData['tag'];
        $task->content = $ValidatedData['content'];
        $task->progress = $ValidatedData['progress'];
        $task->schedule = $request->input('schedule');
        $task->start_time = $request->input('start_time');
        $task->finish_time = $request->input('finish_time');
        $task->importance = $ValidatedData['importance'];
        $task->save();

        return redirect()->route('tasks.index')->with('success', '任務已成功新增！');
    }

    public function show(Task $task)
    {
        $task = Task::with(['members', 'remarks', 'files'])->findOrFail($task->id);

        $members = $task->members()->paginate(8);
        $remarks = $task->remarks()->paginate(2);

        return view('tasks.show', compact('task', 'members', 'remarks'));
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', '任務已刪除');
    }

    public function finish($id)
    {
        $task = Task::find($id);
        if ($task) {
            $task->status = 1;
            $task->progress = 100;
            $task->finish_time = new DateTime;
            $task->save();

            return response()->json(['status' => $task->status]);
        }

        return response()->json(['error' => 'Task not found'], 404);
    }

    public function nofinish($id)
    {
        $task = Task::find($id);
        if ($task) {
            $task->status = 0;
            $task->progress = 0;
            $task->finish_time = null;
            $task->save();

            return response()->json(['status' => $task->status]);
        }

        return response()->json(['error' => 'Task not found'], 404);
    }
}
