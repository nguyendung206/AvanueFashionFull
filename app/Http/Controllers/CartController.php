<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function Index()
    {
        return view('user.Cart');
    }

    public function AddToCart(Request $request)
    {
        $quantity = $request->Quanlity;
        $productId = $request->productId;
        if ($quantity <= 0 || $productId <= 0) {
            return redirect()->back()->withErrors(['error' => 'Invalid quantity or product ID']);
        }
        $product = Products::find($productId);
        if (!$product) {
            return redirect()->back()->withErrors(['error' => 'Product not found']);
        }
        if (!$request->session()->has('cart')) {
            $request->session()->put('cart', []);
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
            $cart[$existingProductKey]['quantity'] += $quantity;
        } else {
            $cart[] = [
                'productId' => $productId,
                'productName' => $product->ProductName,
                'quantity' => $quantity,
                'price' => $product->Price,
                'photo' => $product->ProductPhoto,
            ];
        }

        $request->session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart');
    }
}
