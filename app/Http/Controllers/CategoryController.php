<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function Index(Request $request)
    {
        if ($request->search !== null) {
            $data = Categories::where('CategoryName', 'like', '%' . $request->search . '%')->get();
        } else {
            $data = Categories::all();
        }
        $categorylist = Categories::where('ParentId', 0)->get();
        return view('admin.Category.Index', [
            'title' => 'Quản lý loại hàng'
        ], compact('data', 'categorylist'));
    }

    public function Create()
    {
        $category = new Categories();
        $categorylist = Categories::where('ParentId', 0)->get();
        $category->CategoryId = 0;
        return view('admin.Category.Edit', [
            'title' => 'Thêm loại hàng'
        ], compact('category', 'categorylist'));
    }
    public function Edit($CategoryId)
    {
        $category = Categories::where('CategoryId', $CategoryId)->first();
        $categorylist = Categories::where('ParentId', 0)->get();
        return view('admin.Category.Edit', [
            'title' => 'Cập nhật thông tin loại hàng',
        ], compact('category','categorylist'));
    }
    public function Save(Request $request)
    {
        if ($request->CategoryId == 0) {
            $category = new Categories();
            $category->CategoryName = $request->CategoryName;
            $category->ParentId = $request->ParentId;
            $category->CategoryDescription = $request->CategoryDescription;
            $category->save();
            return redirect('category')->with('message', 'Thêm loại hàng thành công');
        } else {
            $category = Categories::where('CategoryId', $request->CategoryId)->first();
            if ($category) {
                $category->CategoryName = $request->CategoryName;
                $category->ParentId = $request->ParentId;
                $category->CategoryDescription = $request->CategoryDescription;
                $category->save();
                return redirect('category')->with('message', 'Cập nhật thành công');
            }
        }
    }
    public function showDeleteForm($CategoryId)
    {
        $category = Categories::where('CategoryId', $CategoryId)->first();
        $categorylist = Categories::where('ParentId', 0)->get();
        return view('admin.Category.Delete', [
            'title' => 'Xóa loại hàng',
        ], compact('category','categorylist'));
    }
    public function delete(Request $request, $CategoryId)
    {
        $category = Categories::find($CategoryId);

        if (!$category) {
            return redirect()->back()->with('error', 'Không tìm thấy loại hàng để xóa');
        }

        $category->delete();
        return redirect('category')->with('message', 'Xóa loại hàng thành công');
    }
}
