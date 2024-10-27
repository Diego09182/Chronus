<?php

namespace App\Services;

use App\Models\Remark;

class RemarkService
{
    public function checkRemarkLimit($taskId)
    {
        $remarkCount = Remark::where('task_id', $taskId)->count();
        $maxRemarkCount = 2;

        if ($remarkCount >= $maxRemarkCount) {
            throw new \Exception('備註數量已達上限，無法再創建新備註。');
        }
    }

}
