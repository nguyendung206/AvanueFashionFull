<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Colors;
use App\Models\Products;
use App\Models\Tags;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function Index(Request $request, $CategoryId = null, $ColorId = null, $TagId = null)
    {
        // dd($TagId);
        if ($request->search !== null) {
            $productList = Products::where('ProductName', 'like', '%' . $request->search . '%')->paginate(9);
        } elseif ($CategoryId !== null) {
            $productList = Products::where('CategoryId', $CategoryId)->paginate(9);
        } else {
            $productList = Products::paginate(9);
        }
        $allCategories = Categories::all();
        $categoryList = $this->buildCategoryTree($allCategories);
        $tagList = Tags::all();
        $colorList = Colors::all();
        return view('user.Index', compact('productList', 'categoryList', 'colorList','tagList'));
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
}
