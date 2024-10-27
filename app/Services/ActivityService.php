<?php

namespace App\Services;

use App\Models\Activity;

class ActivityService
{
    public function checkActivityLimit()
    {
        $activityCount = Activity::count();
        $maxActivityCount = 20;

        if ($activityCount >= $maxActivityCount) {
            throw new \Exception('活動數量已達上限，無法再創建新活動。');
        }
    }

}
