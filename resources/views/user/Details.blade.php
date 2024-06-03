@include ('user.layouts.MainHeader')

<div class="container_fullwidth">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="products-details">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Nếu có thông báo thành công -->
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="preview_image">
                        <div class="preview-small">
                            <img id="zoom_03" src="/upload/product/{{ $photoMedium->Photo ?? null}}" data-zoom-image="/upload/product/{{ $photoLarge->Photo ?? null}}" alt="">
                        </div>
                    </div>
                    <div class="products-description">
                        <h5 class="name">
                            {{ $product->ProductName }}
                        </h5>
                        <p>
                            <img alt="" src="/images/star.png">
                        </p>
                        <p>
                            Availability:
                            <span class=" light-red">
                                In Stock
                            </span>
                        </p>
                        <p>
                            {{ $product->ProductDescription }}
                        </p>
                        <hr class="border">
                        <div class="price">
                            Price :
                            <span class="new_price">
                                {{ number_format($product->Price, 0, ',', '.') }}
                                <sup>
                                    VND
                                </sup>
                            </span>
                            <!-- <span class="old_price">
                                {{ $product->Price }}
                                <sup>
                                    VND
                                </sup>
                            </span> -->
                        </div>
                        <hr class="border">
                        <div class="wided">
                            <form action="{{route('addtocart')}}" method="post">
                                @csrf
                                <input type="hidden" name="productId" value="{{$product->ProductId}}">
                                <div class="qty" style="width: 165px;">
                                    Qty &nbsp;&nbsp;:
                                    <input name="Quanlity" type="number" style="width: 120px;" value="1">
                                </div>
                                <div class="button_group">
                                    <button class="button" type="submit">
                                        Add To Cart
                                    </button>
                                    <button class="button compare">
                                        <i class="fa fa-exchange">
                                        </i>
                                    </button>
                                    <button class="button favorite">
                                        <i class="fa fa-heart-o">
                                        </i>
                                    </button>
                                    <button class="button favorite">
                                        <i class="fa fa-envelope-o">
                                        </i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="clearfix">
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="product-tag leftbar">
                    <h3 class="title">
                        Products
                        <strong>
                            Tags
                        </strong>
                    </h3>
                    <ul>
                        @foreach($tagList as $tag)
                        <li>
                            <a href="{{route('searchtagid', $tag->TagId)}}">
                                {{$tag->TagName}}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@include ('user.layouts.MainFooter')