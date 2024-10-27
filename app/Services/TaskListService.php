<?php

namespace App\Services;

use App\Models\TaskList;

class TaskListService
{
    public function checkTaskListLimit()
    {
        $taskListCount = TaskList::count();
        $maxTaskListCount = 20;

        if ($taskListCount >= $maxTaskListCount) {
            throw new \Exception('事項數量已達上限，無法再創建新事項。');
        }
    }
}
