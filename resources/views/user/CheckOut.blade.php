@include ('user.layouts.MainHeader')
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
                <div class="checkout-page">
                    <ol class="checkout-steps">
                        <li class="steps active">
                            <h1 href="checkout.html" class="step-title">
                                billing information
                            </h1>
                            <div class="step-description">
                                <form>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="your-details">
                                                <h5>
                                                    Your Persional Details
                                                </h5>
                                                <div class="form-row">
                                                    <label class="lebel-abs">
                                                        Full Name
                                                        <strong class="red">
                                                            *
                                                        </strong>
                                                    </label>
                                                    <input type="text" class="input namefild" name="">
                                                </div>
                                                <div class="form-row">
                                                    <label class="lebel-abs">
                                                        Email
                                                        <strong class="red">
                                                            *
                                                        </strong>
                                                    </label>
                                                    <input type="text" class="input namefild" name="">
                                                </div>
                                                <div class="form-row">
                                                    <label class="lebel-abs">
                                                        Telephone
                                                        <strong class="red">
                                                            *
                                                        </strong>
                                                    </label>
                                                    <input type="text" class="input namefild" name="">
                                                </div>
                                                <button class="">
                                                    Continue
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="your-details">
                                                <h5>
                                                    Your Address
                                                </h5>
                                                <div class="form-row">
                                                    <label class="lebel-abs">
                                                        Address
                                                        <strong class="red">
                                                            *
                                                        </strong>
                                                    </label>
                                                    <input type="text" class="input namefild" name="">
                                                </div>
                                                <div class="form-row">
                                                    <label class="lebel-abs">
                                                        City
                                                        <strong class="red">
                                                            *
                                                        </strong>
                                                    </label>
                                                    <input type="text" class="input namefild" name="">
                                                </div>
                                                <div class="form-row">
                                                    <label class="lebel-abs">
                                                        Country
                                                        <strong class="red">
                                                            *
                                                        </strong>
                                                    </label>
                                                    <input type="text" class="input namefild" name="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@include ('user.layouts.MainFooter')