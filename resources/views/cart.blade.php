@extends('layouts.front')

@section('content')

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All departments</span>
                        </div>
                        <ul>
                            <li><a href="#">Fresh Meat</a></li>
                            <li><a href="#">Vegetables</a></li>
                            <li><a href="#">Fruit & Nut Gifts</a></li>
                            <li><a href="#">Fresh Berries</a></li>
                            <li><a href="#">Ocean Foods</a></li>
                            <li><a href="#">Butter & Eggs</a></li>
                            <li><a href="#">Fastfood</a></li>
                            <li><a href="#">Fresh Onion</a></li>
                            <li><a href="#">Papayaya & Crisps</a></li>
                            <li><a href="#">Oatmeal</a></li>
                            <li><a href="#">Fresh Bananas</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                    <form id="myform" action="{{ route('cart.update') }}" method="post">
                        @csrf
                        @method('patch')
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="{{ $item->product->image_url }}" alt="">
                                        <h5>{{ $item->product->name }}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                    ${{ $item->product->final_price }}
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                            <input  name="quantity[{{ $item->product_id }}]" value="{{ $item->quantity }}" type="text">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                    ${{ $item->product->final_price * $item->quantity }}
                                    </td>

                                    </form>

                                    <td class="shoping__cart__item__close">
                                        <form action="{{ route('cart.deleteItem', $item->product_id) }}" class="form-inline" method="post">
                                        @csrf
                                        @method('DELETE')
                                     <button onclick="$(this).closest('form').submit()"><i class="fa fa-trash"></i></button>                    
                                     </form>
                                    </td>
                                </tr>
                                @endforeach
                                <div class="float-right">
                                        
                                        
                                    </div><!-- End .float-right -->
                            </tbody>
                            
                        </table>
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{ route('home')}}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <button type="submit" form="myform" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>Upadate Cart</button>
                        <form method="post" action="{{ route('cart.destroy') }}" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="primary-btn cart-btn">Clear Shopping Cart</button>
                                        </form>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <x-alerts/>

                            <form action="{{ route('cart.applyCoupon')}}" method="POST">
                            @csrf
                                <input type="text" name="code_coupon" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                        @if(!empty(Session::get('CouponAmount')))
                            <li>Subtotal <span>${{ $sub_total }}</span></li>
                            <li>Tax <span>${{ $tax }}</span></li>
                            <li>Coupon Discound <span>${{ Session::get('CouponAmount') }}</span></li>
                            <li>Total <span>${{ $total - Session::get('CouponAmount') }}</span></li>
                        @else
                            <li>Subtotal <span>${{ $sub_total }}</span></li>
                            <li>Tax <span>${{ $tax }}</span></li>
                            <li>Total <span>${{ $total }}</span></li>
                        @endif
                        </ul>
                        <form action="{{ route('checkout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-block btn-sm btn-primary">PROCEED TO CHECKOUT</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

@endsection