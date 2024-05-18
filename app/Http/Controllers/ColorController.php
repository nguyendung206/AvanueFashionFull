<?php

namespace App\Http\Controllers;

use App\Models\Colors;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function Index(Request $request)
    {
        if ($request->search !== null) {
            $data = Colors::where('ColorName', 'like', '%' . $request->search . '%')->get()->paginate(15);
        } else {
            $data = Colors::paginate(15);
        }
        return view('admin.Color.Index', [
            'title' => 'Quản lý màu sắc'
        ], compact('data'))->with('i', (request()->input('page', 1) - 1) * 15);
    }

    public function Create()
    {
        $color = new Colors();
        $color->ColorId = 0;
        return view('admin.Color.Edit', [
            'title' => 'Thêm màu'
        ], compact('color'));
    }
    public function Edit($ColorId)
    {
        $color = Colors::where('ColorId', $ColorId)->first();
        return view('admin.Color.Edit', [
            'title' => 'Cập nhật thông tin màu',
        ], compact('color'));
    }
    public function Save(Request $request)
    {
        if ($request->ColorId == 0) {
            $color = new Colors();
            $color->ColorName = $request->ColorName;
            $color->ColorIllustration = $request->ColorIllustration;
            $color->save();
            return redirect('color')->with('message', 'Thêm màu thành công');
        } else {
            $color = Colors::where('ColorId', $request->ColorId)->first();
            if ($color) {
                $color->ColorName = $request->ColorName;
                $color->ColorIllustration = $request->ColorIllustration;
                $color->save();
                return redirect('color')->with('message', 'Cập nhật thành công');
            }
        }
    }
    public function showDeleteForm($ColorId)
    {
        $color = Colors::where('ColorId', $ColorId)->first();
        return view('admin.Color.Delete', [
            'title' => 'Xóa màu',
        ], compact('color'));
    }
    public function delete(Request $request, $ColorId)
    {
        $color = Colors::find($ColorId);

        if (!$color) {
            return redirect()->back()->with('error', 'Không tìm thấy màu để xóa');
        }

        $color->delete();
        return redirect('color')->with('message', 'Xóa màu thành công');
    }
}
