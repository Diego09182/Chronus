<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ActivityService;

class ActivityController extends Controller
{

    protected $activityService;

    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;
    }

    public function store(Request $request)
    {
        try {
            $this->activityService->checkActivityLimit();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        $validatedData = $request->validate([
            'activity' => 'required',
            'content' => 'required',
            'location' => 'required',
            'date' => 'required|date|after:now',
        ], [
            'activity.required' => '活動為必填項目',
            'content.required' => '內容為必填項目',
            'location.required' => '地點為必填項目',
            'date.required' => '活動時間為必填項目',
            'date.after' => '活動時間必須大於當前時間',
        ]);

        $activity = new Activity();
        $activity->activity = $validatedData['activity'];
        $activity->content = $validatedData['content'];
        $activity->location = $validatedData['location'];
        $activity->date = $validatedData['date'];
        $activity->save();

        return redirect()->route('tasks.index')->with('success', '活動創建成功');
    }

    public function create()
    {
        return view('activities.create');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();

        return redirect()->route('tasks.index')->with('success', '活動刪除成功');
    }
}
