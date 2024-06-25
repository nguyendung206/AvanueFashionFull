@include ('user.layouts.MainHeader')

<div class="container_fullwidth">
    <div class="container shopping-cart">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title">
                    Shopping Cart
                </h3>
                <div class="clearfix"></div>

                @if(empty(session('cart')) || count(session('cart')) == 0)
                <h1>Chưa có mặt hàng trong giỏ.</h1>
                <br>
                <a href="{{ route('home') }}" class="pull-left">
                    <button>
                        Quay lại
                    </button>
                </a>
                @else
                <table class="shop-table">
                    <thead>
                        <tr>
                            <th>
                                Image
                            </th>
                            <th>
                                Details
                            </th>
                            <th>
                                Price
                            </th>
                            <th>
                                Quantity
                            </th>
                            <th>
                                Total
                            </th>
                            <th>
                                Update / Delete
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(session('cart', []) as $item)
                        <tr>
                            <td>
                                <img src="/upload/product/{{ $item['photo'] }}" alt="">
                            </td>
                            <td>
                                <div class="shop-details">
                                    <div class="productname">
                                        {{ $item['productName'] }}
                                    </div>
                                    <div class="color-choser">
                                        <span class="text">
                                            Product Color :
                                        </span>
                                        <ul>
                                            @foreach($item['colors'] as $colorId)
                                            @foreach($colorsList as $color)
                                            @if($color->ColorId == $colorId)
                                            <li>
                                                <a href="" class="{{$color->ColorIllustration}}-bg">
                                                </a>
                                            </li>
                                            @endif
                                            @endforeach
                                            @endforeach
                                        </ul>
                                        <span class="text">
                                            Product Size :
                                        </span>
                                        @foreach($item['sizes'] as $sizeId)
                                        @foreach($sizesList as $size)
                                        @if($size->SizeId == $sizeId)
                                        <span class="text">{{ $size->SizeName }},</span>
                                        @endif
                                        @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </td>

                            <td>
                                <h5>
                                    {{ number_format($item['price'], 0, ',', '.') }} VND
                                </h5>
                            </td>
                            <td>
                                <input type="number" name="quantity" min="1" max="10" value="{{ $item['quantity'] }}">
                            </td>
                            <td>
                                <h5>
                                    <strong class="red">
                                        {{ number_format($item['price'] * $item['quantity'], 0, '.', ',') }} VND
                                    </strong>
                                </h5>
                            </td>
                            <td>
                                <a href="{{route('deletecart', $item['productId'])}}" style="font-size: 16px;">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                                <a href="{{route('updatecart', $item['productId'])}}" style="font-size: 16px;">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                <a href="{{ route('home') }}" class="pull-left">
                                    <button>
                                        Continue Shopping
                                    </button>
                                </a>
                                <a href="{{ route('checkout') }}">
                                    <button class="pull-right">
                                        Check Out
                                    </button>
                                </a>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                @endif
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

@include ('user.layouts.MainFooter')