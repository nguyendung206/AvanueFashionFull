@include ('user.layouts.MainHeader')

<div class="container_fullwidth">
    <div class="container shopping-cart">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title">
                    Shopping Cart
                </h3>
                <div class="clearfix"></div>
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
                                Delete
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
                                    <!-- Bổ sung các thông tin khác của sản phẩm nếu cần -->
                                </div>
                            </td>
                            <td>
                                <h5>
                                    {{ number_format($item['price'], 0, ',', '.') }} VND
                                </h5>
                            </td>
                            <td>
                                <select name="quantity">
                                    @for ($i = 1; $i <= 10; $i++) <option value="{{ $i }}" {{ $i == $item['quantity'] ? 'selected' : '' }}>
                                        {{ $i }}
                                        </option>
                                        @endfor
                                </select>
                            </td>
                            <td>
                                <h5>
                                    <strong class="red">
                                        {{ number_format($item['price'] * $item['quantity'], 0, '.', ',') }} VND
                                    </strong>
                                </h5>
                            </td>
                            <td>
                                <a href="#">
                                    <img src="/images/remove.png" alt="Delete">
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

                                <button class="pull-right">
                                    Update Shopping Cart
                                </button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

@include ('user.layouts.MainFooter')