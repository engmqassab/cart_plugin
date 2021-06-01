<div class="col-lg-3 col-sm-6 col-12">
    <div class="card ecommerce-card" style="display: inline-block;">
        <div class="item-img text-center">
            <a href="app-ecommerce-details.html">
                <img src="{{$product->image_url}}" style="height: 150px;width: 180px;" class="img-fluid" alt="img-placeholder" />
            </a>
        </div>
        <div class="card-body">
            <div class="item-wrapper">
                <div class="item-rating">
                    <ul class="unstyled-list list-inline">
                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                    </ul>
                </div>
                <div class="item-cost">
                    <h6 class="item-price">${{number_format($product->final_price,2)}}</h6>
                </div>

            </div>
            <div class="item-name">
                <a href="app-ecommerce-details.html">{{$product->name}}</a>
            </div>
            <p class="card-text item-description">
                {{$product->category->name}}
            </p>
        </div>
        <div class="item-options text-center">

            <form action="{{ route('cart.store')}}" method="post">
                @csrf
                <button type="submit" name="product_id" value="{{$product->id}}" class="btn btn-primary btn-cart move-cart">
                    <i data-feather="shopping-cart"></i>
                    <span class="add-to-cart">Add to cart</span>
                </button>
            </form>
        </div>
    </div>
</div>
