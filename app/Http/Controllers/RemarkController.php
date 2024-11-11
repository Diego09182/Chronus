<?php

namespace App\Http\Controllers;

use App\Models\Remark;
use App\Services\RemarkService;
use Illuminate\Http\Request;

class RemarkController extends Controller
{
    protected $remarkService;

    public function __construct(RemarkService $remarkService)
    {
        $this->remarkService = $remarkService;
    }

    public function store(Request $request, $id)
    {

        try {
            $this->remarkService->checkRemarkLimit($id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        $ValidatedData = $request->validate([
            'title' => 'required|max:15',
            'remark' => 'required|max:30',
        ], [
            'title.required' => '請填寫註記標題',
            'title.max' => '註記標題長度不能超過15個字',
            'remark.required' => '請填寫註記內容',
            'remark.max' => '註記內容長度不能超過30個字',
        ]);

        $remark = new Remark;
        $remark->task_id = $id;
        $remark->title = $ValidatedData['title'];
        $remark->content = $ValidatedData['remark'];
        $remark->save();

        return redirect()->back()->with('success', '註記創建成功');
    }

    public function destroy($id, $remark)
    {
        $remark = Remark::where('task_id', $id)->findOrFail($remark);

        $remark->delete();

        return redirect()->back()->with('success', '註記刪除成功');
    }
}
