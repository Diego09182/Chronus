<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskList;
use App\Models\Whiteboard;
use App\Models\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;
use Carbon\Carbon;

class TaskController extends Controller
{

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
            } else {
                $task->status = 0;
            }

            if ($validatedData['progress'] == 100) {
                $task->finish_time = now(); 
            }

            $task->save();
        }

        return redirect()->back();
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 獲取任務頁面的頁碼，預設為1
        $taskPage = request()->query('task_page', 1);
        // 獲取列表頁面的頁碼，預設為1
        $listPage = request()->query('list_page', 1);
        // 獲取活動頁面的頁碼，預設為1
        $activityPage = request()->query('activity_page', 1);

        // 檢查任務數量是否超過限制
        if (Task::count() > 20) {
            session()->flash('error', '任務數量超過限制');
        }

        // 檢查列表數量是否超過限制
        if (TaskList::count() > 20) {
            session()->flash('error', '列表數量超過限制');
        }

        // 檢查活動數量是否超過限制
        if (Activity::count() > 20) {
            session()->flash('error', '活動數量超過限制');
        }

        // 獲取任務列表並進行分頁，每頁顯示2個任務
        $tasks = Task::paginate(2, ['*'], 'task_page', $taskPage);
        // 獲取列表資料並進行分頁，每頁顯示3個列表項目
        $lists = TaskList::paginate(3, ['*'], 'list_page', $listPage);
        // 獲取活動列表並進行分頁，每頁顯示5個活動
        $activities = Activity::paginate(3, ['*'], 'activity_page', $activityPage);
        // 獲取最新的白板資料
        $whiteboard = Whiteboard::latest()->first();

        $today = Carbon::now()->format('Y-m-d');
        $activities->each(function ($activity) use ($today) {
            if ($activity->date === $today) {
                session()->flash('message', '有活動到期');
            }
        });

        return view('tasks.index', compact('tasks', 'lists', 'whiteboard', 'activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ValidatedData = $request->validate([
            'title' => 'required|max:15',
            'content' => 'required|max:30',
            'progress' => 'required|numeric',
            'importance' => 'required|numeric|between:1,5',
            'tag' => 'required'
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

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
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
            $task->finish_time = new DateTime();
            $task->save();
        }
        return redirect()->back();
    }

    public function nofinish($id)
    {
        $task = Task::find($id);
        if ($task) {
            $task->status = 0;
            $task->progress = 0;
            $task->finish_time = null;
            $task->save();
        }
        return redirect()->back();
    }

}
