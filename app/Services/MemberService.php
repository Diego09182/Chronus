<?php

namespace App\Services;

use App\Models\Member;

class MemberService
{
    public function checkMemberLimit($taskId)
    {
        $memberCount = Member::where('task_id', $taskId)->count();
        $maxMemberCount = 8;

        if ($memberCount >= $maxMemberCount) {
            throw new \Exception('成員數量已達上限，無法再創建新成員。');
        }
    }
}
