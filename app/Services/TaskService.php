<?php

namespace App\Services;

use App\Models\Task;
use App\Models\TaskList;
use App\Models\Whiteboard;
use App\Models\Activity;
use Carbon\Carbon;

class TaskService
{
    public function checkTaskLimit()
    {
        $taskCount = Task::count();
        $maxTaskCount = 20;

        if ($taskCount >= $maxTaskCount) {
            throw new \Exception('任務數量已達上限，無法再創建新任務。');
        }
    }

    public function index()
    {
        $taskPage = request()->query('task_page', 1);
        $listPage = request()->query('list_page', 1);
        $activityPage = request()->query('activity_page', 1);

        $tasks = $this->paginateTasks($taskPage);
        $lists = $this->paginateLists($listPage);
        $activities = $this->paginateActivities($activityPage);
        $whiteboard = $this->getLatestWhiteboard();
        $this->checkExpiredActivities($activities);

        return compact('tasks', 'lists', 'whiteboard', 'activities');
    }

    protected function paginateTasks($taskPage)
    {
        return Task::paginate(2, ['*'], 'task_page', $taskPage);
    }

    protected function paginateLists($listPage)
    {
        return TaskList::paginate(3, ['*'], 'list_page', $listPage);
    }

    protected function paginateActivities($activityPage)
    {
        return Activity::paginate(3, ['*'], 'activity_page', $activityPage);
    }

    protected function getLatestWhiteboard()
    {
        return Whiteboard::latest()->first();
    }

    protected function checkExpiredActivities($activities)
    {
        $today = Carbon::now()->format('Y-m-d');
        $activities->each(function ($activity) use ($today) {
            if ($activity->date === $today) {
                session()->flash('message', '有活動到期');
            }
        });
    }
}
