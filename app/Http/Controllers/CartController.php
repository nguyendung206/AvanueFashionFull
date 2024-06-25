<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Colors;
use App\Models\Products;
use App\Models\Sizes;
use App\Models\Tags;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function Index(Request $request)
    {
        $colorsList = Colors::all();
        $sizesList = Sizes::all();
        $cart = $request->session()->get('cart', []);
        $cartCount = count($cart);
        return view('user.Cart', compact('colorsList', 'sizesList', 'cart', 'cartCount'));
    }


    public function AddToCart(Request $request, $productId = null)
    {
        $quantity = $request->input('Quantity');
        $productId = $request->input('productId');
        $sizes = $request->input('size', []);
        $colors = $request->input('color', []);

        if ($quantity <= 0 || $productId <= 0) {
            return redirect()->back()->withErrors(['error' => 'Invalid quantity or product ID']);
        }

        $product = Products::find($productId);
        if (!$product) {
            return redirect()->back()->withErrors(['error' => 'Product not found']);
        }

        $cart = $request->session()->get('cart', []);

        // Check if the product already exists in the cart
        $existingProductKey = null;
        foreach ($cart as $key => $item) {
            if ($item['productId'] == $productId) {
                $existingProductKey = $key;
                break;
            }
        }

        // Update quantity if product exists, otherwise add new product to cart
        if ($existingProductKey !== null) {
            $cart[$existingProductKey]['quantity'] += $quantity;
        } else {
            $cart[] = [
                'productId' => $productId,
                'productName' => $product->ProductName,
                'quantity' => $quantity,
                'price' => $product->Price,
                'photo' => $product->ProductPhoto,
                'sizes' => $sizes,
                'colors' => $colors
            ];
        }

        // Save the updated cart in session
        $request->session()->put('cart', $cart);
        $cartCount = count($cart);

        // Return JSON response with success message and cart count
        return response()->json(['success' => true, 'cartCount' => $cartCount, 'message' => 'Product added to cart successfully']);
    }



    public function UpdateToCart(Request $request, $productId)
    {
        if ($request->isMethod('get')) {
            $product = Products::find($productId);
            if (!$product) {
                return redirect()->back()->withErrors(['error' => 'Product not found']);
            }
            $photoMedium = $product->photos()->where('Description', 'like', '%Medium%')->first();
            $photoLarge = $product->photos()->where('Description', 'like', '%Large%')->first();
            $colors = $product->colors()->get();
            $sizes = $product->sizes()->get();
            $edit = true;
            $tagList = Tags::all();
            $cartCount = count($request->session()->get('cart', []));
            return view('user.Details', compact('product', 'photoMedium', 'photoLarge', 'tagList', 'colors', 'sizes', 'cartCount', 'edit'));
        } else if ($request->isMethod('post')) {
            $quantity = $request->input('Quantity');
            $productId = $request->input('productId');
            $sizes = $request->input('size', []);
            $colors = $request->input('color', []);
            if ($quantity <= 0 || $productId <= 0) {
                return redirect()->back()->withErrors(['error' => 'Invalid quantity or product ID']);
            }

            $product = Products::find($productId);
            if (!$product) {
                return redirect()->back()->withErrors(['error' => 'Product not found']);
            }

            $cart = $request->session()->get('cart');

            // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
            $existingProductKey = null;
            foreach ($cart as $key => $item) {
                if ($item['productId'] == $productId) {
                    $existingProductKey = $key;
                    break;
                }
            }

            if ($existingProductKey !== null) {
                $cart[$existingProductKey]['quantity'] = $quantity;
                $cart[$existingProductKey]['sizes'] = $sizes;
                $cart[$existingProductKey]['colors'] = $colors;
            }
            $request->session()->put('cart', $cart);
            return Redirect::route('cart');
        }
    }

    public function DeleteCart($productId)
    {
        // Lấy giỏ hàng từ session
        $cart = session('cart', []);

        // Lọc ra các sản phẩm không có productId cần xóa
        $updatedCart = array_filter($cart, function ($item) use ($productId) {
            return $item['productId'] != $productId;
        });

        // Đánh chỉ số lại mảng để không có khoảng trống trong các khóa
        $updatedCart = array_values($updatedCart);

        // Cập nhật giỏ hàng trong session
        session(['cart' => $updatedCart]);

        // Tùy chọn: Bạn có thể thêm thông báo flash hoặc trả về một phản hồi
        return redirect()->route('cart')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng thành công');
    }

    public function CheckOut(Request $request)
    {
        $allCategories = Categories::all();
        $categoryList = $this->buildCategoryTree($allCategories);
        $colorList = Colors::all();
        $sizeList = Sizes::all();
        $tagList = Tags::all();
        $cart = $request->session()->get('cart', []);
        $cartCount = count($cart);
        return view('user.CheckOut', compact('colorList', 'sizeList', 'categoryList','tagList', 'cart', 'cartCount'));
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
