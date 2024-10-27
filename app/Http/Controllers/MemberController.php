<?php

namespace App\Http\Controllers;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Services\MemberService;

class MemberController extends Controller
{

    protected $memberService;

    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }

    public function store(Request $request, $id)
    {

        try {
            $this->memberService->checkMemberLimit($id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        $validatedData = $request->validate([
            'name' => 'required|max:5',
            'position' => 'required|max:10',
        ], [
            'name.required' => '請填寫姓名',
            'name.max' => '姓名長度不能超過5個字',
            'position.required' => '請填寫職位',
            'position.max' => '職位長度不能超過10個字',
        ]);

        $member = new Member();
        $member->task_id = $id;
        $member->name = $validatedData['name'];
        $member->position = $validatedData['position'];
        $member->save();

        return redirect()->back()->with('success', '成員創建成功');
    }

    public function destroy($id,$member)
    {
        $member = Member::where('task_id', $id)->findOrFail($member);

        $member->delete();

        return redirect()->back()->with('success', '成員刪除成功');
    }
}
