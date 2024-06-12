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
        $cartCount = count($request->session()->get('cart', []));

        // Truyền số lượng sản phẩm và các thông tin khác đến view
        return view('user.Index', compact('productList', 'categoryList', 'colorList', 'tagList', 'cartCount'));
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

    public function Detail(Request $request, $ProductId)
    {
        if ($ProductId != null) {
            $product = Products::where('ProductId', $ProductId)->first();
            if ($product) {
                $photoMedium = $product->photos()->where('Description', 'like', '%Medium%')->first();
                $photoLarge = $product->photos()->where('Description', 'like', '%Large%')->first();
                $colors = $product->colors()->get();
                $sizes = $product->sizes()->get();
            } else {
                // Xử lý trường hợp không tìm thấy sản phẩm
                return redirect()->route('error')->withErrors(['error' => 'Product not found']);
            }
        } else {
            // Xử lý trường hợp $ProductId không hợp lệ
            return redirect()->route('error')->withErrors(['error' => 'Invalid product ID']);
        }
        $tagList = Tags::all();
        $cartCount = count($request->session()->get('cart', []));
        return view('user.Details', compact('product', 'photoMedium', 'photoLarge', 'tagList', 'colors', 'sizes', 'cartCount'));
    }
}
