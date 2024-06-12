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
                        <h5 class="name">{{ $product->ProductName }}</h5>
                        <p>
                            <img alt="" src="/images/star.png">
                        </p>
                        <p>
                            Availability:
                            <span class="light-red">In Stock</span>
                        </p>
                        <p>{{ $product->ProductDescription }}</p>
                        <hr class="border">
                        <div class="price">
                            Price:
                            <span class="new_price">
                                {{ number_format($product->Price, 0, ',', '.') }}
                                <sup>VND</sup>
                            </span>
                        </div>
                        <hr class="border">
                        <div class="wided">
                            @if(isset($edit) && $edit)
                            <form id="add-to-cart-form" action="{{ route('updatecart', ['productId' => $product->ProductId]) }}" method="post">
                                @else
                                <form id="add-to-cart-form" action="{{ route('addtocart') }}" method="post">
                                    @endif
                                    @csrf
                                    <input type="hidden" name="productId" value="{{$product->ProductId}}">
                                    <div class="row">
                                        <div class="qty col-md-12">
                                            Quantity &nbsp;&nbsp;:
                                            <input name="Quantity" type="number" value="1">
                                        </div>
                                        <div class="qty col-md-6 options size-options">
                                            Size:
                                            @foreach($sizes as $size)
                                            <label>
                                                <input type="checkbox" name="size[]" value="{{ $size->SizeId }}">
                                                <span class="size-label">{{ $size->SizeName }}</span>
                                            </label>
                                            @endforeach
                                        </div>
                                        <div class="qty col-md-6 options color-options">
                                            Color:
                                            @foreach($colors as $color)
                                            <label>
                                                <input type="checkbox" name="color[]" value="{{ $color->ColorId }}">
                                                <span class="color-label {{$color->ColorIllustration}}-bg"></span>
                                            </label>
                                            @endforeach
                                        </div>
                                        @if(isset($edit) && $edit)
                                        <div class="button_group col-md-12">
                                            <button class="button" type="submit">Update Cart</button>
                                            <a class="button compare"><i class="fa fa-exchange"></i></a>
                                            <a class="button favorite"><i class="fa fa-heart-o"></i></a>
                                            <a class="button favorite"><i class="fa fa-envelope-o"></i></a>
                                        </div>
                                        @else
                                        <div class="button_group col-md-12">
                                            <button class="button" type="submit">Add To Cart</button>
                                            <a class="button compare"><i class="fa fa-exchange"></i></a>
                                            <a class="button favorite"><i class="fa fa-heart-o"></i></a>
                                            <a class="button favorite"><i class="fa fa-envelope-o"></i></a>
                                        </div>
                                        @endif
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="product-tag leftbar">
                    <h3 class="title">Products <strong>Tags</strong></h3>
                    <ul>
                        @foreach($tagList as $tag)
                        <li>
                            <a href="{{route('searchtagid', $tag->TagId)}}">{{$tag->TagName}}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.color-options label').forEach(label => {
        label.addEventListener('click', function() {
            const input = this.querySelector('input[type="checkbox"]');
            input.checked = !input.checked;
        });
    });

    document.querySelectorAll('.size-options label').forEach(label => {
        label.addEventListener('click', function() {
            const input = this.querySelector('input[type="checkbox"]');
            input.checked = !input.checked;
        });
    });
</script>
@include ('user.layouts.MainFooter')

<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('add-to-cart-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Ngăn chặn hành vi mặc định của form

            const formData = new FormData(form);

            fetch(form.action, { // Gửi yêu cầu AJAX
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json()) // Chuyển đổi phản hồi sang JSON
                .then(data => {
                    if (data.success) {
                        alert('Product added to cart successfully!');
                        updateCartCount(data.cartCount);
                        updateCartContent(data.cartContent);
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        function updateCartCount(count) {
            const cartCount = document.querySelector('.cart_no');
            if (cartCount) {
                cartCount.textContent = count;
            }
        }

        function updateCartContent(content) {
            const cartContent = document.querySelector('.option-cart-item');
            if (cartContent) {
                cartContent.innerHTML = content;
            }
        }
    });
</script> -->