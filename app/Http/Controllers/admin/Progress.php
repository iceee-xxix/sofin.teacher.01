<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Progresses;
use App\Models\User;
use Illuminate\Http\Request;

class Progress extends Controller
{
    public function progress()
    {
        $data['function_key'] = __FUNCTION__;
        return view('progress.index', $data);
    }

    public function progresslistData()
    {
        $data = [
            'status' => false,
            'message' => '',
            'data' => []
        ];
        $table = User::where('role', 'user')->get();

        if (count($table) > 0) {
            $info = [];
            foreach ($table as $rs) {
                $action = '<a href="' . route('progressDetail', $rs->id) . '" class="btn btn-sm btn-outline-primary" title="รายงานผล"><i class="bx bx-message-rounded-dots"></i></a>';
                $info[] = [
                    'name' => $rs->name,
                    'email' => $rs->email,
                    'tel' => $rs->tel,
                    'action' => $action
                ];
            }
            $data = [
                'data' => $info,
                'status' => true,
                'message' => 'success'
            ];
        }
        return response()->json($data);
    }

    public function progressDetail($id)
    {
        $data['function_key'] = 'progress';
        $data['id'] = $id;
        return view('progress.detail', $data);
    }

    public function progressDetaillistData(Request $request)
    {
        $users_id = $request->post('users_id');
        $data = [
            'status' => false,
            'message' => '',
            'data' => []
        ];
        $table = Progresses::where('users_id', $users_id)->get();

        if (count($table) > 0) {
            $info = [];
            foreach ($table as $rs) {
                $action = '<a href="' . route('progressDetailEdit', $rs->id) . '" class="btn btn-sm btn-outline-primary" title="รายงานผล"><i class="bx bx-edit-alt"></i></a>
                <button type="button" data-id="' . $rs->id . '" class="btn btn-sm btn-outline-danger deleteTable" title="ลบ"><i class="bx bxs-trash"></i></button>';
                $info[] = [
                    'link_url' => $rs->link_url,
                    'remark' => $rs->remark,
                    'action' => $action
                ];
            }
            $data = [
                'data' => $info,
                'status' => true,
                'message' => 'success'
            ];
        }
        return response()->json($data);
    }

    public function progressDetailCreate($id)
    {
        $data['function_key'] = 'progress';
        $data['id'] = $id;
        return view('progress.create', $data);
    }

    public function progressDetailEdit($id)
    {
        $function_key = 'progress';
        $info = Progresses::find($id);

        return view('progress.edit', compact('info', 'function_key'));
    }

    public function ProgressSave(Request $request)
    {
        $input = $request->input();
        if (!isset($input['id'])) {
            $table = new Progresses();
            $table->users_id = $input['users_id'];
            $table->link_url = $input['link_url'];
            $table->remark = $input['remark'];
            if ($table->save()) {
                return redirect()->route('progressDetail', $input['users_id'])->with('success', 'บันทึกรายการเรียบร้อยแล้ว');
            }
        } else {
            $table = Progresses::find($input['id']);
            $table->link_url = $input['link_url'];
            $table->remark = $input['remark'];
            if ($table->save()) {
                return redirect()->route('progressDetail', $table->users_id)->with('success', 'บันทึกรายการเรียบร้อยแล้ว');
            }
        }
        return redirect()->route('progress')->with('error', 'ไม่สามารถบันทึกข้อมูลได้');
    }

    public function tableDelete(Request $request)
    {
        $data = [
            'status' => false,
            'message' => 'ลบข้อมูลไม่สำเร็จ',
        ];
        $id = $request->input('id');
        if ($id) {
            $delete = ModelsTable::find($id);
            if ($delete->delete()) {
                $data = [
                    'status' => true,
                    'message' => 'ลบข้อมูลเรียบร้อยแล้ว',
                ];
            }
        }

        return response()->json($data);
    }
}
