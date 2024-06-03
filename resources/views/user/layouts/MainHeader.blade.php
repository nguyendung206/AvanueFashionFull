<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/images/favicon.png">
    <title>Welcome to FlatShop</title>
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,700,500italic,100italic,100' rel='stylesheet' type='text/css'>
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/flexslider.css" type="text/css" media="screen" />
    <link href="/css/sequence-looptheme.css" rel="stylesheet" media="all" />
    <link href="/css/style.css" rel="stylesheet">
    <!--[if lt IE 9]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script><script src="https://oss.maxcdn.com/libs/respond./js/1.3.0/respond.min.js"></script><![endif]-->
</head>

<body id="home">
    <div class="wrapper">
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-2">
                        <div class="logo"><a href="{{route('home')}}"><img src="/images/logo.png" alt="FlatShop"></a></div>
                    </div>
                    <div class="col-md-10 col-sm-10">
                        <div class="header_top">
                            <div class="row">
                                <div class="col-md-3">
                                    <ul class="option_nav">
                                        <li class="dorpdown">
                                            <a href="#">Eng</a>
                                            <ul class="subnav">
                                                <li><a href="#">Eng</a></li>
                                                <li><a href="#">Vns</a></li>
                                                <li><a href="#">Fer</a></li>
                                                <li><a href="#">Gem</a></li>
                                            </ul>
                                        </li>
                                        <li class="dorpdown">
                                            <a href="#">USD</a>
                                            <ul class="subnav">
                                                <li><a href="#">USD</a></li>
                                                <li><a href="#">UKD</a></li>
                                                <li><a href="#">FER</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-3">
                                    <ul class="usermenu">
                                        @if(Session::has('user'))
                                        <li><a href="">{{ Session::get('user')->CustomerName }}</a></li>
                                        <li><a href="{{ route('signout') }}" class="log">Sign Out</a></li>
                                        @else
                                        <li><a href="{{ route('login') }}" class="log">Login</a></li>
                                        <li><a href="{{ route('register') }}" class="reg">Register</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="header_bottom">
                            <ul class="option">
                                <li id="search" class="search">
                                    <form action="{{route('searchname')}}" method="get">
                                        <input class="search-input" placeholder="Enter your search term..." type="text" name="search">
                                        <input class="search-submit" type="submit" value="">
                                    </form>
                                </li>
                                <li class="option-cart">
                                    <a href="#" class="cart-icon">cart <span class="cart_no">02</span></a>
                                    <ul class="option-cart-item">
                                        <li>
                                            <div class="cart-item">
                                                <div class="image"><img src="/images/products/thum/products-01.png" alt=""></div>
                                                <div class="item-description">
                                                    <p class="name">Lincoln chair</p>
                                                    <p>Size: <span class="light-red">One size</span><br>Quantity: <span class="light-red">01</span></p>
                                                </div>
                                                <div class="right">
                                                    <p class="price">$30.00</p>
                                                    <a href="#" class="remove"><img src="/images/remove.png" alt="remove"></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="cart-item">
                                                <div class="image"><img src="/images/products/thum/products-02.png" alt=""></div>
                                                <div class="item-description">
                                                    <p class="name">Lincoln chair</p>
                                                    <p>Size: <span class="light-red">One size</span><br>Quantity: <span class="light-red">01</span></p>
                                                </div>
                                                <div class="right">
                                                    <p class="price">$30.00</p>
                                                    <a href="#" class="remove"><img src="/images/remove.png" alt="remove"></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li><span class="total">Total <strong>$60.00</strong></span><button class="checkout" onClick="location.href='checkout.html'">CheckOut</button></li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="navbar-header"><button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button></div>
                            <div class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">
                                    <li class="active dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Home</a>
                                    </li>
                                    <li><a href="productgird.html">men</a></li>
                                    <li><a href="productlitst.html">women</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Fashion</a>
                                        <div class="dropdown-menu mega-menu">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <ul class="mega-menu-links">
                                                        <li><a href="productgird.html">New Collection</a></li>
                                                        <li><a href="productgird.html">Shirts & tops</a></li>
                                                        <li><a href="productgird.html">Laptop & Brie</a></li>
                                                        <li><a href="productgird.html">Dresses</a></li>
                                                        <li><a href="productgird.html">Blazers & Jackets</a></li>
                                                        <li><a href="productgird.html">Shoulder Bags</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <ul class="mega-menu-links">
                                                        <li><a href="productgird.html">New Collection</a></li>
                                                        <li><a href="productgird.html">Shirts & tops</a></li>
                                                        <li><a href="productgird.html">Laptop & Brie</a></li>
                                                        <li><a href="productgird.html">Dresses</a></li>
                                                        <li><a href="productgird.html">Blazers & Jackets</a></li>
                                                        <li><a href="productgird.html">Shoulder Bags</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a href="{{route('cart')}}">gift</a></li>
                                    <li><a href="productgird.html">kids</a></li>
                                    <li><a href="productgird.html">blog</a></li>
                                    <li><a href="productgird.html">jewelry</a></li>
                                    <li><a href="contact.html">contact us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>