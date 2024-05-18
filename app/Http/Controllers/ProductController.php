<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Colors;
use App\Models\Products;
use App\Models\Saleoffs;
use App\Models\Sizes;
use App\Models\Tags;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function Index(Request $request)
    {
        if ($request->search !== null) {
            $data = Products::where('ProductName', 'like', '%' . $request->search . '%')->paginate(10);
        } else {
            $data = Products::paginate(10);
        }
        return view('admin.Product.Index', [
            'title' => 'Quản lý mặt hàng'
        ], compact('data'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function Create()
    {
        $product = new Products();
        $categories = Categories::all();
        $product->ProductId = 0;
        $isEdit = false;
        return view('admin.Product.Edit', [
            'title' => 'Thêm mặt hàng',
            'isEdit' => $isEdit,
        ], compact('product','categories'));
    }
    public function Edit($ProductId)
    {
        $product = Products::where('ProductId', $ProductId)->first();
        $categories = Categories::all();
        $colors = $product->colors()->get();
        $sizes = $product->sizes()->get();
        $saleoffs = $product->saleoffs()->get();
        $tags = $product->tags()->get();
        $isEdit = true;
        return view('admin.Product.Edit', [
            'title' => 'Cập nhật thông tin mặt hàng',
            'isEdit' => $isEdit,
        ], compact('product', 'colors', 'sizes', 'saleoffs', 'tags','categories'));
    }
    public function Save(Request $request)
    {
        if ($request->ProductId == 0) {
            $product = new Products();
            $product->ProductName = $request->ProductName;
            $product->Price = $request->Price;
            $product->ProductDescription = $request->ProductDescription;
            $product->CategoryId = $request->CategoryId;
            if ($request->hasFile('uploadPhoto')) {
                $file = $request->file('uploadPhoto');
                $ext = $file->getClientOriginalExtension();
                $file_name = time() . '-' . 'product.' . $ext;
                $file->move(public_path('upload/product'), $file_name);
                $product->ProductPhoto = $file_name;
            }

            $product->save();
            return redirect('product')->with('message', 'Thêm mặt hàng thành công');
        } else {
            $product = Products::where('ProductId', $request->ProductId)->first();
            if ($product) {
                $product->ProductName = $request->ProductName;
                $product->Price = $request->Price;
                $product->ProductDescription = $request->ProductDescription;
                $product->CategoryId = $request->CategoryId;
                if ($request->hasFile('uploadPhoto')) {
                    $file = $request->file('uploadPhoto');
                    $ext = $file->getClientOriginalExtension();
                    $file_name = time() . '-' . 'product.' . $ext;
                    $file->move(public_path('upload/product'), $file_name);
                    $product->ProductPhoto = $file_name;
                }
                $product->save();
                return redirect('product')->with('message', 'Cập nhật thành công');
            }
        }
    }
    public function showDeleteForm($ProductId)
    {
        $product = Products::where('ProductId', $ProductId)->first();
        return view('admin.Product.Delete', [
            'title' => 'Xóa mặt hàng',
        ], compact('product'));
    }
    public function delete($ProductId)
    {
        $product = Products::find($ProductId);

        if (!$product) {
            return redirect()->back()->with('error', 'Không tìm thấy mặt hàng để xóa');
        }

        $product->delete();
        return redirect('product')->with('message', 'Xóa mặt hàng thành công');
    }

    public function Color($ProductId, $method, $ColorId)
    {
        switch ($method) {
            case "add":
                $colors = Colors::all();
                return view('admin.Product.Color', [
                    'title' => 'Thêm màu cho mặt hàng',
                    'ProductId' => $ProductId,
                ], compact('colors', 'ProductId'));
            case "delete":
                $product = Products::find($ProductId);
                if ($product) {
                    $product->colors()->detach($ColorId);
                    return redirect()->route('editproduct', ['ProductId' => $ProductId]);
                }
            default:
                return redirect()->route('product');
        }
    }

    public function SaveColor(Request $request)
    {
        $colorIds = $request->input('ColorId', []);
        $productId = $request->input('ProductId');
        $product = Products::find($productId);
        foreach ($colorIds as $colorId) {
            if (!$product->colors->contains($colorId)) {
                $product->colors()->attach($colorId);
            }
        }
        return redirect()->route('editproduct', ['ProductId' => $productId]);
    }

    public function Size($ProductId, $method, $SizeId)
    {
        switch ($method) {
            case "add":
                $sizes = Sizes::all();
                return view('admin.Product.Size', [
                    'title' => 'Thêm size cho mặt hàng',
                    'ProductId' => $ProductId,
                ], compact('sizes', 'ProductId'));
            case "delete":
                $product = Products::find($ProductId);
                if ($product) {
                    $product->sizes()->detach($SizeId);
                    return redirect()->route('editproduct', ['ProductId' => $ProductId]);
                }
            default:
                return redirect()->route('product');
        }
    }

    public function SaveSize(Request $request)
    {
        $sizeIds = $request->input('SizeId', []);
        $productId = $request->input('ProductId');
        $product = Products::find($productId);
        foreach ($sizeIds as $sizeId) {
            if (!$product->sizes->contains($sizeId)) {
                $product->sizes()->attach($sizeId);
            }
        }
        return redirect()->route('editproduct', ['ProductId' => $productId]);
    }

    public function Saleoff($ProductId, $method, $SaleOffId)
    {
        switch ($method) {
            case "add":
                $saleoffs = Saleoffs::all();
                return view('admin.Product.Saleoff', [
                    'title' => 'Thêm khuyến mãi cho mặt hàng',
                    'ProductId' => $ProductId,
                ], compact('saleoffs', 'ProductId'));
            case "delete":
                $product = Products::find($ProductId);
                if ($product) {
                    $product->saleoffs()->detach($SaleOffId);
                    return redirect()->route('editproduct', ['ProductId' => $ProductId]);
                }
            default:
                return redirect()->route('product');
        }
    }

    public function SaveSaleoff(Request $request)
    {
        $saleoffIds = $request->input('SaleOffId', []);
        $productId = $request->input('ProductId');
        $product = Products::find($productId);
        foreach ($saleoffIds as $saleoffId) {
            if (!$product->saleoffs->contains($saleoffId)) {
                $product->saleoffs()->attach($saleoffId);
            }
        }
        return redirect()->route('editproduct', ['ProductId' => $productId]);
    }

    public function Tag($ProductId, $method, $TagId)
    {
        switch ($method) {
            case "add":
                $tags = Tags::all();
                return view('admin.Product.Tag', [
                    'title' => 'Thêm khuyến mãi cho mặt hàng',
                    'ProductId' => $ProductId,
                ], compact('tags', 'ProductId'));
            case "delete":
                $product = Products::find($ProductId);
                if ($product) {
                    $product->tags()->detach($TagId);
                    return redirect()->route('editproduct', ['ProductId' => $ProductId]);
                }
            default:
                return redirect()->route('product');
        }
    }

    public function SaveTag(Request $request)
    {
        $tagIds = $request->input('TagId', []);
        $productId = $request->input('ProductId');
        $product = Products::find($productId);
        foreach ($tagIds as $tagId) {
            if (!$product->tags->contains($tagId)) {
                $product->tags()->attach($tagId);
            }
        }
        return redirect()->route('editproduct', ['ProductId' => $productId]);
    }
}
