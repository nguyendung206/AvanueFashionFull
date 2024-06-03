@include ('user.layouts.MainHeader')
<div class="hom-slider">
    <div class="container">
        <div id="sequence">
            <div class="sequence-prev"><i class="fa fa-angle-left"></i></div>
            <div class="sequence-next"><i class="fa fa-angle-right"></i></div>
            <ul class="sequence-canvas">
                <li class="animate-in">
                    <div class="flat-caption caption1 formLeft delay300 text-center"><span class="suphead">Paris show 2014</span></div>
                    <div class="flat-caption caption2 formLeft delay400 text-center">
                        <h1>Collection For Winter</h1>
                    </div>
                    <div class="flat-caption caption3 formLeft delay500 text-center">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.<br>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
                    </div>
                    <div class="flat-button caption4 formLeft delay600 text-center"><a class="more" href="#">More Details</a></div>
                    <div class="flat-image formBottom delay200" data-duration="5" data-bottom="true"><img src="/images/slider-image-01.png" alt=""></div>
                </li>
                <li>
                    <div class="flat-caption caption2 formLeft delay400">
                        <h1>Collection For Winter</h1>
                    </div>
                    <div class="flat-caption caption3 formLeft delay500">
                        <h2>Etiam velit purus, luctus vitae velit sedauctor<br>egestas diam, Etiam velit purus.</h2>
                    </div>
                    <div class="flat-button caption5 formLeft delay600"><a class="more" href="#">More Details</a></div>
                    <div class="flat-image formBottom delay200" data-bottom="true"><img src="/images/slider-image-02.png" alt=""></div>
                </li>
                <li>
                    <div class="flat-caption caption2 formLeft delay400 text-center">
                        <h1>New Fashion of 2013</h1>
                    </div>
                    <div class="flat-caption caption3 formLeft delay500 text-center">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. <br>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
                    </div>
                    <div class="flat-button caption4 formLeft delay600 text-center"><a class="more" href="#">More Details</a></div>
                    <div class="flat-image formBottom delay200" data-bottom="true"><img src="/images/slider-image-03.png" alt=""></div>
                </li>
            </ul>
        </div>
    </div>
    <div class="promotion-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="promo-box"><img src="/images/promotion-01.png" alt=""></div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="promo-box"><img src="/images/promotion-02.png" alt=""></div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="promo-box"><img src="/images/promotion-03.png" alt=""></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="container_fullwidth">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="category leftbar">
          <h3 class="title">
            Categories
          </h3>
          <ul>
            @foreach($categoryList as $category)
            <li>
              <a href="{{route('searchcategoryid', $category->CategoryId)}}">
                {{ str_repeat('--', $category->level) . ' ' . $category->CategoryName }}
              </a>
            </li>
            @endforeach
          </ul>
        </div>
        <div class="clearfix">
        </div>
        <div class="price-filter leftbar">
          <h3 class="title">
            Price
          </h3>
          <form class="pricing">
            <label>
              $
              <input type="number">
            </label>
            <span class="separate">
              -
            </span>
            <label>
              $
              <input type="number">
            </label>
            <input type="submit" value="Go">
          </form>
        </div>
        <div class="clearfix">
        </div>
        <div class="clolr-filter leftbar">
          <h3 class="title">
            Color
          </h3>
          <ul>
            @foreach($colorList as $color)
            <li>
              <a href="{{route('searchcolorid', $color->ColorId)}}" class="{{$color->ColorIllustration}}-bg">
              </a>
            </li>
            @endforeach
          </ul>
        </div>
        <div class="clearfix">
        </div>
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
      <div class="col-md-9">
        <div class="clearfix">
        </div>
        <div class="products-grid">
          <div class="row">
            @if($productList->isEmpty())
            <h3 class="text-center" style="padding-top: 20px;">Không có mặt hàng để hiển thị.</h3>
            @else
            @foreach($productList as $product)
            <div class="col-md-4 col-sm-6">
              <div class="products">
                <div class="thumbnail">
                  <a href="{{route ('detail', $product-> ProductId)}}">
                    <img src="/upload/product/{{ $product->ProductPhoto }}" alt="Product Name">
                  </a>
                </div>
                <div class="productname">
                  {{ $product->ProductName }}
                </div>
                <h4 class="price">
                  {{ number_format($product->Price, 0, ',', '.') }}đ
                </h4>
                <div class="button_group">
                  <button class="button add-cart" type="button">
                    Add To Cart
                  </button>
                  <button class="button compare" type="button">
                    <i class="fa fa-exchange"></i>
                  </button>
                  <button class="button wishlist" type="button">
                    <i class="fa fa-heart-o"></i>
                  </button>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          @endif
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>
@include ('user.layouts.MainFooter')