<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskFileController extends Controller
{
    /**
     * 將附加檔案上傳並與任務關聯
     */
    public function store(Request $request, $taskId)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ], [
            'file.required' => '請選擇一個檔案上傳。',
            'file.file' => '上傳的內容必須是一個有效的檔案。',
            'file.mimes' => '檔案類型必須是 JPG、JPEG、PNG、PDF、DOC 或 DOCX。',
            'file.max' => '檔案大小不能超過 2MB。',
        ]);        

        $task = Task::findOrFail($taskId);

        // 檔案上傳
        if ($file = $request->file('file')) {
            $filePath = $file->store('task_files');
            $task->files()->create([
                'file_path' => $filePath,
                'file_name' => $file->getClientOriginalName(),
                'file_size' => $file->getSize(),
                'file_type' => $file->getClientMimeType(),
            ]);

            return redirect()->back()->with('success', '檔案上傳成功');
        }

        return redirect()->back()->with('error', '檔案上傳失敗');
    }

    /**
     * 下載附加檔案
     */
    public function download($id)
    {
        $taskFile = TaskFile::findOrFail($id);

        return Storage::download($taskFile->file_path, $taskFile->file_name);
    }

    /**
     * 刪除附加檔案
     */
    public function destroy($id)
    {
        $taskFile = TaskFile::findOrFail($id);

        // 刪除檔案
        Storage::delete($taskFile->file_path);
        $taskFile->delete();

        return redirect()->back()->with('success', '檔案已成功刪除');
    }
}
