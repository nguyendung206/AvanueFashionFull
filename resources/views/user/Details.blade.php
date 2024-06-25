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
                            <img id="zoom_03" src="/upload/product/{{ $photoMedium->Photo ?? ''}}" data-zoom-image="/upload/product/{{ $photoLarge->Photo ?? ''}}" alt="">
                        </div>
                    </div>
                    <div class="products-description">
                        <h5 class="name">{{ $product->ProductName }}</h5>
                        <p><img alt="" src="/images/star.png"></p>
                        <p>Availability: <span class="light-red">In Stock</span></p>
                        <p>{{ $product->ProductDescription }}</p>
                        <hr class="border">
                        <div class="price">
                            Price: <span class="new_price">{{ number_format($product->Price, 0, ',', '.') }}<sup>VND</sup></span>
                        </div>
                        <hr class="border">
                        <div class="wided">
                            <form id="add-to-cart-form" action="{{ isset($edit) && $edit ? route('updatecart', ['productId' => $product->ProductId]) : route('addtocart') }}" method="post">
                                @csrf
                                <input type="hidden" name="productId" value="{{ $product->ProductId }}">
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
                                            <span class="color-label {{ $color->ColorIllustration }}-bg"></span>
                                        </label>
                                        @endforeach
                                    </div>
                                    <div class="button_group col-md-12">
                                        <button class="button" type="submit">{{ isset($edit) && $edit ? 'Update Cart' : 'Add To Cart' }}</button>
                                        <a class="button compare"><i class="fa fa-exchange"></i></a>
                                        <a class="button favorite"><i class="fa fa-heart-o"></i></a>
                                        <a class="button favorite"><i class="fa fa-envelope-o"></i></a>
                                    </div>
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
                        <li><a href="{{ route('searchtagid', $tag->TagId) }}">{{ $tag->TagName }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('add-to-cart-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            const formData = new FormData(form);

            fetch(form.action, { // Send AJAX request
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json()) // Convert response to JSON
                .then(data => {
                    if (data.success) {
                        alert('Product added to cart successfully!');
                        updateCartCount(data.cartCount);
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

        document.querySelectorAll('.color-options label, .size-options label').forEach(label => {
            label.addEventListener('click', function() {
                const input = this.querySelector('input[type="checkbox"]');
                input.checked = !input.checked;
            });
        });
    });
</script>

@include ('user.layouts.MainFooter')