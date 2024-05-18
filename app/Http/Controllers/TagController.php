<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function Index(Request $request)
    {
        if ($request->search !== null) {
            $data = Tags::where('TagName', 'like', '%' . $request->search . '%')->paginate(10);
        } else {
            $data = Tags::paginate(10);
        }
        return view('admin.Tag.Index', [
            'title' => 'Quản lý tag'
        ], compact('data'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function Create()
    {
        $tag = new Tags();
        $tag->TagId = 0;
        return view('admin.Tag.Edit', [
            'title' => 'Thêm tag'
        ], compact('tag'));
    }
    public function Edit($TagId)
    {
        $tag = Tags::where('TagId', $TagId)->first();
        return view('admin.Tag.Edit', [
            'title' => 'Cập nhật thông tin tag',
        ], compact('tag'));
    }
    public function Save(Request $request)
    {
        if ($request->TagId == 0) {
            $tag = new Tags();
            $tag->TagName = $request->TagName;
            $tag->TagDescription = $request->TagDescription;
            $tag->save();
            return redirect('tag')->with('message', 'Thêm tag thành công');
        } else {
            $tag = Tags::where('TagId', $request->TagId)->first();
            if ($tag) {
                $tag->TagName = $request->TagName;
                $tag->TagDescription = $request->TagDescription;
                $tag->save();
                return redirect('tag')->with('message', 'Cập nhật thành công');
            }
        }
    }
    public function showDeleteForm($TagId)
    {
        $tag = Tags::where('TagId', $TagId)->first();
        return view('admin.Tag.Delete', [
            'title' => 'Xóa tag',
        ], compact('tag'));
    }
    public function delete(Request $request, $TagId)
    {
        $tag = Tags::find($TagId);

        if (!$tag) {
            return redirect()->back()->with('error', 'Không tìm thấy Tag để xóa');
        }

        $tag->delete();
        return redirect('tag')->with('message', 'Xóa Tag thành công');
    }
}
