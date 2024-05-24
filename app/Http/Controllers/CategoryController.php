<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function Index(Request $request)
    {
        if ($request->search !== null) {
            $data = Categories::where('CategoryName', 'like', '%' . $request->search . '%')->paginate(15);
        } else {
            $data = Categories::paginate(15);
        }
        $categorylist = Categories::all();
        return view('admin.Category.Index', [
            'title' => 'Quản lý loại hàng'
        ], compact('data', 'categorylist'))->with('i', (request()->input('page', 1) - 1) * 15);
    }

    private function buildCategoryTree($categories, $parentId = 0, $level = 0)
    {
        $branch = [];

        foreach ($categories as $category) {
            if ($category->ParentId == $parentId) {
                $category->level = $level;
                $branch[] = $category;
                $children = $this->buildCategoryTree($categories, $category->CategoryId, $level + 1);
                $branch = array_merge($branch, $children);
            }
        }

        return $branch;
    }
    public function Create()
    {
        $category = new Categories();
        $allCategories = Categories::all();
        $categoryTree = $this->buildCategoryTree($allCategories);

        $category->CategoryId = 0;
        return view('admin.Category.Edit', [
            'title' => 'Thêm loại hàng'
        ], compact('category', 'categoryTree'));
    }

    public function Edit($CategoryId)
    {
        $category = Categories::where('CategoryId', $CategoryId)->first();
        $allCategories = Categories::all();
        $categoryTree = $this->buildCategoryTree($allCategories);

        return view('admin.Category.Edit', [
            'title' => 'Cập nhật thông tin loại hàng',
        ], compact('category', 'categoryTree'));
    }

    public function Save(Request $request)
    {
        if ($request->CategoryId == 0) {
            $category = new Categories();
            $category->CategoryName = $request->CategoryName;
            $category->ParentId = $request->ParentId;
            $category->CategoryDescription = $request->CategoryDescription;
            $category->save();
            return redirect()->route('category')->with('message', 'Thêm loại hàng thành công');
        } else {
            $category = Categories::where('CategoryId', $request->CategoryId)->first();
            if ($category) {
                $category->CategoryName = $request->CategoryName;
                $category->ParentId = $request->ParentId;
                $category->CategoryDescription = $request->CategoryDescription;
                $category->save();
                return redirect()->route('category')->with('message', 'Cập nhật thành công');
            }
        }
    }
    public function showDeleteForm($CategoryId)
    {
        $category = Categories::where('CategoryId', $CategoryId)->first();
        $parentCategory = Categories::where('CategoryId', $category->ParentId)->first();

        return view('admin.Category.Delete', [
            'title' => 'Xóa loại hàng',
        ], compact('category', 'parentCategory'));
    }

    public function delete($CategoryId)
    {
        $category = Categories::find($CategoryId);

        if (!$category) {
            return redirect()->back()->with('error', 'Không tìm thấy loại hàng để xóa');
        }

        $category->delete();
        return redirect()->route('category')->with('message', 'Xóa loại hàng thành công');
    }
}
